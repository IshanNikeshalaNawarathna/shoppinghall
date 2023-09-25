<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Hall | Sgin In | Sgin Up</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="icon" href="resocess/webLogo/logo.jpg">
</head>

<body class="main-body">



  <div class="container-fluid vh-100 d-flex justify-content-center">
    <div class="row align-content-center">

      <div class="col-8 col-lg-8 offset-2 offset-lg-2 shadow rounded-4">
        <div class="row">


          <!-- heder -->
          <div class="col-12">
            <div class="row">
              <div class="col-12 logo mb-2 mt-4"></div>
              <div class="col-12">
                <!-- <p class="text-center txt1">Hi! Welcome to Shooping Hall.</p> -->
              </div>
            </div>
          </div>
          <!-- heder -->
          <!-- content -->
          <div class="col-12 p-3">
            <div class="row">
              <div class="col-6 d-none d-lg-block background">
                <div id="carouselExample" class="carousel slide">
                  <div class="carousel-inner">
                    <div class="carousel-item active ">
                      <img src="resocess/indexCarouselImages/images (1).jpg" class="d-block w-100 indexImages rounded-3" alt="...">
                      <div class="carousel-caption  poster-caption-1 ">
                        <h3 class="poster-title  fw-bold title text-uppercase">Hi Welcome</h3>
                        <p class="poster-txt fs-2 title">SHOPPING HALL.....</p>
                      </div>
                    </div>
                    <div class="carousel-item">
                      <img src="resocess/indexCarouselImages/images (2).jpg" class="d-block w-100 indexImages rounded-3" alt="...">
                      <div class="carousel-caption  poster-caption-1 ">
                        <h2>Love Delivers Event</h2>
                        <h3 class="poster-title text-start fw-bold ">The best of the top Category</h3>
                      </div>
                    </div>
                    <div class="carousel-item">
                      <img src="resocess/indexCarouselImages/images (3).jpg" class="d-block w-100 indexImages rounded-3" alt="...">
                      <div class="carousel-caption  poster-caption-1 ">
                        <h2>Love Delivers Event</h2>
                        <h3 class="poster-title  fw-bold ">Wonderful Home</h3>
                        <!-- <p class="poster-txt fs-2 title">SHOPPING HALL.....</p> -->
                      </div>
                    </div>
                    <div class="carousel-item">
                      <img src="resocess/indexCarouselImages/images (4).jpg" class="d-block w-100 indexImages rounded-3" alt="...">
                      <div class="carousel-caption  poster-caption-1 ">
                        <h2>Love Delivers Event</h2>
                        <h3 class="poster-title  fw-bold ">Tech you'll need and love.</h3>
                        <!-- <p class="poster-txt fs-2 title">SHOPPING HALL.....</p> -->
                      </div>
                    </div>
                    <div class="carousel-item">
                      <img src="resocess/indexCarouselImages/images (5).jpg" class="d-block w-100 indexImages rounded-3" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="resocess/indexCarouselImages/images (6).jpg" class="d-block w-100 indexImages rounded-3" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="resocess/indexCarouselImages/images (7).jpg" class="d-block w-100 indexImages rounded-3" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="resocess/indexCarouselImages/images (8).jpg" class="d-block w-100 indexImages rounded-3" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="resocess/indexCarouselImages/images (9).jpg" class="d-block w-100 indexImages rounded-3" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="resocess/indexCarouselImages/images (10).jpg" class="d-block w-100 indexImages rounded-3" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="resocess/indexCarouselImages/images (11).jpg" class="d-block w-100 indexImages rounded-3" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="resocess/indexCarouselImages/images (12).jpg" class="d-block w-100 indexImages rounded-3" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="resocess/indexCarouselImages/images (13).jpg" class="d-block w-100 indexImages rounded-3" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="resocess/indexCarouselImages/images (14).jpg" class="d-block w-100 indexImages rounded-3" alt="...">
                    </div>
                    <div class="carousel-item">
                      <img src="resocess/indexCarouselImages/images (15).jpg" class="d-block w-100 indexImages" rounded-3 alt="...">
                    </div>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
              </div>
              <div class="col-12 col-lg-6" id="signUpBox">
                <div class="row g-2">
                  <div class="col-12">
                    <p class="txt2">Create New Account</p>
                  </div>

                  <div class="col-12 d-none" id="msgdiv">
                    <div class="alert alert-info" role="alert" id="alertdiv">
                      <i class="bi bi-check-circle-fill fs-6" id="msg"></i>
                    </div>
                  </div>

                  <div class="col-6">
                    <label class="form-label fw-bold">First Name</label>
                    <input type="text" class="form-control border-end-0 border-top-0 border-start-0 " id="firstname" placeholder="First Name">
                  </div>
                  <div class="col-6">
                    <label class="form-label fw-bold">Last Name</label>
                    <input type="text" class="form-control border-end-0 border-top-0 border-start-0" id="lastname" placeholder="Last Name">
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control border-end-0 border-top-0 border-start-0" id="email" placeholder="Email">
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-bold">Password</label>
                    <div class="input-group mb-3">
                      <input type="password" class="form-control border-end-0 border-top-0 border-start-0" id="password" placeholder="Password">
                      <button class="border-end-0 border-top-0 border-start-0 bg-white" type="button" onclick="showPassword3();"><i id="eye" class="bi bi-eye-slash-fill"></i></button>
                    </div>
                  </div>
                  <div class="col-6">
                    <label class="form-label fw-bold">Mobile</label>
                    <input type="text" class="form-control border-end-0 border-top-0 border-start-0" id="mobile" placeholder="Contact Number">
                  </div>
                  <div class="col-6">
                    <label class="form-label fw-bold">Gender</label>
                    <select class="form-select border-end-0 border-top-0 border-start-0" id="gender">
                      <?php

                      require "connection.php";

                      $rs = Database::search("SELECT * FROM `gender`");
                      $r = $rs->num_rows;

                      for ($i = 0; $i < $r; $i++) {
                        $s = $rs->fetch_assoc();
                      ?>

                        <option value="<?php echo $s["id"]; ?>"><?php echo $s["name"]; ?></option>

                      <?php

                      }

                      ?>
                    </select>
                  </div>
                  <div class="col-12 col-lg-6 d-grid pt-2">
                    <button class="btn btn-outline-warning" onclick="signUp();">Sign Up</button>
                  </div>
                  <div class="col-12 col-lg-6 d-grid pt-2">
                    <button class="btn btn-outline-secondary" onclick="changeView();">Sign In</button>
                  </div>

                  <div class="col-12 mt-3">
                    <div class="row">
                      <a href="home.php" class="text-end fs-5 text-decoration-none">Skip <b class="fs-4">&raquo;&raquo;&raquo;</b> </a>
                    </div>
                  </div>

                </div>
              </div>
              <div class="col-12 col-lg-6 d-none" id="signInBox">
                <div class="row g-2">
                  <div class="col-12">
                    <p class="txt2">Sign In</p>
                  </div>

                  <?php

                  $email = "";
                  $password = "";

                  if (isset($_COOKIE["email"])) {
                    $email = $_COOKIE["email"];
                  }

                  if (isset($_COOKIE["password"])) {
                    $password = $_COOKIE["password"];
                  }


                  ?>
                  <div class="col-12 d-none" id="msgdiv2">
                    <div class="alert alert-danger" role="alert" id="alertdiv">
                      <i class="bi bi-x-octagon-fill fs-5" id="msg2"></i>
                    </div>
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control border-end-0 border-top-0 border-start-0" id="signEmail" placeholder="Email" value="<?php echo $email; ?>">
                  </div>
                  <div class="col-12">
                    <label class="form-label fw-bold">Password</label>
                    <div class="input-group mb-3">
                      <input type="password" class="form-control border-end-0 border-top-0 border-start-0" id="signPassword" placeholder="Password" value="<?php echo $password; ?>">
                      <button class="border-end-0 border-top-0 border-start-0 bg-white" type="button" onclick="showPassword();"><i id="eye" class="bi bi-eye-slash-fill"></i></button>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" value="1" id="rememberMe">
                      <label class="form-check-label">Remember Me</label>
                    </div>
                  </div>
                  <div class="col-6 text-end">
                    <a href="#" class="link-primary" onclick="forgotPassword();">Frogot Password?</a>
                  </div>
                  <div class="col-12 col-lg-4 d-grid mb-2 mt-2">
                    <button class="btn btn-outline-primary" onclick="signInProcess();">Sign In</button>
                  </div>
                  <div class="col-12 col-lg-4 d-grid mb-2 mt-2">
                    <button class="btn btn-outline-danger" onclick="changeView();">Create New Account</button>
                  </div>
                  <div class="col-12 col-lg-4 d-grid mb-2 mt-2">
                    <a class="btn btn-outline-dark" href="adminLogin.php">Admin Sign In</a>
                  </div>
                  <div class="col-12">
                    <div class="row">
                      <a href="home.php" class="text-end fs-5 text-decoration-none">Skip <b class="fs-4">&raquo;&raquo;&raquo;</b> </a>
                    </div>
                  </div>

                </div>
              </div>
            </div>

          </div>
          <!-- content -->

        </div>
      </div>


      <!-- modal -->

      <div class="modal" tabindex="-1" id="forgotPassword">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Password</h5>
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
              <div class="row g-2">
                <div class="col-6">
                  <label class="form-label">New Password</label>
                  <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="New Password" id="newPassword">
                    <button class="btn btn-outline-secondary" type="button" onclick="showPassword1();"><i id="eye1" class="bi bi-eye-slash-fill"></i></button>
                  </div>
                </div>
                <div class="col-6">
                  <label class="form-label">Confirm New Password</label>
                  <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Confirm New Password" id="confirmNewPassword">
                    <button class="btn btn-outline-secondary" type="button" onclick="showPassword2();"><i id="eye2" class="bi bi-eye-slash-fill"></i></button>
                  </div>
                </div>


                <div class="col-12">
                  <label class="form-label">Verification Code</label>
                  <div class="input-group mb-3">
                    <input class="form-control" placeholder="Verification Code Enter" id="verificationCode">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary">Close</button>
                  <button type="button" class="btn btn-outline-primary" onclick="confirmP();">Confirm</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- modal -->


      <!-- footer -->

      <div class="col-12 fixed-bottom d-none d-lg-block">
        <p class="text-center fw-bold">&copy; 2022 shoppinghall.lk || All Right Reserved</p>
      </div>

      <!-- footer -->
    </div>
  </div>
  <script src="script.js"></script>
  <script src="bootstrap.js"></script>
</body>

</html>