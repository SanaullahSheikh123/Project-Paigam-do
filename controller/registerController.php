<?php
require '../includes/config.php';
header('Content-Type: application/json');

// Fetch data from the POST request
$username = trim($_POST['username'] ?? "");
$email = trim($_POST['email'] ?? "");
$password = trim($_POST['password'] ?? "");
$confirm_password = trim($_POST['confirm_password'] ?? "");

$errors = [];

// Username validation
if (empty($username)) {
    $errors['username'] = "Username is required.";
} elseif (strlen($username) < 8) {
    $errors['username'] = "Username must be at least 8 characters long.";
} elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
    $errors['username'] = "Username can only contain letters, numbers, and underscores.";
}

// Email validation
if (empty($email)) {
    $errors['email'] = "Please fill the Email field.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email format.";
}

// Password validation
if (empty($password)) {
    $errors['password'] = "Please enter the password field.";
} elseif (strlen($password) < 6) {
    $errors['password'] = "Your password must be at least 6 characters long.";
}

// Confirm password match
if ($password !== $confirm_password) {
    $errors['confirm_password'] = "Password does not match.";
}

if (empty($errors)) {
    $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $errors['username'] = "This username is already taken. Please choose a different one.";
    } else {
        $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $errors['email'] = "This email is already registered.";
        } else {
            $stmt = mysqli_prepare($conn, 
                "INSERT INTO users (username, email, password, setup_completed) VALUES (?, ?, ?, 0)"
            );
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password_hashed);

            if (mysqli_stmt_execute($stmt)) {
                echo json_encode(["success" => true, "message" => "Registration successful!"]);
                exit();
            } else {
                $errors['database'] = "An unexpected error occurred.";
            }
        }
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);

echo json_encode(["success" => false, "errors" => $errors]);
?>
