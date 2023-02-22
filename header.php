
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="style.css">

</head>

<body>
  <div class="container-fluid">
    <div class="row ">
      <div class="col-12 ">
        <div class="col-lg-3 ">

          <!-- border-top px-xl-5 -->
          <div class="col-lg-9 ">
            <nav class="navbar navbar-expand-lg bg-body navbar-body py-3 py-lg-0 px-0">
              <div class="col-12  ">
                <div class="row">

                  <div class="col-6 mt-2">
                    <span class="text-decoration-none d-block d-lg-none ">
                      <h1 class="m-0">Shopping Hall</h1>
                    </span>
                  </div>
                  <div class="col-6">
                    <nav class="navbar  offset-9 offset-lg-0 mt-0 ">
                      <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                      </div>
                    </nav>
                  </div>
                </div>
              </div>
              <div class="collapse" id="navbarToggleExternalContent">

                <div class="p-4 ">
             
                  <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                      <a class="nav-link" href="home.php"><i class="bi bi-house-fill fw-bold fs-5"></i>&nbsp;Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="myProfile.php"><i class="bi bi-person-circle fw-bold fs-5"></i>&nbsp;My Profile</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="myProducts.php"><i class="bi bi-bag-fill fw-bold fs-5"></i>&nbsp;My Product</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="addProduct.php"><i class="bi bi-bag-plus-fill fw-bold fs-5"></i>&nbsp;Add Product</a>
                    </li>
                    <!-- <li class="nav-item">
                      <a class="nav-link" href="updateProduct.php"><i class="bi bi-bag-check-fill fw-bold fs-5"></i>&nbsp;Update Product</a>
                    </li> -->
                    <li class="nav-item">
                      <a class="nav-link" href="cart.php"><i class="bi bi-cart-fill fw-bold fs-5"></i>&nbsp;Cart</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="watchlist.php"><i class="bi bi-bookmark-star-fill fw-bold fs-5"></i>&nbsp;Watchlist</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="purchasingHistory.php"><i class="bi bi-file-text-fill fw-bold fs-5"></i>&nbsp;Purchase History</a>
                    </li>
                    <!-- <li class="nav-item">
                      <a class="nav-link" href="#!"><i class="bi bi-chat-left-fill fw-bold fs-5"></i>&nbsp;Message</a>
                    </li> -->
                    <?php

              

                    if (isset($_SESSION["u"])) {

                      $data = $_SESSION["u"];

                    ?>
                      <div class="col-12">
                        <div class="row">
                          <div class="col-12">
                            <?php
                            // $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $data . "'");
                            // $user_data = $user_rs->fetch_assoc();
                            ?>
                            <span class="text-lg-start fw-bold fs-5"><?php echo $data["fname"]; ?>&nbsp;&nbsp;<button class="nav-item btn btn-danger" onclick="signOut();">Sign Out</button></span>
                          </div>
                        </div>
                      </div>
                    <?php

                    } else {

                    ?>
                      <a href="index.php" class="text-decoration-none fw-bold">Sign In or Register</a>
                    <?php

                    }

                    ?>

                  </ul>
                </div>
              </div>

              <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">

                <div class="row" style="margin-right: 20px;">
                  <div class="col-12">
                    <div class="row">
                      <div class="col-2">
                        <img src="resocess/webLogo/logo.jpg" class="text-start" style="height: 50px;width: auto;">
                      </div>
                      <div class="col-5">
                        <h5 class="fs-3 text-start mt-1 text-uppercase fw-bold offset-2 me-lg-5"><b class=" fs-3 text-primary">Shopping</b>&nbsp;<b class="fs-4 ">H</b><b class="fs-4 ">a</b><b class="fs-4 ">l</b><b class="fs-4 ">l</b></h5>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="navbar-nav py-2 fs-5  px-lg-2 offset-lg-3">

              
                  <a href="home.php" class="nav-item nav-link active txtLine fs-5">Home</a>&nbsp;&nbsp;&nbsp;
                  <a href="watchlist.php" class="nav-item nav-link txtLine fs-5">Watchlist</a>&nbsp;&nbsp;&nbsp;
                  <a href="cart.php" class="nav-item nav-link txtLine fs-5">Cart</a>&nbsp;&nbsp;&nbsp;
                  <a href="purchasingHistory.php" class="nav-item nav-link txtLine fs-5">Purchasing&nbsp;History</a>&nbsp;
                  <!-- <a href="message.php" class="nav-item nav-link txtLine fs-5">Message</a>&nbsp;&nbsp;&nbsp; -->

                  <a href="#" class="nav-item nav-link txtLine fs-5" onclick="contactAdminMsg('<?php echo $data['email']; ?>');">Contact&nbsp;Admin</a>&nbsp;&nbsp;&nbsp;

                  <div class="dropdown mt-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Profile
                    </button>

                    <ul class="dropdown-menu">
                      <a href="myProfile.php" class="dropdown-item nav-link">My&nbsp;Profile</a>
                      <a href="myProducts.php" class="dropdown-item nav-link">My&nbsp;Product</a>
                      <div class="col-12 mt-0">
                        <?php

                        if (isset($_SESSION["u"])) {
                          $data = $_SESSION["u"];

                        ?>
                          <a href="#" class="dropdown-item nav-item fw-bold text-danger" onclick="signOut();">Sign Out</a>
                        <?php

                        } else {

                        ?>
                          <a href="index.php" class="dropdown-item">Sign In or Register</a>
                        <?php

                        }

                        ?>

                      </div>
                  </div>

                </div>
                </ul>
              </div>

            </nav>
          </div>
        </div>

      </div>
      </nav>
      <!-- msg model -->
      <div class="modal fade" id="contactAdminMsg" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Admin Message</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body " style="background-color:  #fbfcfc ;">

              <?php

              $sender_mail = $_SESSION["u"]["email"];

              $msg_rs = Database::search("SELECT * FROM `admin_chat` WHERE `user_email`='" . $sender_mail . "'");
              $msg_num = $msg_rs->num_rows;

              for ($y = 0; $y < $msg_num; $y++) {
                $msg_data = $msg_rs->fetch_assoc();

                if ($msg_data["status"] == "1") {
                  $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $msg_data["user_email"] . "'");
                  $user_data = $user_rs->fetch_assoc();

              ?>


                  <!-- send -->
                  <div class="col-12 mt-1 mb-3">
                    <div class="row">
                      <div class="offset-3 col-8 rounded-4 bg-white">
                        <div class="row">
                          <div class="col-12 pt-2 pb-2">
                            <span class="text-black fw-bold fs-5 mb-2 p-1"><?php echo $msg_data["content"]; ?></span>
                          </div>
                          <div class="col-12 text-end pb-2">
                            <span class="text-black fs-6"><?php echo $msg_data["date_time"]; ?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- send -->
                <?php
                } else if ($msg_data["status"] == "2") {
                ?>
                  <!-- received -->
                  <div class="col-12 mt-1 mb-3">
                    <div class="row">
                      <div class=" col-8 rounded-4 bg-dark">
                        <div class="row">
                          <div class="col-12 pt-2 pb-2">
                            <span class="text-white fw-bold fs-5 "><?php echo $msg_data["content"] ?></span>
                          </div>
                          <div class="col-12 text-end pb-2">
                            <span class="text-white fs-6"><?php echo $msg_data["date_time"]; ?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- received -->
              <?php
                }
              }

              ?>

            </div>
            <div class="modal-footer">
              <div class="col-12">
                <div class="row">
                  <div class="col-9">
                    <input type="text" class="form-control" placeholder="Message" id="typeMsg">
                  </div>
                  <div class="col-3 d-grid">
                    <button class="btn btn-primary" type="button" onclick="adminSendMsg();">Send</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- msg model -->
    </div>
  </div>

  <!-- <script src="bootstrap.bundle.js"></script>  -->
  <script src="script.js"></script>
  <!-- <script src="bootstrap.js"></script> -->
</body>

</html>