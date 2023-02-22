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
  <title>Shoppin Hall | Manage Product</title>
  <link rel="icon" href="resocess/webLogo/logo.jpg">
</head>

<body>

  <div class="container-fluid">
    <div class="row">

      <?php include "adminHeader.php"; ?>


      <hr class="d-block d-lg-none">

      <div class="col-12  shadow-sm mt-1 mt-lg-0">
        <div class="row">

          <div class="col-12 shadow-sm bg-white rounded-4 mt-4">
            <div class="row">
              <div class="col-6 col-lg-4 offset-2 offset-lg-3 mb-3">
                <input type="text" class="form-control" placeholder="Search her..." id="basicSearchText">
              </div>
              <div class="col-3 col-lg-2 d-grid mb-3">
                <button class="btn btn-primary" onclick="basicSearchAdminProduct(0);">Search</button>
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
                              <img src="<?php echo $admin_img_data["path"]; ?>" class="rounded-circle shadow" style="height: 65px;width: auto;background-repeat: no-repeat;">
                            <?php
                            } else {
                            ?>
                              <img src="resocess/projectUser.png" class="rounded-circle shadow" style="height: 65px;width: auto;background-repeat: no-repeat;">
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
                          <div class="col-12 divColor">
                            <a class="nav-link text-dark fs-5 mb-3" href="adminPenal.php">Dashboard</a>
                          </div>

                          <a class="nav-link text-dark fs-5 mb-3" href="manageUser.php">Manage Users</a>
                          <a class="nav-link text-dark fs-5 mb-3" href="#">Manage Products</a>
                          <a class="nav-link text-dark fs-5 mb-3" href="productAdd.php">Add Product</a>
                          <a class="nav-link text-dark fs-5 mb-3" href="sellingHistory.php">Selling History</a>
                          <!-- <a class="nav-link text-danger fs-5 mb-3" href="manageProduct.php">Sgin Out</a> -->
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

                  <div class="col-12 mangediv ">
                    <div class=" row">



                      <div class="col-12 mt-3 ">
                        <label class="form-label fs-4 fw-bold">Manage Product</label>
                        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                          <ol class="breadcrumb bg-white">
                            <li class="breadcrumb-item"><a href="adminPenal.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Product</li>
                          </ol>
                        </nav>
                      </div>

                      <div class="col-12">
                        <hr style="width: 90%;" class="border border-2 border-info rounded-4">
                      </div>

                      <div class="col-12">
                        <div class="row">

                          <div class="col-11 offset-0 col-lg-10 offset-lg-1">
                            <div class="row">

                              <table class="table text-start align-middle  table-hover mb-0">
                                <thead>
                                  <tr class="text-dark">
                                    <th scope="col" class="fs-6">#</th>
                                    <th scope="col" class="fs-6">Product Image</th>
                                    <th scope="col" class="fs-6">Title</th>
                                    <th scope="col" class="fs-6">Price</th>
                                    <th scope="col" class="fs-6">Register Date</th>
                                    <th scope="col"></th>

                                  </tr>
                                </thead>
                                <tbody>

                                  <?php

                                  $pageno;

                                  $query = "SELECT * FROM `product`";

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

                                    $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $selected_data["user_email"] . "'");
                                    $seller_data = $seller_rs->fetch_assoc();

                                    $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $selected_data["id"] . "'");
                                    $img_data = $img_rs->fetch_assoc();

                                  ?>

                                    <tr>
                                      <td class="fs-6"><?php echo $x + 1; ?></td>
                                      <td onclick="productDetalisModel('<?php echo $selected_data['id']; ?>');">
                                        <img src="<?php echo $img_data["code"]; ?>" class=" shadow" style="background-repeat: no-repeat;height: 60px;width: auto;">
                                      </td>
                                      <td class="fs-6"><?php echo $selected_data["title"]; ?></td>
                                      <td class="fs-6">Rs.<?php echo $selected_data["price"]; ?>./=</td>
                                      <td class="fs-6"><?php echo $selected_data["datetime_added"] ?></td>
                                      <td>
                                        <div class="col-12">
                                          <?php
                                          if ($selected_data["status_id"] ==  1) {
                                          ?>
                                            <button class="btn btn-warning shadow" id="buttonStatus<?php echo $selected_data['id']; ?>" onclick="blockProductChengStatus('<?php echo $selected_data['id']; ?>');">Block</button>
                                          <?php
                                          } else {
                                          ?>
                                            <button class="btn btn-dark shadow" id="buttonStatus<?php echo $selected_data['id']; ?>" onclick="blockProductChengStatus('<?php echo $selected_data['id']; ?>');">Unblock</button>
                                          <?php
                                          }
                                          ?>
                                        </div>
                                      </td>
                                    </tr>

                                    <!-- User datelis Model -->
                                    <div class="modal fade" id="productDetalisModel<?php echo $selected_data["id"]; ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                      <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                          <div class="modal-header" style="background-color: #d0ece7;">
                                            <h1 class="modal-title fs-4  fw-bold " id="exampleModalToggleLabel"><?php echo $selected_data["title"]; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body " style="background-color:  #fbfcfc ;">

                                            <div class="col-5 mt-3 mb-3 shadow-lg rounded-3 offset-3 offset-lg-3">
                                              <img src="<?php echo $img_data["code"]; ?>" style="background-repeat: no-repeat;height: 200px;width: auto;">
                                            </div>

                                            <div class="col-12 bg-white mt-3 p-4 mb-3 shadow-lg rounded-4 px-4">
                                              <span class="fs-5 fw-bold">Price :</span>
                                              <span class="fs-5">Rs.<?php echo $selected_data["price"]; ?>/=</span><br>
                                              <span class="fs-5 fw-bold">Quantity :</span>
                                              <span class="fs-5"><?php echo $selected_data["qty"]; ?> Items</span><br>
                                              <span class="fs-5 fw-bold">Description :</span>
                                              <span class="fs-5"><?php echo $selected_data["description"]; ?></span><br>
                                              <span class="fs-5 fw-bold">Seller :</span>
                                              <span class="fs-5"><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></span>
                                            </div>

                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary shadow" data-bs-dismiss="modal">Close</button>
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

                      <!-- category add  -->

                      <div class="col-12 shadow rounded-4 mb-3 mt-2">
                        <div class="row  ">

                          <div class="col-12 mt-3">
                            <div class="row g-2">
                              <div class="col-8 col-lg-8">
                                <label class="form-label fs-4 fw-bold">Manage Category</label>
                              </div>
                              <div class="col-4 col-lg-3 d-grid">
                                <button class="btn btn-dark rounded-5 shadow " onclick="newCategoryModel();">Add Category</button>
                              </div>
                            </div>
                          </div>

                          <div class="col-12">
                            <hr width="90%" class="border border-2 border-info rounded-4">
                          </div>

                          <div class="col-11 mt-3 mb-4">
                            <div class="row ">

                              <div class="col-12 d-none" id="msgdiv-1">
                                <div class="alert alert-info p-2 text-center" role="alert" id="alertdiv-1">
                                  <div class="row">
                                    <div class="col-11 text-start">
                                      <i class="bi bi-exclamation-triangle-fill fs-6" id="msg-1"></i>
                                    </div>
                                    <div class="col-1 p-0 text-center">
                                      <i class="bi bi-x" style="cursor: pointer;" onclick="hideAlert();"></i>
                                    </div>
                                  </div>
                                </div>
                              </div>


                            </div>
                          </div>

                          <div class="col-12 offset-1  justify-content-center">
                            <div class="row gap-1 g-3">

                              <?php

                              $category_rs = Database::search("SELECT * FROM `category`");
                              $category_num = $category_rs->num_rows;

                              for ($category = 0; $category < $category_num; $category++) {
                                $category_data = $category_rs->fetch_assoc();

                              ?>
                                <div class="col-5 col-lg-3  border rounded-3 mb-4 ">
                                  <div class="row ">
                                    <div class="col-8 border border-bottom-0 border-right-0 border-start-0 border-top-0 border-2 mb-2 mt-2">
                                      <label class="form-label fs-6 p-2 fw-bold"><?php echo $category_data["name"]; ?></label>
                                    </div>
                                    <div class="col-4 mt-2 text-center">
                                      <label class="form-label fs-2"><i class="bi bi-trash fs-2 text-danger " onclick="deleteCategory('<?php echo $category_data['id']; ?>')"></i></label>
                                    </div>
                                  </div>
                                </div>
                              <?php
                              }

                              ?>


                            </div>

                          </div>
                        </div>
                      </div>

                      <!-- category add  -->

                      <!--model add  -->

                      <div class="col-12 shadow rounded-4 mt-3 mb-3">
                        <div class="row">

                          <div class="col-12 mt-3">
                            <div class="row">
                              <div class="col-8 col-lg-8">
                                <label class="form-label fs-4 fw-bold">Manage Model</label>
                              </div>
                              <div class="col-4 col-lg-3 d-grid">
                                <button class="btn btn-primary rounded-5 shadow " onclick="newModelModel();">Add Model</button>
                              </div>
                            </div>
                          </div>

                          <div class="col-12">
                            <hr width="90%" class="border border-2 border-info rounded-4">
                          </div>

                          <div class="col-11 mt-3 mb-4">
                            <div class="row">

                              <div class="col-12 d-none" id="msgdiv-1">
                                <div class="alert alert-info p-2 text-center" role="alert" id="alertdiv-1">
                                  <div class="row">
                                    <div class="col-11 text-start">
                                      <i class="bi bi-exclamation-triangle-fill fs-6" id="msg-1"></i>
                                    </div>
                                    <div class="col-1 p-0 text-center">
                                      <i class="bi bi-x" style="cursor: pointer;" onclick="hideAlert();"></i>
                                    </div>
                                  </div>
                                </div>
                              </div>


                            </div>
                          </div>

                          <div class="col-12 offset-1  justify-content-center">
                            <div class="row gap-1">

                              <?php

                              $model_rs = Database::search("SELECT * FROM `model`");
                              $model_num = $model_rs->num_rows;

                              for ($model = 0; $model < $model_num; $model++) {
                                $model_data = $model_rs->fetch_assoc();

                              ?>
                                <div class="col-5 col-lg-3  border rounded-3 mb-4 ">
                                  <div class="row ">
                                    <div class="col-8 border border-bottom-0 border-right-0 border-start-0 border-top-0 border-2 mb-2 mt-2">
                                      <label class="form-label fs-6 p-2 fw-bold"><?php echo $model_data["name"]; ?></label>
                                    </div>
                                    <div class="col-4 mt-2 text-center">
                                      <label class="form-label fs-2"><i class="bi bi-trash fs-2 text-danger " onclick="deletemodel('<?php echo $model_data['id']; ?>')"></i></label>
                                    </div>
                                  </div>
                                </div>
                              <?php
                              }

                              ?>


                            </div>

                          </div>
                        </div>
                      </div>

                      <!-- model add  -->

                      <!--model add  -->

                      <div class="col-12 shadow rounded-4 mt-3 mb-3">
                        <div class="row">

                          <div class="col-12 mt-3">
                            <div class="row">
                              <div class="col-8 col-lg-8">
                                <label class="form-label fs-4 fw-bold">Manage Brand</label>
                              </div>
                              <div class="col-4 col-lg-3 d-grid">
                                <button class="btn btn-success rounded-5 shadow " onclick="newBrandModel();">Add Brand</button>
                              </div>
                            </div>
                          </div>

                          <div class="col-12">
                            <hr width="90%" class="border border-2 border-info rounded-4">
                          </div>

                          <div class="col-11 mt-3 mb-4">
                            <div class="row">

                              <div class="col-12 d-none" id="msgdiv-1">
                                <div class="alert alert-info p-2 text-center" role="alert" id="alertdiv-1">
                                  <div class="row">
                                    <div class="col-11 text-start">
                                      <i class="bi bi-exclamation-triangle-fill fs-6" id="msg-1"></i>
                                    </div>
                                    <div class="col-1 p-0 text-center">
                                      <i class="bi bi-x" style="cursor: pointer;" onclick="hideAlert();"></i>
                                    </div>
                                  </div>
                                </div>
                              </div>


                            </div>
                          </div>

                          <div class="col-12 offset-1  justify-content-center">
                            <div class="row gap-1">

                              <?php

                              $brand_rs = Database::search("SELECT * FROM `brand`");
                              $brand_num = $brand_rs->num_rows;

                              for ($brand = 0; $brand < $brand_num; $brand++) {
                                $brand_data = $brand_rs->fetch_assoc();

                              ?>
                                <div class="col-5 col-lg-3  border rounded-3 mb-4 ">
                                  <div class="row ">
                                    <div class="col-8 border border-bottom-0 border-right-0 border-start-0 border-top-0 border-2 mb-2 mt-2">
                                      <label class="form-label fs-6 p-2 fw-bold"><?php echo $brand_data["name"]; ?></label>
                                    </div>
                                    <div class="col-4 mt-2 text-center">
                                      <label class="form-label fs-2"><i class="bi bi-trash fs-2 text-danger " onclick="deleteBrand('<?php echo $brand_data['id']; ?>')"></i></label>
                                    </div>
                                  </div>
                                </div>
                              <?php
                              }

                              ?>


                            </div>

                          </div>
                        </div>
                      </div>

                      <!-- model add  -->
                    </div>
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>

      <!-- category add model -->
      <div class="modal fade" id="newCategoryModel" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#f8f9f9;">
              <h1 class="modal-title fs-4  fw-bold " id="exampleModalToggleLabel">New Category</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">

              <div class="col-12 d-none" id="msgdiv-1">
                <div class="alert alert-danger p-2" role="alert" id="alertdiv-1">
                  <div class="row">
                    <div class="col-11 text-start">
                      <i class="bi bi-exclamation-triangle-fill fs-6" id="msg-1"></i>
                    </div>
                    <div class="col-1 p-0 text-center">
                      <i class="bi bi-x" style="cursor: pointer;" onclick="hideAlert();"></i>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="row">

                  <div class="col-6">
                    <label class="form-label fs-5 fw-bold">Add New Category</label>
                    <input type="text" class="form-control" placeholder="New Category" id="newCategory">
                  </div>
                  <div class="col-6">
                    <label class="form-label fs-5 fw-bold">Email</label>
                    <input type="text" class="form-control" placeholder="Email" id="email">
                  </div>

                </div>
              </div>

            </div>
            <div class="modal-footer" style="background-color:#f8f9f9;">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary shadow" onclick="verifiNewCategory();">Save New Category</button>
            </div>
          </div>
        </div>
      </div>
      <!-- category add model -->

      <!-- category verifi model -->
      <div class="modal fade" id="addCategoryVerificationModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#f8f9f9;">
              <h1 class="modal-title fs-4  fw-bold " id="exampleModalToggleLabel">Category Verification</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">

              <div class="col-12 d-none" id="msgdiv-1">
                <div class="alert alert-danger p-2" role="alert" id="alertdiv-1">
                  <div class="row">
                    <div class="col-11 text-start">
                      <i class="bi bi-exclamation-triangle-fill fs-6" id="msg-1"></i>
                    </div>
                    <div class="col-1 p-0 text-center">
                      <i class="bi bi-x" style="cursor: pointer;" onclick="hideAlert();"></i>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="row">
                  <div class="col-12">
                    <label class="form-label fs-5 fw-bold">Verification Code</label>
                    <input type="text" class="form-control" placeholder="Verification Code" id="verificationCode">
                  </div>

                </div>
              </div>

            </div>
            <div class="modal-footer" style="background-color:#f8f9f9;">
              <button type="button" class="btn btn-secondary shadow" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary shadow" onclick="verifiCategory();">Save</button>
            </div>
          </div>
        </div>
      </div>
      <!-- category verifi model -->

      <!-- model add model -->
      <div class="modal fade" id="newModelModel" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#f8f9f9;">
              <h1 class="modal-title fs-4  fw-bold " id="exampleModalToggleLabel">New Model</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">

              <div class="col-12 d-none" id="msgdiv-1">
                <div class="alert alert-danger p-2" role="alert" id="alertdiv-1">
                  <div class="row">
                    <div class="col-11 text-start">
                      <i class="bi bi-exclamation-triangle-fill fs-6" id="msg-1"></i>
                    </div>
                    <div class="col-1 p-0 text-center">
                      <i class="bi bi-x" style="cursor: pointer;" onclick="hideAlert();"></i>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="row">

                  <div class="col-6">
                    <label class="form-label fs-5 fw-bold">Add New Model</label>
                    <input type="text" class="form-control" placeholder="New Model" id="newModel">
                  </div>
                  <div class="col-6">
                    <label class="form-label fs-5 fw-bold">Email</label>
                    <input type="text" class="form-control" placeholder="Email" id="modelTonewEmail">
                  </div>

                </div>
              </div>

            </div>
            <div class="modal-footer" style="background-color:#f8f9f9;">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary shadow" onclick="verifiNewModel();">Save New Model</button>
            </div>
          </div>
        </div>
      </div>
      <!-- model add model -->

      <!-- model verifi model -->
      <div class="modal fade" id="addModelVerificationModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#f8f9f9;">
              <h1 class="modal-title fs-4  fw-bold " id="exampleModalToggleLabel">Model Verification</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">

              <div class="col-12 d-none" id="msgdiv-1">
                <div class="alert alert-danger p-2" role="alert" id="alertdiv-1">
                  <div class="row">
                    <div class="col-11 text-start">
                      <i class="bi bi-exclamation-triangle-fill fs-6" id="msg-1"></i>
                    </div>
                    <div class="col-1 p-0 text-center">
                      <i class="bi bi-x" style="cursor: pointer;" onclick="hideAlert();"></i>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="row">
                  <div class="col-12">
                    <label class="form-label fs-5 fw-bold">Verification Code</label>
                    <input type="text" class="form-control" placeholder="Verification Code" id="newModelverificationCode">
                  </div>

                </div>
              </div>

            </div>
            <div class="modal-footer" style="background-color:#f8f9f9;">
              <button type="button" class="btn btn-secondary shadow" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary shadow" onclick="verifiModel();">Save</button>
            </div>
          </div>
        </div>
      </div>
      <!-- model verifi model -->



      <!-- brad add model -->
      <div class="modal fade" id="newBrandModel" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#f8f9f9;">
              <h1 class="modal-title fs-4  fw-bold " id="exampleModalToggleLabel">New Brand</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">

              <div class="col-12 d-none" id="msgdiv-1">
                <div class="alert alert-danger p-2" role="alert" id="alertdiv-1">
                  <div class="row">
                    <div class="col-11 text-start">
                      <i class="bi bi-exclamation-triangle-fill fs-6" id="msg-1"></i>
                    </div>
                    <div class="col-1 p-0 text-center">
                      <i class="bi bi-x" style="cursor: pointer;" onclick="hideAlert();"></i>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="row">

                  <div class="col-6">
                    <label class="form-label fs-5 fw-bold">Add New Brand</label>
                    <input type="text" class="form-control" placeholder="New Brand" id="newBrand">
                  </div>

                  <div class="col-6">
                    <label class="form-label fs-5 fw-bold">Select Category</label>
                    <select class="form-select" id="selectBrandCategory" placeholder="Select Category">
                      <?php



                      $categroyView_rs = Database::search("SELECT * FROM `category` ");
                      $categroyView_num = $categroyView_rs->num_rows;

                      for ($x = 0; $x < $categroyView_num; $x++) {
                        $categroyView_data = $categroyView_rs->fetch_assoc();

                      ?>

                        <option value="<?php echo $categroyView_data["id"]; ?>"><?php echo $categroyView_data["name"]; ?></option>


                      <?php


                      }


                      ?>

                    </select>

                  </div>
                  <div class="col-12">
                    <label class="form-label fs-5 fw-bold">Email</label>
                    <input type="text" class="form-control" placeholder="Email" id="brandTonewEmail">
                  </div>

                </div>
              </div>

            </div>
            <div class="modal-footer" style="background-color:#f8f9f9;">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary shadow" onclick="verifiNewBrand();">Save New Brand</button>
            </div>
          </div>
        </div>
      </div>
      <!-- brand add model -->

      <!-- brand verifi model -->
      <div class="modal fade" id="addBrandVerificationModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#f8f9f9;">
              <h1 class="modal-title fs-4  fw-bold " id="exampleModalToggleLabel">Brand Verification</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">

              <div class="col-12 d-none" id="msgdiv-3">
                <div class="alert alert-danger p-2" role="alert" id="alertdiv-3">
                  <div class="row">
                    <div class="col-11 text-start">
                      <i class="bi bi-exclamation-triangle-fill fs-6" id="msg-3"></i>
                    </div>
                    <div class="col-1 p-0 text-center">
                      <i class="bi bi-x" style="cursor: pointer;" onclick="hideAlert();"></i>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="row">
                  <div class="col-12">
                    <label class="form-label fs-5 fw-bold">Verification Code</label>
                    <input type="text" class="form-control" placeholder="Verification Code" id="newBrandverificationCode">
                  </div>

                </div>
              </div>

            </div>
            <div class="modal-footer" style="background-color:#f8f9f9;">
              <button type="button" class="btn btn-secondary shadow" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary shadow" onclick="verifiBrand();">Save</button>
            </div>
          </div>
        </div>
      </div>
      <!--brand verifi model -->


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



    </div>
  </div>
  <script src="bootstrap.js"></script>
  <script src="script.js"></script>

</body>

</html>