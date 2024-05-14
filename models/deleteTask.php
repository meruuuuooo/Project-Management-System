<?php

if (isset($_POST['task_id']) && !empty($_POST['task_id'])) {
  $task_id = $_POST['task_id'];
  deleteTask($task_id);
}

function deleteTask($task_id)
{
  include '../config/db_connection.php';

  $getTaskSql = "SELECT name FROM tbl_tasks WHERE task_id = '$task_id'";
  $taskResult = $conn->query($getTaskSql);
  $task = $taskResult->fetch_assoc()['name'];

  // Delete tasks associated with the project
  $delete_tasks_sql = "DELETE FROM tbl_tasks WHERE task_id = '$task_id'";
  $tasks_deleted = $conn->query($delete_tasks_sql);

  if ($tasks_deleted) {
    include "../models/trackAction.php";
    logsAction("Deleted", "Task : $task", $conn);
    echo "Task deleted successfully";
  } else {
    echo "Error occurred during deletion";
  }
}
