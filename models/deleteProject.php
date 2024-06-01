<?php

// Ensure project_id is set and not empty
if (isset($_POST['project_id']) && !empty($_POST['project_id'])) {
  $project_id = $_POST['project_id'];
  deleteProject($project_id);
}

function deleteProject($project_id)
{
  include '../config/db_connection.php';

  $getProjectNameSql = "SELECT name FROM tbl_projects WHERE project_id = '$project_id'";
  $projectNameResult = $conn->query($getProjectNameSql);
  $projectName = $projectNameResult->fetch_assoc()['name'];

  $delete_tasks_sql = "DELETE FROM tbl_tasks WHERE project_id = '$project_id'";
  $tasks_deleted = $conn->query($delete_tasks_sql);

  $delete_project_sql = "DELETE FROM tbl_projects WHERE project_id = '$project_id'";
  $project_deleted = $conn->query($delete_project_sql);


  if ($tasks_deleted && $project_deleted && $projectName) {
    include '../models/trackAction.php';
    logsAction("Deleted", "Project : $projectName", $conn); 
    $response = array("success" => true, "message" => "Project deleted successfully");
  } else {
    $response = array("success" => false, "message" => "Error occurred during deletion");
  }

  // Convert the response array to JSON and echo it
  echo json_encode($response);
}
