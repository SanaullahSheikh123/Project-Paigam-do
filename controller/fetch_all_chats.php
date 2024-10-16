<?php
include '../includes/config.php';
session_start();

$user_id = $_SESSION['user']['id'];
$query = "SELECT 
            m.id AS message_id, 
            u.id AS chat_user_id, 
            u.username, 
            u.profile_picture, 
            m.message, 
            m.timestamp, 
            (SELECT COUNT(*) FROM messages 
             WHERE receiver_id = $user_id AND sender_id = u.id AND seen = 0) AS unread_count
          FROM messages m
          JOIN users u ON u.id = CASE 
                                  WHEN m.sender_id = $user_id THEN m.receiver_id 
                                  ELSE m.sender_id 
                                END
          WHERE m.id IN (
              SELECT MAX(id) FROM messages 
              WHERE sender_id = $user_id OR receiver_id = $user_id 
              GROUP BY sender_id, receiver_id
          )
          ORDER BY m.timestamp DESC";

$result = $conn->query($query);

$chats = [];
while ($row = $result->fetch_assoc()) {
    $chats[] = $row;
}

echo json_encode($chats);
?>
