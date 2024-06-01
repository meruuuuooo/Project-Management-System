<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project</title>
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="/assets/global css/index.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

</head>

<body>
  <?php include '../template/header.php'; ?>

  <div class="container-fluid mt-2" id="taskTable">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <div class="card-body d-flex justify-content-between ">
            <input type="text" onkeyup="searchProject(this.value)" class="form-control-sm" id="search" placeholder="Search..." name="search">
            <?php include '../models/saveProjects.php'; ?>
          </div>
        </div>
        <div class="card-body" style="height: 550px;">
          <table class="table table-hover table-borderless table-responsive" style="width: 1269px">
            <thead class="text-center table-primary">
              <tr>
                <th>Project</th>
                <th>Manager</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Budget</th>
                <th>Client</th>
                <th>Priority</th>
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
    </div>
  </div>



  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="updateModal" aria-labelledby="updateModal" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Update Project</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="updateForm" action="../models/updateProject.php" method="POST">
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-group">
                <label for="up_title">Project <span class="required text-danger">*</span></label>
                <input type="text" class="form-control" id="up_title" name="inp_title" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="up_projectManager">Project Manager <span class="required text-danger">*</span></label>
                <input type="text" class="form-control" id="up_projectManager" name="inp_manager" required>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-12">
              <div class="form-group">
                <label for="up_descriptions">Description </label>
                <textarea class="form-control" id="up_descriptions" name="inp_description" rows="4"></textarea>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-group mb-2">
                <label for="up_startDate">Start Date <span class="required text-danger">*</span></label>
                <input type="date" class="form-control" id="up_startDate" name="inp_startdate" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="up_endDate">End Date <span class="required text-danger">*</span></label>
                <input type="date" class="form-control" id="up_endDate" name="inp_enddate" required>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-4">
              <div class="form-group">
                <label for="up_projectBudget" class="form-label">Budget <span class="required text-danger">*</span></label>
                <input type="number" class="form-control" id="up_projectBudget" name="inp_budget" min="0" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="up_projectClient" class="form-label">Client <span class="required text-danger">*</span></label>
                <input type="text" class="form-control" id="up_projectClient" name="inp_client" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="up_projectPriority" class="form-label">Priority <span class="required text-danger">*</span></label>
                <select class="form-control" id="up_projectPriority" name="inp_priority" required>
                  <option>Low</option>
                  <option>Medium</option>
                  <option>High</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



  <!-- Modal for displaying tasks -->
  <!-- <div class="modal fade" id="tasksModal" tabindex="-1" role="dialog" aria-labelledby="tasksModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tasksModalLabel">Tasks</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-borderless table-responsive">
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
                        <tbody id="tasksTable">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> -->


</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="/assets/js/main.js"></script>

</html>