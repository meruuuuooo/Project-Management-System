<?php

session_start();

if (isset($_POST['project_id'])) {
  $project_id = $_POST['project_id'];

  include '../config/db_connection.php';

  function getProjectDatails($project_id, $conn) {
    $sql = "SELECT * FROM tbl_projects WHERE project_id = '$project_id'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $project = $result->fetch_assoc();
      return $project;
    } else {
      return null;
    }
  }


  if (!empty($project_id)) {
    $project = getProjectDatails($project_id, $conn);

    if ($project) {
      echo json_encode($project);
    } else {
      echo json_encode(['error' => 'Project not found']);
    }

  } else {
    echo json_encode(['error' => 'Project ID is required']);
  }

  $conn->close();

}
?>