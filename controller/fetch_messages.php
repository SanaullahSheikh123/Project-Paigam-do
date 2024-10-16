<?php
session_start();
include '../includes/config.php';

$user_id = $_SESSION['user']['id'];
$chat_partner_id = $_SESSION['chat_partner_id'];

$query = "
    SELECT 
        m.message, 
        m.timestamp, 
        m.sender_id, 
        u.profile_picture, 
        u.display_name
    FROM messages m
    JOIN users u ON u.id = m.sender_id
    WHERE 
        (m.sender_id = ? AND m.receiver_id = ?)
        OR (m.sender_id = ? AND m.receiver_id = ?)
    ORDER BY m.timestamp ASC
";

$stmt = $conn->prepare($query);
$stmt->bind_param('iiii', $user_id, $chat_partner_id, $chat_partner_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

$output = '';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $isSender = $row['sender_id'] == $user_id;
        $time = date('g:i A', strtotime($row['timestamp']));
        $formattedDate = (date('Y-m-d') == date('Y-m-d', strtotime($row['timestamp'])))
            ? 'Today'
            : date('F j', strtotime($row['timestamp']));

        if ($isSender) {
            // Message from the logged-in user (right-aligned)
            $output .= "
                <div class='message flex items-center justify-end gap-2 w-full py-2'>
                    <div class='flex flex-col items-end'>
                        <div class='text rounded-full shadow-xs bg-purple-600 py-2 px-6'>
                            <span class='text-white text-sm'>" . htmlspecialchars($row['message']) . "</span>
                        </div>
                        <div class='time'>
                            <span class='text-xs text-gray-700 pl-2'>{$formattedDate}, $time</span>
                        </div>
                    </div>
                    <div class='status size-4 bg-purple-600 mt-4 rounded-full'></div>
                </div>
            ";
        } else {
            // Message from the chat partner (left-aligned)
            $output .= "
                <div class='message flex items-center gap-2 w-full py-2'>
                    <div class='status size-4 bg-slate-50 mt-4 rounded-full'></div>
                    <div class='flex flex-col'>
                        <div class='text rounded-full shadow-xs bg-slate-50 py-2 px-6'>
                            <span class='text-sm'>" . htmlspecialchars($row['message']) . "</span>
                        </div>
                        <div class='time'>
                            <span class='text-xs text-gray-700 pl-2'>{$formattedDate}, $time</span>
                        </div>
                    </div>
                </div>
            ";
        }
    }
} else {
    // No messages found
    $output = "
        <div class='no-messages flex items-center justify-center h-full'>
            <p class='text-gray-500 text-sm'>No messages yet. Start the conversation!</p>
        </div>
    ";
}

// Mark messages as read
$stmt = $conn->prepare("
    UPDATE messages 
    SET is_read = 1
    WHERE sender_id = ? AND receiver_id = ?
");
$stmt->bind_param('ii', $chat_partner_id, $user_id);
$stmt->execute();

echo $output;

$stmt->close();
$conn->close();
?>
