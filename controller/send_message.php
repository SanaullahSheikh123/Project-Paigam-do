<?php
include '../includes/config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sender_id = $_SESSION['user']['id'];
    $receiver_id = $_SESSION['chat_partner_id'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $sender_id, $receiver_id, $message);

    if ($stmt->execute()) {
        echo 'Message sent successfully';
    } else {
        echo 'Error: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
