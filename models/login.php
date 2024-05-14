<?php


session_start(); // Start session here


include '../config/db_connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT user_id, password FROM tbl_user_credentials WHERE username = ?";

    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $row['user_id'];
            header('Location: ../sites/dashboard.php');
            exit();
        } else {
            // Password is incorrect
            header('Location: ../sites/login.php?invalid');
            exit();
        }
    } else {
        // User not found
        header('Location: ../sites/login.php?error=not_found');
        exit();
    }
} else {
    // Redirect user if they try to access this page directly
    header('Location: ../sites/login.php');
    exit();
}
?>