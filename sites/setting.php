<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Setting</title>
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="/assets/global css/index.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>

  <?php include "../template/header.php" ?>


  <div class="container-fluid mt-3">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h5>
            Account Setting
          </h5>
        </div>
        <div class="card-body">
          <div class="box">
            <div class="box-title">Password Setting</div>
            <hr>
            <form action="../models/resetPassword.php" method="POST">
              <div class="row">
                <div class="col-md-3">
                  <label class="col-form-label-sm text-dark-emphasis ">Old Password <span class="required text-danger">*</span></label>
                  <input id="info_old_pass" type="password" class="text-proper form-control " placeholder="Old Password">
                </div>
                <div class="col-md-3">
                  <label class="col-form-label-sm text-dark-emphasis ">New Password <span class="required text-danger">*</span></label>
                  <input onkeyup="checkPassFrmt()" id="info_new_pass" value="" type="password" class=" form-control  " placeholder="New Password">
                </div>
                <div class="col-md-3">
                  <label class="col-form-label-sm text-dark-emphasis ">Retry Password <span class="required text-danger">*</span></label>
                  <input onkeyup="checkRetPassFrmt()" id="info_ret_pass" value="" type="password" class="text-proper form-control  text-proper" placeholder="Re Retry Password">
                </div>
                <div class="col-md-3">
                  <button id="btnsavePass" onclick="savePass();" type="button" class="btn btn-primary">
                    <i class="fa fa-save"></i> Save
                  </button>
                </div>
              </div>
            </form>
            <div class="mt-3" id="mP0" class="hide" style="font-style: italic;">
              <b>Note: Password should contain(s) the following</b>
              <ul style="color:red">
                <li id="mP1">Matched New and Retry New - Password</li>
                <li id="mP2">At least 8 characters in length.</li>
                <li id="mP3">Contain alphabetic characters (e.g. A-Z, a-z).</li>
                <li id="mP4">Have at least one numerical character (e.g. 0-9).</li>
              </ul>
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myLogsModal">
                View Logs
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="myLogsModal">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Logs</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <table class="table table-hover table-bordered" id="logsTable">
            <thead class="table-success">
              <tr class="text-center">
                <th>Log ID</th>
                <th>User ID</th>
                <th>Action</th>
                <th>Description</th>
                <th>timestamp</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


</body>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="/assets/js/main.js"></script>

</html>