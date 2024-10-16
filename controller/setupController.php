<?php
session_start();
include('../includes/config.php');

$errors = [];
$response = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['user']['id'])) {
        $response['success'] = false;
        $response['message'] = "You need to log in to update your profile.";
        echo json_encode($response);
        exit;
    }

    $user_id = $_SESSION['user']['id'];
    $display_name = trim($_POST['display_name']) ?? '';
    $profile_picture = './assets/images/guest.svg'; // Default picture

    // Validate display name
    if (empty($display_name)) {
        $errors['display_name'] = "Please enter your display name.";
    } elseif (strlen($display_name) > 50) {
        $errors['display_name'] = "Your display name must not exceed 50 characters.";
    }

    // Validate profile picture
    if (!empty($_FILES["profile_picture"]["name"])) {
        $target_dir = "../uploads/";
        $file_name = uniqid() . '_' . basename($_FILES["profile_picture"]["name"]);
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is a valid image
        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        if ($check === false) {
            $errors['profile_picture'] = "Please upload a valid image file.";
        }

        // Check file size
        if ($_FILES["profile_picture"]["size"] > 5000000) {
            $errors['profile_picture'] = "The file size must not exceed 5MB.";
        }

        // Check file type
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
            $errors['profile_picture'] = "Only JPG, JPEG, and PNG formats are allowed.";
        }

        // Attempt to upload the file if there are no errors
        if (empty($errors)) {
            if (!move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                $errors['profile_picture'] = "There was an error uploading your image. Please try again.";
            } else {
                $profile_picture = './uploads/' . $file_name; // Save relative path for DB
            }
        }
    }

    // If there are no errors, update the user's profile
    if (empty($errors)) {
        $stmt = $conn->prepare("UPDATE users SET display_name = ?, profile_picture = ?, setup_completed = 1 WHERE id = ?");
        $stmt->bind_param("ssi", $display_name, $profile_picture, $user_id);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "Your profile has been updated successfully.";
            $_SESSION['user']['setup_completed'] = 1;
            $_SESSION['user']['user_picture'] = $profile_picture;
        } else {
            $response['success'] = false;
            $response['message'] = "An error occurred while updating your profile: " . $conn->error;
        }
        $stmt->close();
    } else {
        $response['success'] = false;
        $response['errors'] = $errors; // Return validation errors
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
