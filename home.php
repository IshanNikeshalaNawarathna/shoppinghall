<?php
session_start();
require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="bootstrap.css" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
   <link rel="stylesheet" href="style.css">
   <title>Shopping Hall | Home</title>
   <link rel="icon" href="resocess/webLogo/logo.jpg">
</head>

<body class="bg-white " style="overflow-x: hidden;">

   <div class="container-fluid">
      <div class="row">

         <div class="col-12 shadow-sm p-3 mb-3 bg-body rounded-2">
            <?php include "header.php"; ?>
         </div>

         <div class="col-12 bg-white ">
            <div class="row g-3">

               <div class="col-lg-10 col-10 bg-white offset-1 offset-lg-1 rounded-4 shadow-sm  bg-body" style="margin-top: 20px;">
                  <div class="row">
                     <div class="col-12 justify-content-center rounded-4">
                        <div class="row mb-3">

                           <div class="offset-4 offset-lg-1 col-3 col-lg-1 newLogo " style="height: 60px;"></div>

                           <div class="col-12 col-lg-6 ">
                              <div class="input-group mt-4 ">
                                 <input type="text" class="form-control" placeholder="Search here.." aria-label="Text input with dropdown botton" id="basicSearchText" onkeyup="basicSearch(0);">

                                 <select class="form-select text-center" style="max-width:200px ;" id="basicSearchSelect">
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

                           <div class="col-12 col-lg-2 d-grid">
                              <button class="btn btn-primary mt-4 mb-2 shadow rounded-4" onclick="basicSearch(0);">Search</button>
                           </div>

                           <div class="col-12 col-lg-2  text-center text-lg-start " style="margin-top:26px ;">
                              <a href="advancedSearch.php" class="link-secondary text-decoration-none fw-bold">Advanced</a>
                           </div>


                        </div>
                     </div>
                  </div>

               </div>

               <div class="col-lg-12 col-12 bg-white offset-0 offset-lg-0 mt-4 rounded-4  bg-body" id="basicRsesult">
                  <div class="row">

                     <!-- carousel -->

                     <div class="col-lg-10 col-10 bg-white offset-1 offset-lg-1 mt-4 rounded-4 shadow  bg-body">
                        <div class="row">

                           <div id="carouselExampleIndicators" class="offset-2 col-8 carousel slide carousel-fade mt-3 mb-3" data-bs-ride="true">
                              <div class="carousel-indicators">
                                 <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                 <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                 <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                              </div>
                              <div class="carousel-inner ">
                                 <div class="carousel-item active">
                                    <img src="resocess/carousel_img/back3.jpg" class=" poster-img-1 d-block w-100 rounded-5  backimg" />
                                    <div class="carousel-caption  poster-caption">
                                       <h1 class="poster-title fs-1 fw-bold title offset-7 text-uppercase mt-5 mt-lg-0 d-none d-lg-block">Welcome to Shopping Hall....</h1>
                                       <h1 class="poster-title fs-5 fw-bold   text-uppercase mt-5 mt-lg-0 d-block d-lg-none">Welcome to Shopping Hall....</h1>
                                       <p class="poster-txt">The World's Best Online Store By One Click.</p>
                                    </div>
                                 </div>
                                 <div class="carousel-item">
                                    <img src="resocess/carousel_img/back1.jpg" class="d-block poster-img-1 d-block w-100 rounded-5  backimg" />
                                 </div>
                                 <div class="carousel-item">
                                    <img src="resocess/carousel_img/back2.jpg" class="d-block poster-img-1 d-block w-100 rounded-5  backimg" />
                                    <div class="carousel-caption  poster-caption-1">
                                       <h5 class="poster-title fs-2 fw-bold">Be Free...</h5>
                                       <p class="poster-txt">Experience the Lowest Delivery Costs With Us.</p>
                                    </div>
                                 </div>

                              </div>
                              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                 <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                 <span class="visually-hidden">Previous</span>
                              </button>
                              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                 <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                 <span class="visually-hidden">Next</span>
                              </button>
                           </div>

                        </div>
                     </div>
                     <!-- carousel -->




                     <?php
                     $category = Database::search("SELECT * FROM `category`");
                     $category_new_data = $category->num_rows;

                     for ($x = 0; $x < $category_new_data; $x++) {
                        $cnd = $category->fetch_assoc();

                     ?>
                        <div class="col-lg-10 col-10 bg-white offset-1 offset-lg-1 rounded-4 shadow-lg mt-4 mb-3  ">
                           <div class="row rounded-4 g-1">
                              <!-- category -->
                              <div class="col-10 col-lg-10 offset-1 offset-lg-1 mt-3 mb-2 me-lg-4 me-sm-4">
                                 <a href="#" class="text-decoration-none link-dark fs-5  fw-bold"><?php echo $cnd["name"]; ?></a>&nbsp;&nbsp;
                                 <a href="#" class="text-decoration-none  link-dark fs-5 fw-bold">Sell All &nbsp;&rarr;</a>
                              </div>
                              <div class="col-7 col-lg-6">
                                 <hr class="border border-1 border-primary rounded-3">
                              </div>

                              <!-- category -->
                              <!-- product -->
                              <div class="col-10 col-lg-10 offset-1 offset-lg-1 shadow-lg mb-3 rounded-4  mt-4 mb-3 ">
                                 <div class="row  ">
                                    <div class=" col-12">
                                       <div class="row justify-content-center gap-3  border-0">
                                          <!-- card -->

                                          <?php

                                          $product_rs = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $cnd["id"] . "' AND `status_id`='1'
                                    ORDER BY `datetime_added` DESC LIMIT 6 OFFSET 0 ");
                                          $product_num = $product_rs->num_rows;

                                          for ($a = 0; $a < $product_num; $a++) {
                                             $product_data = $product_rs->fetch_assoc();





                                          ?>
                                             <?php
                                             if ($product_data["type"] == 1 && $product_data["qty"] > 0) {
                                             ?>

                                                <div class="card mt-2 mb-2  text-center col-6 col-lg-6 rounded-4" style="width: 25rem;">
                                                   <div class="col-1 col-lg-1 mt-1 mb-1">
                                                      <span class="badge bg-danger text-start">New</span>
                                                   </div>
                                                   <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $product_data["description"]; ?>" title="Product Details">

                                                      <?php

                                                      $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id` ='" . $product_data["id"] . "'");
                                                      $image_data = $image_rs->fetch_assoc();

                                                      ?>

                                                      <img src="<?php echo $image_data["code"]; ?>" class="img-fluid rounded-start imgView " style="height: 150px;">
                                                   </span>
                                                   <div class="card-body ms-0 m-0 text-center ">
                                                      <h5 class="card-title fs-6 fw-bold"><?php echo $product_data["title"]; ?></h5>
                                                      <span class="card-text text-primary">Rs.<?php echo $product_data["price"]; ?>.00</span> <br />

                                                      <?php

                                                      if ($product_data["qty"] > 0) {


                                                      ?>

                                                         <span class="card-text text-warning fw-bold">In Stock</span> <br />
                                                         <span class="card-text text-success fw-bold"><?php echo $product_data["qty"]; ?> Items Available</span><br /><br />
                                                         <div class="row ">
                                                            <div class="col-12 col-lg-12  ">
                                                               <a href='<?php echo "singleProductView.php?id=" . $product_data["id"]; ?>' class="btn btn-primary  mt-0 mt-lg-0 fs-5 rounded-4 shadow">Buy Now</a>

                                                               <button class="btn btn-outline-white  border border-info" onclick="addToCart(<?php echo $product_data['id']; ?>);"><i class="bi bi-cart-fill fs-5"></i></button>


                                                            <?php


                                                         } else {

                                                            ?>


                                                               <span class="card-text text-warning fw-bold ">Out Of Stock</span> <br />
                                                               <span class="card-text text-success fw-bold">00 Items Available</span><br /><br />

                                                               <button class="btn btn-primary mt-1 mt-lg-0  fs-5 disabled">Buy Now</button>

                                                               <button class="btn btn-outline-white border mt-1 mt-lg-0 border-info disabled"><i class="bi bi-cart-fill fs-5"></i></button>



                                                               <?php

                                                            }

                                                            if (isset($_SESSION["u"])) {
                                                               $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $product_data["id"] . "' AND
                                                             `user_email`='" . $_SESSION["u"]["email"] . "'");

                                                               $watchlist_num = $watchlist_rs->num_rows;

                                                               if ($watchlist_num == 1) {
                                                               ?>

                                                                  <button class=" btn btn-outline-white  border border-info" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);">
                                                                     <i class="bi bi-plus-lg text-black fw-bold fs-5 " id="plus<?php echo $product_data['id']; ?>"></i></button>

                                                               <?php
                                                               } else {
                                                               ?>

                                                                  <button class=" btn btn-outline-white   border border-info" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);">
                                                                     <i class="bi bi-plus-lg text-black fw-bold fs-5 " id="plus<?php echo $product_data['id']; ?>"></i></button>

                                                               <?php
                                                               }
                                                            } else {

                                                               ?>

                                                               <button class=" btn btn-outline-light border border-info" onclick="window.location = 'index.php';">
                                                                  <i class="bi bi-plus-lg  text-dark fs-5"></i>
                                                               </button>

                                                            <?php

                                                            }



                                                            ?>
                                                            </div>
                                                         </div>
                                                   </div>

                                                </div>
                                             <?php
                                             }
                                             ?>

                                          <?php
                                          }



                                          ?>

                                       </div>

                                    </div>
                                 </div>
                              </div>


                              <!-- product -->


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

   </div>
   <?php include "fooler.php"; ?>

   <script src="bootstrap.js"></script>
   <script src="script.js"></script>
   <script src="bootstrap.bundle.js"></script>
   <script>
      var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
      var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
         return new bootstrap.Popover(popoverTriggerEl)
      })
   </script>
   <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

</body>

</html>