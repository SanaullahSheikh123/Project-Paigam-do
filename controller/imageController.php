<?php
require './includes/config.php';

if (!empty($_FILES["profile_picture"]["name"])) {
    $target_dir = "./uploads/";
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check === false) {
        $errors['profile_picture'] = "File is not an image.";
    }

    if ($_FILES["profile_picture"]["size"] > 5000000) {
        $errors['profile_picture'] = "Sorry, your file is too large.";
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $errors['profile_picture'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
    }

    if (empty($errors['profile_picture']) && !move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
        $errors['profile_picture'] = "Sorry, there was an error uploading your file.";
    } else {
        $profile_picture = $target_file; 
    }
}
