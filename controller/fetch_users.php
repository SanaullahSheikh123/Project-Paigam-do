<?php
session_start();
include '../includes/config.php';

$user_id = $_SESSION['user']['id'];

$query = "
    SELECT 
        u.id,
        u.display_name,
        u.profile_picture,
        (
            SELECT m.message 
            FROM messages m 
            WHERE (m.sender_id = u.id OR m.receiver_id = u.id) 
            ORDER BY m.timestamp DESC LIMIT 1
        ) AS last_message,
        (
            SELECT m.timestamp 
            FROM messages m 
            WHERE (m.sender_id = u.id OR m.receiver_id = u.id) 
            ORDER BY m.timestamp DESC LIMIT 1
        ) AS last_message_time,
        (
            SELECT m.sender_id 
            FROM messages m 
            WHERE (m.sender_id = u.id OR m.receiver_id = u.id) 
            ORDER BY m.timestamp DESC LIMIT 1
        ) AS last_message_sender,
        (
            SELECT COUNT(*) 
            FROM messages 
            WHERE receiver_id = $user_id AND sender_id = u.id AND is_read = 0
        ) AS unread_count
    FROM users u
    WHERE u.id != $user_id
    ORDER BY last_message_time DESC
";


$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit;
}

$output = '';

while ($row = mysqli_fetch_assoc($result)) {
    $lastMessageTime = !empty($row['last_message_time'])
        ? date('g:i A', strtotime($row['last_message_time']))
        : 'No messages';

    $unreadCountBadge = $row['unread_count'] > 0
        ? "<span class='text-sm text-white bg-orange-600 py-[2px] px-2 rounded-full'>{$row['unread_count']}</span>"
        : '';

    // Check if the last message is from the logged-in user
    $isYou = $row['last_message_sender'] == $user_id ? "You: " : "";

    $output .= "
        <div class='user-chat flex items-center p-4 h-[70px] hover:bg-gray-100 cursor-pointer chat-item' data-id='{$row['id']}'>
            <img src='" . htmlspecialchars($row['profile_picture']) . "' alt='" . htmlspecialchars($row['display_name']) . "' class='w-10 h-10 rounded-full mr-4' />
            <div class='flex flex-col gap-[3px] w-full'>
                <h3 class='text-gray-800 text-sm font-semibold'>" . htmlspecialchars($row['display_name']) . "</h3>
                <p class='text-xs text-gray-500 w-[160px] overflow-hidden text-ellipsis whitespace-nowrap'>
                    " . (!empty($row['last_message']) ? $isYou . htmlspecialchars($row['last_message']) : 'No messages yet...') . "
                </p>
            </div>
            <div class='flex flex-col items-end w-[40%] gap-2'>
                <span class='text-xs text-gray-400 pb-2'>$lastMessageTime</span>
                $unreadCountBadge
            </div>
        </div>";
}


echo $output;
?>
