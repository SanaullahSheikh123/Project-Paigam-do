<?php

session_start();
include('../includes/config.php');
$stmt = $conn->prepare("UPDATE users SET online=0 WHERE id = ?");
$stmt->bind_param('i', $_SESSION['user']['id']);
$stmt->execute();

session_destroy();
header("Location: ../");
