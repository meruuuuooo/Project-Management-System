<?php
session_start();

include '../config/db_connection.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT user_id, password FROM tbl_user_credentials WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $row['user_id'];
            $response['success'] = "Login successful!";
        } else {
            $response['error'] = "Invalid username or password.";
        }
    } else {
        $response['error'] = "User not found.";
    }

    echo json_encode($response);
} else {
    $response['error'] = "Invalid request method.";
    echo json_encode($response);
}

$conn->close();
?>
