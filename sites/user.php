<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User</title>
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="/assets/global css/index.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

  <?php include "../template/header.php" ?>

  <div class="container-fluid mt-3">
    <div class="card">
      <form id="updateInfoForm" action="../models/updateUserDetails.php" method="POST">
        <div class="card-header bg-info text-white">
          <div class="card-body">User Profile</div>
        </div>
        <div class="card-body">
          <div class="box">
            <div class="box-title text-primary"><b>Personal Information</b></div>
            <hr>
            <div class="row">
              <div class="col-md-3">
                <label class="col-form-label-sm text-dark-emphasis ">Last Name</label>
                <input id="info_lname" name="info_lname" readonly type="text" class="text-proper form-control" placeholder="Last Name">
              </div>
              <div class="col-md-3">
                <label class="col-form-label-sm text-dark-emphasis">First Name</label>
                <input id="info_fname" name="info_fname" readonly type="text" class="text-proper form-control" placeholder="First Name">
              </div>
              <div class="col-md-3">
                <label class="col-form-label-sm text-dark-emphasis">Middle Name</label>
                <input id="info_mname" name="info_mname" type="text" class="text-proper form-control" placeholder="Middle Name">
              </div>
              <div class="col-md-3">
                <label class="col-form-label-sm text-dark-emphasis">Name Extension (eg Jr)</label>
                <input id="info_sname" name="info_sname" type="text" class="text-proper form-control" placeholder="Name Extension">
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <label class="col-form-label-sm text-dark-emphasis">Sex <span class="required text-danger">*</span></label>
                <select id="info_sex" name="info_sex" class="form-control text-proper">
                  <option value="" disabled selected>--</option>
                  <option selected value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
              <div class="col-md-3">
                <label class="col-form-label-sm text-dark-emphasis">Birthday (MM/DD/YYYY) <span class="required text-danger">*</span></label>
                <input id="info_birthday" name="info_birthday" type="date" class="form-control" placeholder="Birthday">
              </div>
              <div class="col-md-3">
                <label class="col-form-label-sm text-dark-emphasis">Civil Status <span class="required text-danger">*</span></label>
                <select id="info_civilstatus" name="info_civilstatus" class="form-control text-proper">
                  <option value="" disabled selected>--</option>
                  <option selected value="Single">Single</option>
                  <option value="Married">Married</option>
                </select>
              </div>
              <div class="col-md-3">
                <label class="col-form-label-sm text-dark-emphasis">Religion <span class="required text-danger">*</span></label>
                <input id="info_religion" name="info_religion" type="text" class="form-control text-proper" placeholder="Religion">
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label class="col-form-label-sm text-dark-emphasis">Place of Birth</label>
                <input id="info_placeofbirth" name="info_placeofbirth" type="text" class="form-control text-proper" placeholder="Place of Birth">
              </div>
            </div>
            <div class="box-title text-primary mt-3"><b>Home Address</b></div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myAddressModal">
              Select Address
            </button>
            <hr>
            <div class="row">
              <div class="col-md-4">
                <label for="" class="col-form-label-sm text-dark-emphasis">Region</label>
                <input id="in_region" name="in_region" type="text" class="form-control text-proper">
              </div>
              <div class="col-md-4">
                <label for="" class="col-form-label-sm text-dark-emphasis">Province</label>
                <input id="in_province" name="in_province" type="text" class="form-control text-proper">
              </div>
              <div class="col-md-4">
                <label for="" class="col-form-label-sm text-dark-emphasis">Municipality/City</label>
                <input id="in_city" name="in_city" type="text" class="form-control text-proper">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="" class="col-form-label-sm text-dark-emphasis">Barangay</label>
                <input id="in_barangay" name="in_barangay" type="text" class="form-control text-proper">
              </div>
              <div class="col-md-6">
                <label class="col-form-label-sm text-dark-emphasis">Building No. | Street | Subdivision</label>
                <input id="in_strt" name="in_strt" type="text" class="form-control text-proper" placeholder="Building No. | Street | Subdivision">
              </div>
            </div>
            <div class="box-title text-primary mt-3"><b>Contact Information</b></div>
            <hr>
            <div class="row">
              <div class="col-md-6">
                <label class="col-form-label-sm text-dark-emphasis">Contact Number <span class="required text-danger">*</span></label>
                <input type="text" id="info_mobile" name="info_mobile" class="form-control text-proper" placeholder="Contact Number" data-inputmask="&quot;mask&quot;: &quot;(09) 99 999 9999&quot;" data-mask="">
              </div>
              <div class="col-md-6">

                <label class="col-form-label-sm text-dark-emphasis">Personal Email <span class="required text-danger">*</span></label>
                <input type="text" id="info_email" name="info_email" class="form-control" placeholder="Personal Email">
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="myAddressModal">
          <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Update Address</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <label class="col-form-label-sm text-dark-emphasis">Region</label>
                    <select id="info_reg" name="info_reg" class="form-control text-proper" onchange="displayProvince(this.value)">
                      <?php
                      include "../config/db_connection.php";

                      $sql = "SELECT * FROM ph_region";
                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                      ?>
                          <option value="<?= $row['regCode'] ?>"><?= $row['regDesc'] ?></option>
                      <?php
                        }
                      } else {
                        echo "0 results";
                      }
                      $conn->close();
                      ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="col-form-label-sm text-dark-emphasis">Province</label>
                    <select id="info_prov" name="info_prov" class="form-control text-proper" onchange="displayMunCity(this.value)">

                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="col-form-label-sm text-dark-emphasis">Municipality/City</label>
                    <select id="info_munc" name="info_munc" class="form-control text-proper" onchange="displayBrgy(this.value)">

                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="col-form-label-sm text-dark-emphasis">Barangay</label>
                    <select id="info_brgy" name="info_brgy" class="form-control text-proper">

                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="btnprofilesave" class="btn btn-primary ">
                  <i class="fa fa-save"></i> Save Address
                </button>
              </div>
            </div>
          </div>
        </div>


        <div class="card-footer mt-2 text-end">
          <button type="submit" id="btnprofilesave" class="btn btn-primary ">
            <i class="fa fa-save"></i> Save Information
          </button>
        </div>
      </form>
    </div>




</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="/assets/js/ph_address.js"></script>
<script src="/assets/js/main.js"></script>

</html>