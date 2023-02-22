<?php
session_start();
require "connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <title>Shoppin Hall | Manage User</title>
  <link rel="icon" href="resocess/webLogo/logo.jpg">

</head>

<body style="overflow-x: hidden;">

  <div class="container-fluid ">
    <div class="row">

      <?php include "adminHeader.php"; ?>

      <hr class="d-block d-lg-none">
      <div class="col-12 ">
        <div class="row">

          <div class="col-12 shadow-sm bg-white rounded-4 mt-4">
            <div class="row">
              <div class="col-6 col-lg-4 offset-2 offset-lg-3 mb-3">
                <input type="text" class="form-control" placeholder="Search her..." id="basicSearchText">
              </div>
              <div class="col-3 col-lg-2 d-grid mb-3">
                <button class="btn btn-primary shadow" onclick="basicSearchAdmin(0);">Search</button>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="col-12">
        <div class="row ">

          <div class="col-10 col-lg-10 offset-1 offset-lg-1 rounded-4 shadow bg-white mt-5">
            <div class="row">

              <div class="col-12 col-lg-3 border border-2   border-start-0 border-top-0 border-bottom-0 ">
                <div class="row">

                  <div class="col-12 align-items-center vh-100 d-none d-lg-block">
                    <div class="row  g-1">

                      <div class="col-6 col-lg-12 mt-5">
                        <div class="row">
                          <div class="col-1 ">
                            <?php
                            $admin_img_rs = Database::search("SELECT * FROM `admin_profile` WHERE `admin_email`='" . $_SESSION["admin"]["email"] . "'");
                            $admin_img_data = $admin_img_rs->fetch_assoc();

                            if ($_SESSION["admin"]) {
                            ?>
                              <img src="<?php echo $admin_img_data["path"]; ?>" style="height: 65px;width: auto;background-repeat: no-repeat;">
                            <?php
                            } else {
                            ?>
                              <img src="resocess/profile-im.png" style="height: 65px;width: auto;background-repeat: no-repeat;">
                            <?php
                            }

                            ?>

                          </div>
                          <div class="col-12 offset-lg-2 offset-0 col-lg-9">
                            <?php
                            $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $_SESSION["admin"]["email"] . "'");
                            $admin_data = $admin_rs->fetch_assoc();
                            ?>
                            <label class="form-label fs-5"><?php echo $admin_data["fname"] . " " . $admin_data["lname"]; ?></label><br>
                            <button class="btn btn-outline-info shadow" onclick="adminProfileUpdate();">Account Update</button>
                          </div>
                        </div>
                      </div>

                      <div class="nav flex-column nav-pills me-3 mt-3">
                        <nav class="nav flex-column">
                          <a class="nav-link text-dark fs-5 mb-3" href="adminPenal.php">Dashboard</a>
                          <a class="nav-link text-dark fs-5 mb-3" href="#">Manage Users</a>
                          <a class="nav-link text-dark fs-5 mb-3" href="manageProduct.php">Manage Products</a>
                          <a class="nav-link text-dark fs-5 mb-3" href="productAdd.php">Add Product</a>
                          <a class="nav-link text-dark fs-5 mb-3" href="sellingHistory.php">Selling History</a>
                          <?php

                          if (isset($_SESSION["admin"])) {

                            $data = $_SESSION["admin"];

                          ?>
                            <div class="col-12">
                              <div class="row">
                                <div class="col-12">
                                  <?php
                                  // $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $data . "'");
                                  // $user_data = $user_rs->fetch_assoc();
                                  ?>
                                  <a class="nav-link text-danger fs-5 mb-3" onclick="adminSignOut();">Sign Out</a>
                                </div>
                              </div>
                            </div>
                          <?php

                          } else {

                          ?>
                            <a href="adminLogin.php" class="text-decoration-none fw-bold">Sign In or Register</a>
                          <?php

                          }

                          ?>
                        </nav>
                      </div>

                    </div>
                  </div>

                </div>
              </div>

              <div class="col-12 col-lg-9" id="basicRsesult">
                <div class="row">

                  <div class="col-12 mt-3 ">
                    <label class="form-label fs-4 fw-bold">Manage Users</label>
                    <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                      <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item"><a href="adminPenal.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
                      </ol>
                    </nav>
                  </div>

                  <div class="col-12">
                    <hr style="width: 90%;" class="border border-2 border-info rounded-4">
                  </div>

                  <div class="col-12 ">
                    <div class="row ">

                      <div class="col-12">
                        <div class="row ">

                          <div class="col-9 offset-0 col-lg-10 offset-lg-1">
                            <div class="row ">

                              <table class="table col-10 text-start align-middle  table-hover mb-0 ">
                                <thead>
                                  <tr class="text-dark">
                                    <th scope="col" class="fs-6">#</th>
                                    <th scope="col" class="fs-6">User Image</th>
                                    <th scope="col" class="fs-6">Email</th>
                                    <th scope="col" class="fs-6">User Name</th>
                                    <th scope="col" class="fs-6">Register Date</th>
                                    <th scope="col"></th>

                                  </tr>
                                </thead>
                                <tbody class="col-10">

                                  <?php

                                  $pageno;

                                  $query = "SELECT * FROM `user`";

                                  if (isset($_GET["page"])) {
                                    $pageno = $_GET["page"];
                                  } else {
                                    $pageno = 1;
                                  }

                                  $user_rs = Database::search($query);
                                  $user_num = $user_rs->num_rows;

                                  $results_per_page = 6;
                                  $number_of_pages = ceil($user_num / $results_per_page);

                                  $page_results = ($pageno - 1) * $results_per_page;
                                  $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                  $selected_num = $selected_rs->num_rows;

                                  for ($x = 0; $x < $selected_num; $x++) {
                                    $selected_data = $selected_rs->fetch_assoc();


                                  ?>

                                    <tr>
                                      <td class="fs-6"><?php echo $x + 1; ?></td>
                                      <td onclick="viewMsgModel('<?php echo $selected_data['email']; ?>');">
                                        <?php
                                        $img_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $selected_data["email"] . "'");
                                        $img_num = $img_rs->num_rows;

                                        if ($img_num == 1) {
                                          $img_data = $img_rs->fetch_assoc();

                                        ?>
                                          <img src="<?php echo $img_data["path"]; ?>" class="rounded-circle shadow" style="background-repeat: no-repeat;height: 50px;width: auto;">
                                        <?php
                                        } else {
                                        ?>
                                          <img src="resocess/projectUser.png " class="rounded-circle shadow" style="background-repeat: no-repeat;height: 50px;width: auto;">
                                        <?php
                                        }
                                        ?>

                                      </td>
                                      <div class="col-12">
                                        <div class="row">
                                          <td class="fs-6  "><?php echo $selected_data["email"]; ?></td>
                                        </div>
                                      </div>
                                      <td class="fs-6"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></td>
                                      <td class="fs-6"><?php echo $selected_data["joined_data"] ?></td>
                                      <td>
                                        <div class="col-12">
                                          <?php
                                          if ($selected_data["status"] ==  1) {
                                          ?>
                                            <button class="btn btn-primary shadow" id="buttonStatus<?php echo $selected_data['email']; ?>" onclick="chengStatus('<?php echo $selected_data['email']; ?>');">Block</button>
                                          <?php
                                          } else {
                                          ?>
                                            <button class="btn btn-dark shadow" id="buttonStatus<?php echo $selected_data['email']; ?>" onclick="chengStatus('<?php echo $selected_data['email']; ?>');">Unblock</button>
                                          <?php
                                          }
                                          ?>
                                        </div>
                                      </td>
                                    </tr>

                                    <!-- User datelis Model -->
                                    <div class="modal fade" id="userMsg<?php echo $selected_data["email"]; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                      <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h1 class="modal-title fs-6" id="exampleModalToggleLabel"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body " style="background-color:  #fbfcfc ;">

                                            <?php

                                            $recever_mail = $_SESSION["admin"]["email"];
                                            $sender_mail = $selected_data["email"];

                                            $msg_rs = Database::search("SELECT * FROM `admin_chat` WHERE `user_email`='" . $sender_mail . "'");
                                            $msg_num = $msg_rs->num_rows;

                                            for ($y = 0; $y < $msg_num; $y++) {
                                              $msg_data = $msg_rs->fetch_assoc();

                                              if ($msg_data["status"] == "2") {


                                            ?>


                                                <!-- send -->
                                                <div class="col-12 mt-1 mb-3">
                                                  <div class="row">
                                                    <div class="offset-3 col-8 rounded-4 bg-white">
                                                      <div class="row">
                                                        <div class="col-12 pt-2 pb-2">
                                                          <span class="text-black fw-bold fs-6 mb-2 p-1"><?php echo $msg_data["content"]; ?></span>
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
                                              } else if ($msg_data["status"] == "1") {
                                              ?>
                                                <!-- received -->
                                                <div class="col-12 mt-1 mb-3">
                                                  <div class="row">
                                                    <div class=" col-8 rounded-4 bg-dark">
                                                      <div class="row">
                                                        <div class="col-12 pt-2 pb-2">
                                                          <span class="text-white fw-bold fs-6 "><?php echo $msg_data["content"] ?></span>
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
                                                  <button class="btn btn-primary shadow" type="button" onclick="adminSendMsg('<?php echo $selected_data['email']; ?>');">Send</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>


                                    <!-- User datelis Model -->

                                  <?php
                                  }
                                  ?>

                                </tbody>
                              </table>

                            </div>
                          </div>



                        </div>
                      </div>
                      <!-- profileUpdate model -->
                      <div class="modal fade" id="adminProfileUpdate" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5 fw-bold" id="exampleModalToggleLabel">Admin Profile </h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body ">

                              <div class="col-12 d-flex justify-content-center">
                                <div class="row align-items-center">
                                  <?php
                                  $admin_img_rs = Database::search("SELECT * FROM `admin_profile` WHERE `admin_email`='" . $_SESSION["admin"]["email"] . "'");
                                  $admin_img_data = $admin_img_rs->fetch_assoc();

                                  if ($_SESSION["admin"]) {
                                  ?>
                                    <img src="<?php echo $admin_img_data["path"]; ?>" style="height: 65px;width: auto;background-repeat: no-repeat;" id="img">
                                  <?php
                                  } else {
                                  ?>
                                    <img src="resocess/projectUser.png" class="rounded-circle shadow" style="height: 65px;width: auto;background-repeat: no-repeat;">
                                  <?php
                                  }

                                  ?>
                                </div>
                              </div>
                              <div class="col-6 col-lg-5 offset-4 mt-2 mb-4">
                                <input type="file" class="d-none" id="profileimg" accept="image/**">
                                <label for="profileimg" class="btn btn-primary shadow" onclick="changeImage();">Upload Profile Image</label>
                              </div>


                              <div class="col-12">
                                <div class="row">


                                  <?php

                                  $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $_SESSION["admin"]["email"] . "'");
                                  $admin_data = $admin_rs->fetch_assoc();

                                  ?>

                                  <div class="col-6">
                                    <label class="form-label fs-5 fw-bold">Frist Name</label>
                                    <input type="text" class="form-control" placeholder="Frist Name" id="fname" value="<?php echo $admin_data["fname"] ?>">
                                  </div>
                                  <div class="col-6">
                                    <label class="form-label fs-5 fw-bold">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Last Name" id="lname" value="<?php echo $admin_data["lname"] ?>">
                                  </div>


                                </div>
                              </div>

                            </div>
                            <div class="modal-footer ">
                              <button class="btn btn-primary shadow" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" onclick="updateAdminProfile();">Save Profile</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- profileupdate model -->

                      <div class="col-8 col-lg-6 text-center mt-5 mb-4 offset-3 offset-lg-5">
                        <nav aria-label="Page navigation example">
                          <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="<?php if ($pageno <= 1) {
                                                                                echo "#";
                                                                              } else {
                                                                                echo "?page=" . ($pageno - 1);
                                                                              } ?>">Previous</a></li>
                            <?php

                            for ($x = 1; $x <= $number_of_pages; $x++) {
                              if ($x == $pageno) {
                            ?>
                                <li class="page-item"><a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a></li>
                              <?php
                              } else {
                              ?>
                                <li class="page-item"><a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a></li>
                            <?php
                              }
                            }

                            ?>

                            <li class="page-item"><a class="page-link" href="<?php if ($pageno >= $number_of_pages) {
                                                                                echo "#";
                                                                              } else {
                                                                                echo "?page=" . ($pageno + 1);
                                                                              } ?>">Next</a></li>
                          </ul>
                        </nav>
                      </div>

                    </div>
                  </div>





                </div>
              </div>





            </div>
          </div>

        </div>
      </div>



    </div>
  </div>

  <script src="bootstrap.js"></script>
  <script src="script.js"></script>
</body>

</html>