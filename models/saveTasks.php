<?php
include '../config/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  // Retrieve and sanitize user inputs
  $title = mysqli_real_escape_string($conn, $_POST['inp_title']);
  $description = mysqli_real_escape_string($conn, $_POST['inp_description']);
  $startDate = mysqli_real_escape_string($conn, $_POST['inp_startdate']);
  $endDate = mysqli_real_escape_string($conn, $_POST['inp_enddate']);
  $status = mysqli_real_escape_string($conn, $_POST['inp_status']);

  // Retrieve project_id from URL query parameter
  if (isset($_GET['project_id'])) {
    $project_id = mysqli_real_escape_string($conn, $_GET['project_id']);

    // Insert task into database
    $sql = "INSERT INTO tbl_tasks (project_id, name, description, start_date, end_date, status) VALUES ('$project_id','$title', '$description', '$startDate', '$endDate', '$status')";

    if ($conn->query($sql) === TRUE) {
      include '../models/trackAction.php';
      logsAction("Created", "Task : $title", $conn);
      header('Location: ../sites/task.php?project_id=' . $project_id);
      exit();
    } else {
      // Redirect with error message
      header('Location: ../sites/task.php?error=' . urlencode($conn->error));
      exit();
    }
  } else {
    // Redirect with error message if project_id is not provided
    header('Location: ../sites/task.php?error=' . urlencode('Project ID not provided'));
    exit();
  }
}
?>


<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#taskModal">Create Task</button>

<div class="modal fade" id="taskModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Task</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="../models/saveTasks.php?project_id=<?php echo isset($_GET['project_id']) ? $_GET['project_id'] : ''; ?>" method="POST">
        <!-- Modal body -->
        <div class="modal-body">

          <div class="form-group">
            <label for="title">Task <span class="required text-danger">*</span></label>
            <input type="text" class="form-control" id="title" name="inp_title" required>
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
            <label for="status">Status <span class="required text-danger">*</span></label>
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