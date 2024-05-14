<?php

include '../config/db_connection.php';

session_start();

function getUserDetails($user_id, $conn)
{
  $sql = "SELECT * FROM tbl_user_profile WHERE user_id = '$user_id'";

  $emailSql = "SELECT email FROM tbl_user_credentials WHERE user_id = '$user_id'";
  $emailResult = $conn->query($emailSql);
  $emailRow = $emailResult->fetch_assoc();
  $email = $emailRow['email'];

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Add email to the user details array
    $user['email'] = $email;
    return $user;
  } else {
    return null;
  }
}

$user_id = $_SESSION['user_id'];

if (!empty($user_id)) {
  $userDetails = getUserDetails($user_id, $conn);

  if ($userDetails) {
    echo json_encode($userDetails);
  } else {
    echo json_encode(['error' => 'User not found']);
  }
} else {
  echo json_encode(['error' => 'User ID is required']);
}

$conn->close();
?>
