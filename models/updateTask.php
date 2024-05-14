<?php


if (isset($_POST['task_id']) && isset($_POST['formTaskData'])) {
  include "../config/db_connection.php";

  $task_id = $_POST['task_id'];

  $serializedFormData = $_POST['formTaskData'];

  parse_str($serializedFormData, $formDataArray);

  $title = $formDataArray['inp_title'];
  $description = $formDataArray['inp_description'];
  $startDate = $formDataArray['inp_startdate'];
  $endDate = $formDataArray['inp_enddate'];
  $status = $formDataArray['inp_status'];


  $sql = "UPDATE tbl_tasks SET name = '$title', description = '$description', start_date = '$startDate', end_date = '$endDate', status = '$status' WHERE task_id = '$task_id'";

  if ($conn->query($sql) === TRUE) {
    include "../models/trackAction.php";
    logsAction("Updated", "Task : $title", $conn);
    echo json_encode(['success' => 'Task updated successfully']);
  } else {
    echo json_encode(['error' => 'Error updating Task']);
  }
}
