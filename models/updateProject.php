<?php

if (isset($_POST['project_id']) && isset($_POST['formData'])) {
  include '../config/db_connection.php';

  $project_id = $_POST['project_id'];

  $serializedFormData = $_POST['formData'];

  parse_str($serializedFormData, $formDataArray);

  $title = $formDataArray['inp_title'];
  $description = $formDataArray['inp_description'];
  $startDate = $formDataArray['inp_startdate'];
  $endDate = $formDataArray['inp_enddate'];
  $status = $formDataArray['inp_status'];

  $sql = "UPDATE tbl_projects SET name = '$title', description = '$description', start_date = '$startDate', end_date = '$endDate', status = '$status' WHERE project_id = '$project_id'";

  if ($conn->query($sql) === TRUE) {
    include '../models/trackAction.php';
    logsAction("Updated", "Project : $title", $conn);
    echo json_encode(['success' => true, "message" => 'Project updated successfully']);
  } else {
    echo json_encode(['error' => false, "message" => 'Error updating project']);
  }
}
