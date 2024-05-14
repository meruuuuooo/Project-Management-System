<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="/assets/global css/index.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
  <?php include '../template/header.php'; ?>

  <div class="container-fluid mt-4" id="taskTable">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <div class="card-body d-flex justify-content-between ">
            <input type="text" onkeyup="searchProject(this.value)" class="form-control-sm" id="search" placeholder="Search..." name="search">
            <?php include '../models/saveProjects.php'; ?>
          </div>
        </div>
        <div class="card-body" style="height: 550px;">
          <?php
          if (isset($_GET['success'])) {
          ?>
            <div class="alert alert-success alert-dismissible fade show">
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              <strong>Success!</strong> New Project Added.
            </div>
          <?php
          } elseif (isset($_GET['invalid'])) {
          ?>
            <div class="alert alert-info alert-dismissible fade show">
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              <strong>Info!</strong> Something went wrong.
            </div>
            <hr>
          <?php
          }
          ?>
          <div>
            <table class="table table-hover .table-borderless table-responsive" style="width: 1269px">
              <thead class="text-center table-primary">
                <tr>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Status</th>
                  <th>Tasks</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="projectTable">
                <?php include '../models/searchProject.php'; ?>
              </tbody>
            </table>
          </div>

        </div>
        <div class="card-footer">

        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="updateModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Update Project</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form id="updateForm" action="../models/updateProject.php" method="POST">
          <!-- Modal body -->
          <div class="modal-body">

            <div class="form-group">
              <label for="title">Title:</label>
              <input type="text" class="form-control" id="up_title" name="inp_title">
            </div>
            <div class="form-group">
              <label for="descriptions">Description:</label>
              <textarea class="form-control" id="up_descriptions" name="inp_description" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="deadline">Start Date:</label>
              <input type="date" class="form-control" id="up_startDate" name="inp_startdate">
            </div>
            <div class="form-group">
              <label for="deadline">End Date:</label>
              <input type="date" class="form-control" id="up_endDate" name="inp_enddate">
            </div>
            <div class="form-group">
              <label for="status">Status:</label>
              <select class="form-control" id="up_status" name="inp_status">
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