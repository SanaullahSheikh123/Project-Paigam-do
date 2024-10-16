<?php
session_start();
include '../includes/config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user']['id'];
    $display_name = $_POST['display_name'];
    $desc = $_POST['desc'];
    
    if (isset($_FILES['user_picture']) && $_FILES['user_picture']['error'] === 0) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES['user_picture']['name']);
        $targetFilePath = $targetDir . $fileName;
        move_uploaded_file($_FILES['user_picture']['tmp_name'], $targetFilePath);
        $user_picture = $targetFilePath;
    } else {
        $user_picture = $_SESSION['user']['user_picture'];
    }

    $stmt = $conn->prepare("UPDATE users SET display_name = ?, description = ?, profile_picture = ? WHERE id = ?");
    $stmt->bind_param("sssi", $display_name, $desc, $user_picture, $user_id);

    if ($stmt->execute()) {
        $_SESSION['user']['display_name'] = $display_name;
        $_SESSION['user']['desc'] = $desc;
        $_SESSION['user']['user_picture'] = $user_picture;
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile.";
    }
}
?>
