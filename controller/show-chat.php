<?php
session_start();
include('../includes/config.php');

$chat_user_id = $_POST['user'];

$stmt = $conn->prepare("SELECT * FROM messages WHERE sender_id = ?");

$stmt->bind_param('s', $chat_user_id);
$stmt->execute();
$result = $stmt->get_result();
$messagesReceiver= [];
while ($row = $result->fetch_assoc()) {
    $messagesReceiver[$row["id"]] = $row;
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param('s', $chat_user_id);
$stmt->execute();
$result = $stmt->get_result();

$user_profile= [];
$row = $result->fetch_assoc();


echo json_encode([$messagesReceiver]+$row);


?>