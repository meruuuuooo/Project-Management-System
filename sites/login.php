<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>

 <!-- Section: Design Block -->
 <section class="text-center">
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
            <h2 class="fw-bold mb-5 text-white">Login now</h2>
            <form action="../models/login.php" method="POST" >
 
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="username" class="form-control" name="username" required/>
                <label class="form-label text-white" for="username">Username</label>
              </div>

              <!-- Password input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" id="password" class="form-control" name="password" required/>
                <label class="form-label text-white" for="password" >Password</label>
              </div>

              <!-- Submit button -->
              <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
                Sign up
              </button>

              <!-- Register buttons -->
              <div class="text-center">
                <p class="mb-0 text-white">Don't have an account? <a href="signup.php" class="text-white-50 fw-bold">Sign Up</a>
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

</html>