<?php

include "../config/db_connection.php";



function logsAction($action, $detail, $conn)
{
  session_start();

  $user_id = $_SESSION['user_id'];

  date_default_timezone_set('Asia/Manila');

  // Get the current date and time
  $currentDateTime = date('Y-m-d h:i:s A');

  // Prepare and execute the SQL query to insert the action into the tbl_logs table
  $sql = "INSERT INTO tbl_logs (user_id, action, detail, timestamp) VALUES ('$user_id','$action', '$detail', '$currentDateTime')";
  if ($conn->query($sql) === TRUE) {
    // Action logged successfully
    return true;
  } else {
    // Error logging action
    return false;
  }
}
