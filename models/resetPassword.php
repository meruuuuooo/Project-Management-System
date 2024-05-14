<?php

session_start();

if (isset($_POST['oldPassword']) && isset($_POST['newPassword'])) {

  include "../config/db_connection.php";
  $old_pass = $_POST['oldPassword'];
  $new_pass = $_POST['newPassword'];

  $user_id = $_SESSION['user_id'];

  $sql = "SELECT password FROM tbl_user_credentials WHERE user_id = $user_id";

  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];

    // Verify password
    if (password_verify($old_pass, $hashed_password)) {
      // Password is correct, update password
      $new_hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);

      $sql = "UPDATE tbl_user_credentials SET password = '$new_hashed_password' WHERE user_id = $user_id";

      if ($conn->query($sql) === TRUE) {
        echo "Password updated successfully";
      } else {
        echo "Error updating password: " . $conn->error;
      }
    } else {
      // Password is incorrect
      echo "Old password is incorrect";
    }
  } else {
    // User not found
    echo "User not found";
  }
}
