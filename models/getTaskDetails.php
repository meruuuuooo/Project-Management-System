<?php

session_start();

if (isset($_POST['task_id'])) {
  $task_id = $_POST['task_id'];

  include '../config/db_connection.php';

  function getTaskDetails($task_id, $conn) {
    $sql = "SELECT * FROM tbl_tasks WHERE task_id = '$task_id'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $task_id = $result->fetch_assoc();
      return $task_id;
    } else {
      return null;
    }
  }


  if (!empty($task_id)) {
    $task = getTaskDetails($task_id, $conn);

    if ($task) {
      echo json_encode($task);
    } else {
      echo json_encode(['error' => 'Task not found']);
    }

  } else {
    echo json_encode(['error' => 'Task ID is required']);
  }

  $conn->close();

}
?>