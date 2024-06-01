<?php

include '../config/db_connection.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $title = $_POST['inp_title'];
  $project_manager = $_POST['inp_manager'];
  $description = $_POST['inp_description'] ?? 'none'; // Handle null description
  $startDate = $_POST['inp_startdate'];
  $endDate = $_POST['inp_enddate'];
  $budget = $_POST['inp_budget'] ?? 0;
  $client = $_POST['inp_client'] ?? '';
  $priority = $_POST['inp_priority'] ?? 'Medium';

  // Retrieve user ID from session
  $user_id = $_SESSION['user_id'];

  // Prepare the SQL statement to prevent SQL injection
  $sql = "INSERT INTO tbl_projects (name, project_manager, description, start_date, end_date, manager_id, budget, client, priority) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssdsss", $title, $project_manager, $description, $startDate, $endDate, $user_id, $budget, $client, $priority);

  if ($stmt->execute()) {
    include '../models/trackAction.php';
    logsAction("Created", "Project : $title", $conn);
    header('Location: ../sites/dashboard.php?status=success&message=' . urlencode('Project created successfully'));
  } else {
    header('Location: ../sites/dashboard.php?status=error&message=' . urlencode('Error creating project'));
  }

  $stmt->close();
  $conn->close();
}
?>

<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">Create Project</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="createModal" aria-labelledby="createModal" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Add Project</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../models/saveProjects.php" method="POST">
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-group">
                <label for="title">Project <span class="required text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="inp_title" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="projectManager">Project Manager <span class="required text-danger">*</span></label>
                <input type="text" class="form-control" id="projectManager" name="inp_manager" required>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-12">
              <div class="form-group">
                <label for="descriptions">Description </label>
                <textarea class="form-control" id="descriptions" name="inp_description" rows="4"></textarea>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-group mb-2">
                <label for="startDate">Start Date <span class="required text-danger">*</span></label>
                <input type="date" class="form-control" id="startDate" name="inp_startdate" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="endDate">End Date <span class="required text-danger">*</span></label>
                <input type="date" class="form-control" id="endDate" name="inp_enddate" required>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-4">
              <div class="form-group">
                <label for="projectBudget" class="form-label">Budget <span class="required text-danger">*</span></label>
                <input type="number" class="form-control" id="projectBudget" name="inp_budget" min="0" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="projectClient" class="form-label">Client <span class="required text-danger">*</span></label>
                <input type="text" class="form-control" id="projectClient" name="inp_client" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="projectPriority" class="form-label">Priority <span class="required text-danger">*</span></label>
                <select class="form-control" id="projectPriority" name="inp_priority" required>
                  <option>Low</option>
                  <option>Medium</option>
                  <option>High</option>
                </select>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- <div class="modal fade" id="createmodal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Add Project</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="../models/saveProjects.php" method="POST">
        <div class="modal-body">

          <div class="form-group">
            <label for="title">Project <span class="required text-danger">*</span></label>
            <input type="text" class="form-control" id="title" name="inp_title" required>
          </div>
          <div class="form-group">
            <label for="projectManager">Project Manager <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="projectManager" name="inp_manager" required>
          </div>
          <div class="form-group">
            <label for="descriptions">Description </label>
            <textarea class="form-control" id="descriptions" name="inp_description" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="deadline">Start Date <span class="required text-danger">*</span></label>
            <input type="date" class="form-control" id="startDate" name="inp_startdate" required>
          </div>
          <div class="form-group">
            <label for="deadline">End Date <span class="required text-danger">*</span></label>
            <input type="date" class="form-control" id="endDate" name="inp_enddate" required>
          </div>
          <div class="form-group">
            <label for="projectBudget">Budget</label>
            <input type="number" class="form-control" id="projectBudget" name="inp_budget" min="0">
          </div>
          <div class="form-group">
            <label for="projectPriority">Priority</label>
            <select class="form-control" id="projectPriority" name="inp_priority">
              <option>Low</option>
              <option>Medium</option>
              <option>High</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>

      </form>
    </div>
  </div>
</div> -->