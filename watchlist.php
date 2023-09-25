<?php
session_start();
require "connection.php";

if(isset($_SESSION["u"])){


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="style.css" />
  <title>Shopping Hall | Watchlist</title>
  <link rel="icon" href="resocess/webLogo/logo.jpg">
</head>

<body  style="overflow-x: hidden;">

  <div class="container-fluid">
    <div class="row">

      <div class="col-12 shadow-sm p-3 mb-3 bg-body rounded-2">
        <?php include "header.php";



        if (isset($_SESSION["u"])) {


        ?>
      </div>
      <div class="col-12 col-lg-12 mt-3 bg-body shadow-sm  rounded-4">
        <div class="row">

          <div class=" col-9 col-lg-5 offset-lg-2 offset-0 mb-3 mt-4">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search.." aria-label="Text input with dropdown botton" id="basicSearchText" onkeyup="basicSearch(0);">
              <select class="form-select text-center" style="max-width: 180px;" id="basicSearchSelect">
                <option value="0">All Categories</option>
                <?php

                $categroy_rs = Database::search("SELECT * FROM `category` ");
                $category_num = $categroy_rs->num_rows;

                for ($x = 0; $x < $category_num; $x++) {
                  $category_data = $categroy_rs->fetch_assoc();

                ?>

                  <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>


                <?php


                }


                ?>

              </select>
            </div>
          </div>
          <div class="col-3 col-lg-2 d-grid mb-4 mt-4">
            <button class="btn btn-primary shadow rounded-4" onclick="basicSearch(0);">Search</button>
          </div>
          <div class="col-2 col-lg-2 offset-5 offset-lg-0 mb-3 text-center text-lg-start " style="margin-top:25px ;">
            <a href="advancedSearch.php" class="link-secondary text-decoration-none fw-bold">Advanced</a>
          </div>


        </div>
      </div>
      <div class="col-12 mt-3" id="basicRsesult">
        <div class="row g-3">

          <div class="col-12 mb-2 shadow-sm rounded-4 ">
            <div class="row  bg-body ">
              <div class="col-12 mt-2">
                <label class="form-label fs-1 fw-bold"><i class="bi bi-bookmark-heart-fill fs-1"></i></i>&nbsp;| Shopping Watchlist</label>
              </div>

              <div class="col-7 col-lg-6">
                <hr class="border border-5 bg-warning border-warning rounded-3">
              </div>
            </div>
          </div>

          <div class="col-12  col-lg-2 shadow-sm bg-white  rounded-4 mb-3">
            <div class="row">
              <nav class="breadcrumb  mt-2 px-2 g-lg-2">
                <a class="breadcrumb-item fs-5" href="home.php">Home</a>
                <span class="breadcrumb-item active fs-5">Watchlist</span>
              </nav>
              <nav class="nav flex-column nav-pills px-2">
                <a href="#" aria-current="page" class="fs-6">My Watchlist</a>
                <a href="cart.php" class="nav-link fs-6">My Cart</a>
                <!-- <a href="singleProductView.php" class="nav-link fs-6">Product Buy Now</a> -->
              </nav>
            </div>
          </div>

          <?php

          $user = $_SESSION["u"]["email"];

          $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $user . "'");
          $watch_num = $watch_rs->num_rows;

          if ($watch_num == 0) {

          ?>
            <!-- empty -->
            <div class="col-12 col-lg-9  offset-lg-1 offset-0 shadow-sm  bg-body rounded-4 mb-3 ">
              <div class="row">
                <div class="col-12 bookmark mt-4"></div>
                <div class="col-12 text-center mt-2">
                  <label class="form-label fs-2 fw-bold text-black-50">You Have No Items in your Watchlist Yet.</label>
                </div>
                <div class="offset-lg-4 offset-4 col-4 col-lg-4 d-grid mb-3">
                  <a href="home.php" class="btn btn-info">Start Shopping </a>
                </div>
              </div>
              <!-- empty -->
            <?php

          } else {

            ?>
              <div class="col-12 col-lg-9 offset-2 offset-lg-1 ">
                <div class="row">

                  <?php

                  for ($x = 0; $x < $watch_num; $x++) {
                    $watch_data = $watch_rs->fetch_assoc();

                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $watch_data["product_id"] . "'");
                    $product_data = $product_rs->fetch_assoc();

                    $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                    $seller_data = $seller_rs->fetch_assoc();

                  ?>



                    <div class="card mb-3 mx-0 mx-lg-2 col-8 mt-4 mb-3 bg-white rounded-4 shadow p-3 mb-5 bg-body">
                      <div class="row g-0">
                        <div class="col-md-4 mt-4">

                          <div class="col-12 mt-3 mt-4 mb-3 bg-white rounded-4 shadow p-3 mb-5 bg-body">
                            <div class="row">

                              <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                                <?php
                                $img = array();

                                $img[0] = "";
                                $img[1] = "";
                                $img[2] = "";

                                $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
                                $product_img_num = $product_img_rs->num_rows;

                                for ($y = 0; $y < $product_img_num; $y++) {
                                  $product_img_data = $product_img_rs->fetch_assoc();
                                  $img[$y] = $product_img_data["code"];
                                }
                                ?>
                                <div class="carousel-inner" style="margin-left:-2px ;">
                                  <div class="carousel-item active">
                                    <img src="<?php echo $img[0]; ?>" class="d-block w-100" alt="...">
                                  </div>
                                  <div class="carousel-item">
                                    <img src="<?php echo $img[1]; ?>" class="d-block w-100" alt="...">
                                  </div>
                                  <div class="carousel-item">
                                    <img src="<?php echo $img[2]; ?>" class="d-block w-100" alt="...">
                                  </div>

                                </div>
                              </div>


                            </div>
                          </div>


                        </div>&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="col-md-5 mt-5 mb-3 bg-white rounded-4 shadow p-3 mb-5 bg-body" style="margin-left:0px ;">
                          <div class="col-1 col-lg-1 mb-1">
                            <span class="badge bg-danger text-start">New</span>
                          </div>
                          <div class="card-body">

                            <h5 class="card-title fw-bold text-warning"><?php echo $product_data["title"]; ?>&nbsp;</h5>
                            <?php

                            $color_rs = Database::search("SELECT * FROM `color` WHERE `id`='" . $product_data["color_id"] . "'");
                            $color_data = $color_rs->fetch_assoc();

                            $condition_rs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $product_data["condition_id"] . "'");
                            $condition_data = $condition_rs->fetch_assoc();
                            ?>
                            <span class="fs-5 fw-bold text-black-50 card-text">Coloru : <b class="text-black fs-5"><?php echo $color_data["name"]; ?></b> </span><br>
                            <span class="fs-5 fw-bold text-black-50 card-text">Condition :<b class="text-black fs-5"> <?php echo $condition_data["name"]; ?></b></span><br>
                            <span class="fs-5 fw-bold text-black-50 card-text">Price : <b class="fs-5 text-black">Rs.</b> <b class="text-primary fs-5"><?php echo $product_data["price"]; ?>.00</b></span><br>
                            <span class="fs-5 fw-bold text-black-50 card-text">Quantity : <b class="text-danger fs-5"><?php echo $product_data["qty"]; ?></b><b class="text-black fs-5"> Items Availible</b></span><br>
                            <span class="fs-5 fw-bold text-black-50 card-text">Seller : <b class="text-secondary fs-5"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></b></span>
                          </div>
                        </div>
                        <div class="row ">
                          <div class="col-12 col-lg-12 offset-lg-6 offset-0  py-2 ">
                            <a href='<?php echo "singleProductView.php?id=" . $product_data["id"]; ?>' class="btn btn-primary mb-2 shadow rounded-3">Buy Now</a>
                            <button class="btn btn-info mb-2 shadow rounded-3" onclick="addToCart(<?php echo $product_data['id']; ?>);">Add To Cart</button>
                            <button class="btn btn-danger mt-1 mb-3 shadow rounded-3" onclick='removeFromWatchlist(<?php echo $watch_data["id"] ?>);'>Remove</button>
                          </div>
                        </div>
                      </div>
                    </div>&nbsp;&nbsp;
                  <?php

                  }

                  ?>
                </div>

              </div>
            <?php

          }

            ?>






            </div>

        </div>
      <?php

        } else {
      ?>
        <script>
          // window.location = "home.php";
        </script>
      <?php
        }

      ?>


      </div>

      <?php include "fooler.php"; ?>
    </div>

  </div>
  <script src="bootstrap.bundle.js"></script>
  <script src="script.js"></script>
</body>

</html>

<?php
}else{
  ?>
  <script>
        window.location = "home.php";
  </script>
<?php
}