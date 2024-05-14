<?php

include '../config/db_connection.php';

// Create an associative array to store response data
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Validate password
    if ($password != $confirm_password) {
        $response['error'] = 'password_mismatch';
    } elseif (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) {
        $response['error'] = 'invalid_password';
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user credentials into tbl_user_credentials
        $sql_credentials = "INSERT INTO tbl_user_credentials (username, password, email, role) VALUES (?, ?, ?, 'user')";
        $stmt_credentials = $conn->prepare($sql_credentials);
        $stmt_credentials->bind_param("sss", $username, $hashed_password, $email);

        // Execute the credentials insertion query
        if ($stmt_credentials->execute()) {
            // Retrieve the last inserted user_id
            $user_id = $stmt_credentials->insert_id;

            // Insert user profile data into tbl_user_profile
            $sql_profile = "INSERT INTO tbl_user_profile (user_id, last_name, first_name, middle_name) VALUES (?, ?, ?, ?)";
            $stmt_profile = $conn->prepare($sql_profile);
            $stmt_profile->bind_param("isss", $user_id, $lastname, $firstname, $middlename);

            // Execute the profile insertion query
            if ($stmt_profile->execute()) {
                // Set success message in response
                $response['success'] = 'User registered successfully';
            } else {
                // If profile insertion fails, delete the previously inserted credentials
                $sql_delete_credentials = "DELETE FROM tbl_user_credentials WHERE user_id = ?";
                $stmt_delete_credentials = $conn->prepare($sql_delete_credentials);
                $stmt_delete_credentials->bind_param("i", $user_id);
                $stmt_delete_credentials->execute();

                $response['error'] = 'profile_insertion_failed';
            }
        } else {
            // If credentials insertion fails
            $response['error'] = 'credentials_insertion_failed';
        }
    }
}

// Return the response as JSON
echo json_encode($response);
?>
