<?php

include '../config/db_connection.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $title = $_POST['inp_title'];
  $description = $_POST['inp_description'];
  $startDate = $_POST['inp_startdate'];
  $endDate = $_POST['inp_enddate'];
  $status = $_POST['inp_status'];

  // Retrieve user ID from session
  $user_id = $_SESSION['user_id'];

  $sql = "INSERT INTO tbl_projects (name, description, start_date, end_date, status, manager_id) VALUES ('$title', '$description', '$startDate', '$endDate', '$status', '$user_id')";

  if ($conn->query($sql) === TRUE) {
    include '../models/trackAction.php';
    logsAction("Created", "Project : $title", $conn);
    header('Location: ../sites/dashboard.php?success');
  } else {
    header('Location: ../sites/dashboard.php?error');
  }
}

?>

<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">Create Project</button>

<div class="modal fade" id="createModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Project</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="../models/saveProjects.php" method="POST">
        <!-- Modal body -->
        <div class="modal-body">

          <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="inp_title" required>
          </div>
          <div class="form-group">
            <label for="descriptions">Description:</label>
            <textarea class="form-control" id="descriptions" name="inp_description" rows="3" required></textarea>
          </div>
          <div class="form-group">
            <label for="deadline">Start Date:</label>
            <input type="date" class="form-control" id="startDate" name="inp_startdate" required>
          </div>
          <div class="form-group">
            <label for="deadline">End Date:</label>
            <input type="date" class="form-control" id="endDate" name="inp_enddate" required>
          </div>
          <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="inp_status" required>
              <option value="Pending">Pending</option>
              <option value="In Progress">In Progress</option>
              <option value="Completed">Completed</option>
            </select>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>

      </form>
    </div>
  </div>
</div>