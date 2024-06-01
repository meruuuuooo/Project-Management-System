<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>tasks</title>
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="/assets/global css/index.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body>

  <?php include '../template/header.php'; ?>

  <div class="container-fluid mt-2">
    <div class="col">
      <div class="card mt-2">
        <div class="card-header">
          <div class="card-body d-flex justify-content-between">
            <a href="/sites/dashboard.php">
              <button type="button" class="btn btn-primary">
                Go Back </button>
            </a>
            <?php include '../models/saveTasks.php'; ?>
          </div>
        </div>
        <div class="card-body" style="height: 550px;">
          <div>
            <table class="table table-hover table-borderless table-responsive" style="width: 1269px">
              <thead class="text-center table-primary">
                <tr>
                  <th>Task</th>
                  <th>Description</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php include '../models/displayTasks.php'; ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer">

        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="updateTaskModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Update Task</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form id="updateTaskForm" action="../models/updateTask.php" method="POST">
          <!-- Modal body -->
          <div class="modal-body">

            <div class="form-group">
              <label for="title">Task <span class="required text-danger">*</span></label>
              <input type="text" class="form-control" id="task_title" name="inp_title">
            </div>
            <div class="form-group">
              <label for="descriptions">Description </label>
              <textarea class="form-control" id="task_descriptions" name="inp_description" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="deadline">Start Date <span class="required text-danger">*</span></label>
              <input type="date" class="form-control" id="task_startDate" name="inp_startdate">
            </div>
            <div class="form-group">
              <label for="deadline">End Date <span class="required text-danger">*</span></label>
              <input type="date" class="form-control" id="task_endDate" name="inp_enddate">
            </div>
            <div class="form-group">
              <label for="status">Status <span class="required text-danger">*</span></label>
              <select class="form-control" id="task_status" name="inp_status">
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

</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="/assets/js/main.js"></script>

</html>