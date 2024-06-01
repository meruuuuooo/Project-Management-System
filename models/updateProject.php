<?php

if (isset($_POST['project_id']) && isset($_POST['formData'])) {
  include '../config/db_connection.php';

  $project_id = $_POST['project_id'];
  $serializedFormData = $_POST['formData'];

  parse_str($serializedFormData, $formDataArray);

  $title = $formDataArray['inp_title'];
  $project_manager = $formDataArray['inp_manager'];
  $description = $formDataArray['inp_description'] ?? 'none';
  $startDate = $formDataArray['inp_startdate'];
  $endDate = $formDataArray['inp_enddate'];
  $budget = $formDataArray['inp_budget'] ?? 0;
  $client = $formDataArray['inp_client'] ?? '';
  $priority = $formDataArray['inp_priority'] ?? 'Medium';


  // Prepare the SQL statement to prevent SQL injection
  $sql = "UPDATE tbl_projects 
          SET name = ?, project_manager = ?, description = ?, start_date = ?, end_date = ?, budget = ?, client = ? , priority = ?
          WHERE project_id = ?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssdssi", $title, $project_manager, $description, $startDate, $endDate, $budget, $client, $priority, $project_id);

  if ($stmt->execute()) {
    include '../models/trackAction.php';
    logsAction("Updated", "Project : $title", $conn);
    echo json_encode(['success' => true, "message" => 'Project updated successfully']);
  } else {
    echo json_encode(['error' => true, "message" => 'Error updating project']);
  }

  $stmt->close();
  $conn->close();
} else {
  echo json_encode(['error' => true, "message" => 'Invalid request']);
}
?>
