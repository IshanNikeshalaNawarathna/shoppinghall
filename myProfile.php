<?php

require "connection.php";

session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Shopping Hall | My Profile</title>
  <link rel="icon" href="resocess/webLogo/logo.jpg">
</head>

<body class="bg-white" style="overflow-x: hidden;">

  <div class="container-fluid ">
    <div class="row">
      <div class="col-12 shadow-sm mb-3 mt-3">
        <div class="row">

          <?php



          include "header.php";





          if (isset($_SESSION["u"])) {

            $email = $_SESSION["u"]["email"];

            $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON gender.id=user.gender_id WHERE `email`='" . $email . "'");

            $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $email . "'");

            $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON 
          user_has_address.city_id=city.id INNER JOIN `district` ON city.district_id=district.id INNER JOIN 
          `province` ON district.province_id=province.id WHERE `user_email`='" . $email . "'");

            $details_data = $details_rs->fetch_assoc();
            $image_data = $image_rs->fetch_assoc();
            $address_data = $address_rs->fetch_assoc();


          ?>

        </div>
      </div>
      <!-- 
        <div class="col-12 shadow-sm p-3 mb-3 bg-body rounded-2"> -->
      <!-- style="background-color: #fef9e7  ;" -->
      <!-- <div class="col-12 col-lg-9 offset-lg-3 "> -->

      <!-- </div>
        </div> -->

      <div class="col-12 mb-2  shadow-sm  rounded-4 mt-1">
        <div class="row  bg-body ">
          <div class="col-12 mt-2">
            <label class="form-label fs-1 fw-bold"><i class="bi bi-cart-plus-fill fs-1"></i>&nbsp;| My Profile</label>
          </div>
          <div class="col-7 col-lg-6">
            <hr class="border border-5 bg-warning border-warning rounded-3">
          </div>
          <div class="row">
            <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
              <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Profile</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>

      <div class="offset-2 col-lg-8 col-8 mb-4">
        <div class="row gap-1">

          <div class="col-12 bg-white rounded-5 mb-2 shadow  bg-body" style="margin-top: 50px;">
            <div class="row">
              <div class="col-12  rounded-5">
                <div class="row gap-1 ">

                  <!-- style="background-color: #ebf5fb;" -->
                  <div class="d-flex flex-column align-items-center text-center p-5 py-5 ">
                    <?php

                    if (empty($image_data["path"])) {
                    ?>
                      <img src="resocess/projectUser.png" class="rounded-circle" style="width: 200px;" id="img">
                    <?php
                    } else {
                    ?>
                      <img src="<?php echo $image_data["path"]; ?>" class="rounded-circle" style="width: 200px;" id="img">
                    <?php
                    }

                    ?>

                    <span class="fw-bold fs-6"><?php echo $details_data["fname"] . " " . $details_data["lname"]; ?></span>
                    <span class="fw-bold fs-6"><?php echo $email; ?></span>

                    <input type="file" class="d-none" id="profileimg" accept="image/**">
                    <label for="profileimg" class="btn btn-outline-primary mt-4" onclick="changeImage();">Update Profile Image</label>

                  </div>

                  <div class="  col-11 col-lg-11 offset-1 ">
                    <div class=" row gap-1">


                      <div class="d-flex justify-content-between mb-5 ">
                        <h4 class="fw-bold fs-2">My Profile</h4>
                      </div>

                      <div class="row mt-2">
                        <div class="col-6 col-lg-4 rounded-3 shadow-sm ">
                          <label class="form-label fs-5 mt-3">Frist Name <b class="text-danger fs-4">*</b></label>
                          <input type="text" class="form-control mb-3 mt-3 border-end-0 border-start-0 border-top-0" placeholder="Type Frist Name.." value="<?php echo $details_data["fname"]; ?>" id="fname">
                        </div>
                        <div class="col-6 col-lg-4 rounded-3 shadow-sm">
                          <label class="form-label fs-5 mt-3">Last Name<b class="text-danger fs-4">*</b></label>
                          <input type="text" class="form-control mb-3 mt-3 border-end-0 border-start-0 border-top-0" placeholder="Type Last Name.." value="<?php echo $details_data["lname"]; ?>" id="lname">
                        </div>
                        <div class="col-12 col-lg-4 shadow-sm rounded-3 ">
                          <label class="form-label fs-5 mt-3">Mobile</label>
                          <input type="text" class="form-control mb-3 mt-3 border-end-0 border-start-0 border-top-0" placeholder="Type Mobile Number.." value="<?php echo $details_data["mobile"]; ?>" id="mobile">
                        </div>
                        <div class="col-12 col-lg-6 shadow-sm rounded-3">
                          <label class="form-label fs-5 mt-3">Email</label>
                          <input type="text" class="form-control mb-3 mt-3 border-end-0 border-start-0 border-top-0" readonly value="<?php echo $details_data["email"]; ?>">
                        </div>
                        <div class="col-6 col-lg-3 shadow-sm rounded-3">
                          <label class="form-label fs-5 mt-3 ">Password</label>
                          <input type="password" class="form-control mb-3 mt-3 border-end-0 border-start-0 border-top-0" readonly value="<?php echo $details_data["password"]; ?>">
                        </div>
                        <div class="col-6 col-lg-3 shadow-sm rounded-3">
                          <label class="form-label fs-5 mt-3">Registered Date</label>
                          <input type="text" class="form-control mb-3 mt-3 border-end-0 border-start-0 border-top-0" readonly value="<?php echo $details_data["joined_data"]; ?>">
                        </div>

                        <?php

                        if (!empty($address_data["line1"])) {

                        ?>
                          <div class="col-6  shadow-sm rounded-3 mt-3">
                            <label class="form-label fs-5  ">Address Line 01<b class="text-danger fs-4">*</b></label>
                            <input type="text" class="form-control mb-3 mt-2 border-end-0 border-start-0 border-top-0" placeholder="Type Address Line 01.." value=" <?php echo $address_data["line1"]; ?>" id="line1">
                          </div>

                        <?php

                        } else {
                        ?>
                          <div class="col-6 shadow-sm rounded-3 mt-3 ">
                            <label class="form-label fs-5  ">Address Line 01<b class="text-danger fs-4">*</b></label>
                            <input type="text" class="form-control mb-3 mt-2 border-end-0 border-start-0 border-top-0" placeholder="Type Address Line 01.." id="line1">
                          </div>
                        <?php
                        }

                        if (!empty($address_data["line2"])) {
                        ?>
                          <div class="col-6 shadow-sm rounded-3 mt-3 ">
                            <label class="form-label fs-5 ">Address Line 02<b class="text-danger fs-4">*</b></label>
                            <input type="text" class="form-control mb-3 mt-2 border-end-0 border-start-0 border-top-0" placeholder="Type Address Line 02.." value=" <?php echo $address_data["line2"]; ?>" id="line2">
                          </div>
                        <?php
                        } else {
                        ?>
                          <div class="col-6 shadow-sm rounded-3 mt-3">
                            <label class="form-label fs-5 ">Address Line 02<b class="text-danger fs-4">*</b></label>
                            <input type="text" class="form-control mb-3 mt-2 border-end-0 border-start-0 border-top-0" placeholder="Type Address Line 02.." id="line2">
                          </div>
                        <?php
                        }

                        $provice_rs = Database::search("SELECT * FROM `province`");
                        $district_rs = Database::search("SELECT * FROM `district`");
                        $city_rs = Database::search("SELECT * FROM `city`");

                        ?>



                        <div class="col-12 col-lg-4  shadow-sm rounded-3 mt-3">
                          <label class="form-label fs-5  ">Provinces<b class="text-danger fs-4">*</b></label>
                          <select class="form-select mb-3 mt-2 border-end-0 border-start-0 border-top-0" id="provinces">
                            <option value="0">Select Provinces</option>
                            <?php
                            $provice_num = $provice_rs->num_rows;
                            for ($x = 0; $x < $provice_num; $x++) {
                              $provice_data = $provice_rs->fetch_assoc();

                            ?>
                              <option value="<?php echo $provice_data["id"]; ?>" <?php
                                                                                  if (!empty($address_data["province_id"])) {
                                                                                    if ($provice_data["id"] == $address_data["province_id"]) {
                                                                                  ?>selected<?php
                                                                                          }
                                                                                        }
                                                                                            ?>><?php echo $provice_data["name"]; ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                        <div class="col-12 col-lg-4 shadow-sm rounded-3 mt-3">
                          <label class="form-label fs-5 ">District<b class="text-danger fs-4">*</b></label>
                          <select class="form-select mb-3 mt-2 border-end-0 border-start-0 border-top-0" id="district">
                            <option value="0">Select District</option>
                            <?php
                            $district_num =  $district_rs->num_rows;
                            for ($x = 0; $x <  $district_num; $x++) {
                              $district_data =  $district_rs->fetch_assoc();

                            ?>
                              <option value="<?php echo  $district_data["id"]; ?>" <?php
                                                                                    if (!empty($address_data["district_id"])) {
                                                                                      if ($district_data["id"] == $address_data["district_id"]) {
                                                                                    ?>selected<?php
                                                                                            }
                                                                                          }
                                                                                              ?>><?php echo  $district_data["name"]; ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                        <div class="col-12 col-lg-4  shadow-sm rounded-3 mt-3">
                          <label class="form-label fs-5  ">City<b class="text-danger fs-4">*</b></label>
                          <select class="form-select mb-3 mt-2 border-end-0 border-start-0 border-top-0" id="city">
                            <option value="">Select City</option>
                            <?php
                            $city_num =  $city_rs->num_rows;
                            for ($x = 0; $x <  $city_num; $x++) {
                              $city_data =  $city_rs->fetch_assoc();

                            ?>
                              <option value="<?php echo  $city_data["id"]; ?>" <?php
                                                                                if (!empty($address_data["city_id"])) {
                                                                                  if ($city_data["id"] == $address_data["city_id"]) {
                                                                                ?>selected<?php
                                                                                        }
                                                                                      }
                                                                                          ?>><?php echo  $city_data["name"]; ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                        <?php
                        if (!empty($address_data["postal_code"])) {
                        ?>
                          <div class="col-6 shadow-sm rounded-3 mt-3">
                            <label class="form-label fs-5 ">Postal Code<b class="text-danger fs-4">*</b></label>
                            <input type="text" class="form-control mb-3 mt-2 border-end-0 border-start-0 border-top-0" placeholder="Type Postal Code..." value="<?php echo $address_data["postal_code"]; ?>" id="postalcode">
                          </div>
                        <?php
                        } else {
                        ?>
                          <div class="col-6 shadow-sm rounded-3 mt-3">
                            <label class="form-label fs-5 ">Postal Code<b class="text-danger fs-4">*</b></label>
                            <input type="text" class="form-control mb-3 mt-2 border-end-0 border-start-0 border-top-0" placeholder="Type Postal Code..." id="postalcode">
                          </div>
                        <?php
                        }
                        ?>
                        <div class="col-6 shadow-sm rounded- mt-3">
                          <label class="form-label fs-5 ">Gender</label>
                          <input type="text" class="form-control mb-3 mt-2 border-end-0 border-start-0 border-top-0" readonly value="<?php echo $details_data["name"]; ?>">
                        </div>

                        <div class="col-12 mb-3  shadow-sm rounded-3">
                          <div class="col-10 offset-1 col-lg-6 offset-lg-3 mt-3">
                            <div class="row">
                              <div class=" d-grid mt-3 mb-4 mt-3 ">
                                <button class="btn btn-primary" onclick="updateProfile();">Update Profile</button>
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
        </div>
      </div>
    <?php
          } else {

    ?>
      <script>
        window.location = "home.php";
      </script>
    <?php
          }


    ?>

    <?php include "fooler.php" ?>

    </div>
  </div>
  <script src="bootstrap.js"></script>
  <script src="script.js"></script>
  <script src="bootstrap.bundle.js"></script>
</body>

</html>