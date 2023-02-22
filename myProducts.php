<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

  $email = $_SESSION["u"]["email"];
  $pageno;

?>

  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="resocess/webLogo/logo.jpg">
    <title>Shopping Hall | My Product</title>
  </head>

  <body>

    <div class="container-fluid">
      <div class="row">


        <!-- header -->
        <div class="col-12 bg-white mt-1 shadow-sm">
          <div class="row">
            <div class="col-12 col-lg-4">
              <div class="row">
                <div class="col-12 col-lg-4 mt-1 mb-2 text-center">
                  <?php

                  $profile_image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $email . "'");
                  $profile_image_num = $profile_image_rs->num_rows;
                  $profile_image_data = $profile_image_rs->fetch_assoc();

                  if ($profile_image_num == 1) {

                  ?>

                    <img src="<?php echo $profile_image_data["path"]; ?>" width="auto" height="80px" class="rounded-circle">

                  <?php

                  } else {

                  ?>
                    <img src="resocess/projectUser.png" width="90px" height="90px" class="rounded-circle">
                  <?php

                  }


                  ?>

                </div>
                <div class="col-12 col-lg-4">
                  <div class="row text-center text-lg-start">
                    <div class="col-12 mt-0 mt-lg-4 me-lg-0 ms-lg-3">
                      <span class="text-black fw-bold text-uppercase"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?> </span>
                    </div>
                    <div class="col-12">
                      <span class="text-black-50 fw-bold"><?php echo $email; ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="row">
                    <div class="col-6 col-lg-4  d-grid">
                      <button class="btn btn-info fw-bold text-white  mb-2 me-2 " onclick="window.location='addProduct.php'"><i class="bi bi-bag-plus-fill fs-5"></i>&nbsp;Add&nbsp;Product</button>
                    </div>
                    <div class="col-6 col-lg-4  d-grid">
                      <a href="productdelete.php" class="btn btn-warning fw-bold text-white mb-2 me-2 "><i class="bi bi-trash-fill fs-5">&nbsp;</i>Recycle&nbsp;Bin</a>
                    </div>
                  </div>
                </div>

              </div>
            </div>



          </div>
        </div>

        <div class="col-12 mb-2  shadow-sm  rounded-4 mt-3">
          <div class="row  bg-body ">
            <div class="col-12 mt-2">
              <label class="form-label fs-1 fw-bold"><i class="bi bi-cart-plus-fill fs-1"></i>&nbsp;| My Product</label>
            </div>

            <div class="col-7 col-lg-6">
              <hr class="border border-5 bg-warning border-warning rounded-3">
            </div>

            <div class="row">
              <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                  <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">My Product</li>
                </ol>
              </nav>
            </div>

          </div>
        </div>

        <!-- header -->
        <!-- body -->
        <div class="col-12 ">
          <div class="row">
            <!-- filter -->
            <div class="col-11 col-lg-2 mx-3 my-3 border rounded-4 bg-white">
              <div class="row">
                <div class="col-12 mt-3 fs-6">
                  <div class="row">
                    <div class="col-11">
                      <label class="form-label fw-bold fs-4">Sort Product</label>
                    </div>
                    <div class="col-11">
                      <div class="row">
                        <div class="col-10 mb-2">
                          <input type="text" placeholder="Search......" class="form-control border-top-0 border-start-0 border-end-0" id="search">
                        </div>
                        <div class="col-1 p-0 mt-0 mb-1">
                          <label class="form-label "><i class="bi bi-search fs-3 fw-bold"></i></label>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <label class="form-label fw-bold">Active Time</label>
                    </div>
                    <div class="col-12">
                      <hr style="width: 85%;color: red;">
                    </div>
                    <div class="col-12">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="r1" id="nto">
                        <label class="form-check-label" for="nto">Newest To Oldest</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="r1" id="otn">
                        <label class="form-check-label" for="otn">Oldest To Newest </label>
                      </div>
                    </div>
                    <div class="col-12 mt-3">
                      <label class="form-label fw-bold">By Quantity</label>
                    </div>
                    <div class="col-12">
                      <hr style="width: 85%;color: red;">
                    </div>
                    <div class="col-12">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="r2" id="htl">
                        <label class="form-check-label" for="htl">High To Low</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="r2" id="lth">
                        <label class="form-check-label" for="lth">Low To High</label>
                      </div>
                    </div>
                    <div class="col-12 mt-3">
                      <label class="form-label fw-bold">By Conndition</label>
                    </div>
                    <div class="col-12">
                      <hr style="width: 85%;color: red;">
                    </div>
                    <div class="col-12">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="r3" id="bn">
                        <label class="form-check-label" for="bn">Brandnew</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-check">
                        <input type="radio" class="form-check-input" name="r3" id="u">
                        <label class="form-check-label" for="u">Used</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <hr style="width: 85%;color: red;">
                    </div>
                    <div class="col-6 col-lg-6 d-grid  mb-3">
                      <button class="btn btn-primary" onclick="sort(0);"><i class="bi bi-sort-down"></i>Sort</button>
                    </div>
                    <div class="col-6 col-lg-6 d-grid  mb-3">
                      <button class="btn btn-danger" onclick="clearSort();"><i class="bi bi-x"></i>Clear</button>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- filter -->
            <!-- body -->

  

              <!-- product -->
              <div class=" col-10 offset-1 offset-lg-0  col-lg-9 mt-3 mb-3 bg-white rounded-4 shadow p-3 mb-5 bg-body">
                <div class="row gap-2" id="sort">
                  <div class="offset-1 col-10 text-center">
                    <div class="row justify-content-center ">

                      <?php

                      if (isset($_GET["page"])) {
                        $pageno = $_GET["page"];
                      } else {
                        $pageno = 1;
                      }

                      $product_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $email . "'");
                      $product_num = $product_rs->num_rows;


                      $results_per_page = 6;
                      $number_of_pages = ceil($product_num / $results_per_page);

                      $page_results = ($pageno - 1) * $results_per_page;
                      $selected_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $email . "' LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                      $selected_num = $selected_rs->num_rows;

                      for ($x = 0; $x < $selected_num; $x++) {
                        $selected_data = $selected_rs->fetch_assoc();
                        if ($selected_data["type"] == 1) {



                      ?>

                        <!-- card -->
                        <div class="card mb-3 col-12 col-lg-6 mt-3 ">
                          <div class="row ">
                            <div class="col-12 d-none  mt-3" id="msgdiv-1">
                              <div class="alert alert-info p-2 text-center" role="alert" id="alertdiv-1">
                                <div class="row">
                                  <div class="col-11 text-start">
                                    <i class="bi bi-exclamation-triangle-fill fs-6 text-center" id="msg-1"></i>
                                  </div>
                                  <div class="col-1 p-0 text-center">
                                    <i class="bi bi-x" style="cursor: pointer;" onclick="hideAlert();"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-4 mt-3 mb-1">

                              <?php

                              $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $selected_data["id"] . "'");
                              $product_img_data = $product_img_rs->fetch_assoc();

                              ?>

                              <img src="<?php echo $product_img_data["code"]; ?>" class="img-fluid rounded-start h-auto w-auto mb-3">
                            </div>
                            <div class="col-md-8">
                              <div class="card-body">
                                <h5 class="card-title fw-bold fs-4"><?php echo $selected_data["title"]; ?></h5>
                                <span class="card-text fw-bold text-info">Rs.<?php echo $selected_data["price"]; ?>.00</span><br>
                                <span class="card-text fw-bold text-success"><?php echo $selected_data["qty"]; ?> Items</span><br>
                                <?php

                                if ($selected_data["qty"] > 0) {
                                ?>
                                  <span class="card-text text-warning fw-bold">In Stock</span> <br />
                                <?php
                                } else {
                                ?>
                                  <span class="card-text text-warning fw-bold ">Out Of Stock</span> <br />
                                <?php
                                }
                                ?>

                                <div class="col-8 offset-2 mt-1">
                                  <div class="row">
                                    <div class="form-check form-switch ">
                                      <input type="checkbox" class="form-check-input" role="switch" id="fd<?php echo $selected_data["id"]; ?>" <?php if ($selected_data["status_id"] == 2) {

                                                                                                                                                ?> checked<?php
                                                                                                                                                        }
                                                                                                                                                          ?> onclick="changeStatus(<?php echo $selected_data['id']; ?>);">

                                      <label class="form-check-label fw-bold text-black-50 " for="fd<?php echo $selected_data["id"]; ?>">
                                        <?php if ($selected_data["status_id"] == 1) { ?>
                                          Make Your Product Active
                                        <?php } else { ?>
                                          Make Your Product Deactive
                                        <?php
                                        }
                                        ?>
                                      </label>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-12 offset-lg-3 offset-3 mt-5">
                                    <div class="row g-1">
                                      <div class="col-5 col-lg-5 d-grid">
                                        <button class="btn btn-secondary" onclick="sendId(<?php echo $selected_data['id']; ?>);"><i class="bi bi-arrow-repeat"></i>Update</button>
                                      </div>
                                      <div class="col-3 col-lg-4 d-grid ">
                                        <button class="btn btn-danger" onclick="deleteProduct(<?php echo $selected_data['id']; ?>);"><i class="bi bi-trash"></i>Delete</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- card -->
                      <?php
                      }
                      }
                      ?>

                    </div>
                  </div>




                  <!-- pagination -->
                  <div class="col-8 col-lg-6 text-center mb-3 offset-4 offset-lg-5">
                    <nav aria-label="Page navigation example">
                      <ul class="pagination">
                        <li class="page-item">
                        <li class="page-item">
                          <a class="page-link" href="
                                                <?php if ($pageno <= 1) {
                                                  echo ("#");
                                                } else {
                                                  echo "?page=" . ($pageno - 1);
                                                } ?>
                                                " aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                          </a>
                        </li>
                        <?php

                        for ($x = 1; $x <= $number_of_pages; $x++) {
                          if ($x == $pageno) {
                        ?>
                            <li class="page-item active">
                              <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                            </li>
                          <?php
                          } else {
                          ?>
                            <li class="page-item">
                              <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                            </li>
                        <?php
                          }
                        }

                        ?>

                        <li class="page-item">
                          <a class="page-link" href="
                                                <?php if ($pageno >= $number_of_pages) {
                                                  echo ("#");
                                                } else {
                                                  echo "?page=" . ($pageno + 1);
                                                } ?>
                                                " aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                          </a>
                        </li>
                      </ul>
                    </nav>
                  </div>

                  <!-- pagination -->
                </div>
              </div>

   

            <!-- product -->
          </div>
        </div>


      </div>
    </div>
    <script src="script.js"></script>
  </body>

  </html>

<?php

} else {
  header("Location:home.php");
}




?>