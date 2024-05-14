<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="/assets/global css/index.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>

  <!-- Section: Design Block -->
  <section class="text-left">
    <!-- Background image -->
    <div class="p-5 bg-image" style="
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
        height: 300px;
        "></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong bg-dark  " style="
        margin-top: -100px;
        backdrop-filter: blur(30px);
        ">
      <div class="card-body py-5 px-md-5">

        <div class="row d-flex justify-content-center">
          <div class="col-lg-8">
            <h2 class="fw-bold mb-5 text-white">Sign up now</h2>
            <form id="signupForm" action="../models/signup.php" method="POST">

              <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="username" class="form-control" name="username" placeholder="Enter username..." required />
                <label class="form-label text-white" for="username">Username</label>
              </div>

              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row">
                <div class="col-md-5 mb-4">
                  <div data-mdb-input-init class="form-outline">
                    <input type="text" id="lastname" class="form-control" placeholder="Enter lastname..." name="lastname" required />
                    <label class="form-label text-white" for="lastname">Last name</label>
                  </div>
                </div>
                <div class="col-md-5 mb-4">
                  <div data-mdb-input-init class="form-outline">
                    <input type="text" id="firstname" class="form-control" placeholder="Enter firstname..." name="firstname" required />
                    <label class="form-label text-white" for="firstname">First name</label>
                  </div>
                </div>
                <div class="col-md-2 mb-4">
                  <div data-mdb-input-init class="form-outline">
                    <input type="text" id="middlename" class="form-control" placeholder="Enter middle name..." name="middlename" />
                    <label class="form-label text-white" for="firstname">Middle name</label>
                  </div>
                </div>
              </div>

              <!-- Email input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" id="email" class="form-control" placeholder="Enter Email..." name="email" required />
                <label class="form-label text-white" for="email">Email address</label>
              </div>
              <!-- Password input -->
              <div class="row">
                <div class="col">
                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="password" class="form-control" placeholder="Enter Password..." name="password" required />
                    <label class="form-label text-white" for="password">Password</label>
                  </div>
                </div>
                <div class="col">
                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="password" class="form-control" placeholder="Confirm Password..." name="confirm_password" required />
                    <label class="form-label text-white" for="password">Confirm Password</label>
                  </div>
                </div>
                <!-- Info section for creating a password -->
                <small class="form-text text-white">
                  Password should contain:
                  <ul class="text-white">
                    <li>At least 8 characters in length.</li>
                    <li>Alphabetic characters (A-Z, a-z).</li>
                    <li>At least one numerical character (0-9).</li>
                  </ul>
                </small>
              </div>



              <!-- Submit button -->
              <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
                Sign up
              </button>

              <!-- Register buttons -->
              <div class="text-center">
                <p class="mb-0 text-white">Already have an account? <a href="login.php" class="text-white-50 fw-bold">Login</a>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Design Block -->


</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="/assets/js/main.js"></script>
</html>