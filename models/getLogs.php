<?php

session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];

  include "../config/db_connection.php";

  $sql = "SELECT * FROM tbl_logs WHERE user_id = '$user_id' ORDER BY timestamp DESC";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Array to store log data
    $logs = array();

    // Fetch log data and add to the array
    while ($row = $result->fetch_assoc()) {
      $logs[] = $row;
    }

    // Encode the array as JSON and output it
    echo json_encode($logs);
  } else {
    // No logs found
    echo json_encode(array("message" => "No logs found"));
  }
}
