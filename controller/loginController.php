<?php
session_start();
include('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param('s', $_POST['account']);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($_POST['password'], $user['password'])) {

        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'username' => $user['username'],
            'setup_completed' => $user['setup_completed'],
            'display_name' => $user['display_name'],
            'desc' => $user['description'],
            'created_at' => $user['created_at'],
            'user_picture' => $user['profile_picture'],
            'logged_in' => true
        ];

 
        if (!empty($_POST['remember'])) {
            setcookie('user', $user['email'], time() + 86400 * 30, "/");
        }

        echo json_encode(['success' => true]);


    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
    }

    $stmt->close();
    $conn->close();
}
