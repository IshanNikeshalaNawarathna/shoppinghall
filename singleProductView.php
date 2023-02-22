<?php
session_start();
require "connection.php";

if (isset($_GET["id"])) {
   $product_id = $_GET["id"];

   $product_rs = Database::search("SELECT product.price,product.qty,product.description,product.title,product.datetime_added,product.delivery_free_colombo,
   product.delivery_free_other,product.color_id,product.category_id,product.brand_has_model_id,
   product.condition_id,product.user_email,product.status_id,model.name AS model_name,brand.name AS brand_name FROM `product`INNER JOIN `brand_has_model` ON brand_has_model.id = brand_has_model_id
   INNER JOIN `model` ON model.id = brand_has_model.model_id INNER JOIN `brand` ON brand.id = brand_has_model.brand_id
   WHERE product.id ='" . $product_id . "'");


   $product_num = $product_rs->num_rows;

   if ($product_num == 1) {
      $product_data = $product_rs->fetch_assoc();

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
         <title>Shopping Hall | <?php echo $product_data["title"]; ?></title>
      </head>

      <body style="overflow-x:hidden ;">

         <div class="container-fluid">
            <div class="row">

               <div class="col-12 shadow-sm mt-3 mb-3">
                  <div class="row">
                     <?php include "header.php"; ?>
                  </div>
               </div>


               <div class="col-12 mt-2 bg-body shadow-sm rounded-4">
                  <div class="row">
                     <div class="col-12 mt-2">
                        <div class="row">

                           <div class="col-12 col-lg-2 order-2 order-lg-1 bg-white rounded-4 shadow-sm mt-4 mb-5 d-none d-lg-block bg-body">
                              <?php

                              $images_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_id . "'");
                              $images_num = $images_rs->num_rows;

                              $img = array();

                              if ($images_num != 0) {
                                 for ($x = 0; $x < $images_num; $x++) {

                                    $images_data = $images_rs->fetch_assoc();
                                    $img[$x] = $images_data["code"];

                              ?>
                                    <li class="d-flex flex-column justify-content-center align-items-center  mb-1 mt-2 border-0">
                                       <img src="<?php echo $img["$x"]; ?>" class=" " style="height:150px ;width: auto;" id="productImg<?php echo $x; ?>" onclick="mainImg(<?php echo $x; ?>);">
                                    </li>
                                 <?php

                                 }
                              } else {
                                 ?>
                                 <li class="d-flex flex-column justify-content-center align-items-center border-danger border-1 border-secondary mb-1 mt-2">
                                    <img src="#" class="img-thumbnail mt-1 mb-1" style="height:150px ;width: auto;">
                                 </li>
                                 <li class="d-flex flex-column justify-content-center align-items-center border-danger border-1 border-secondary mb-1 mt-2">
                                    <img src="#" class="img-thumbnail mt-1 mb-1" style="height:150px ;width: auto;">
                                 </li>
                                 <li class="d-flex flex-column justify-content-center align-items-center border-danger border-1 border-secondary mb-1 mt-2">
                                    <img src="#" class="img-thumbnail mt-1 mb-1" style="height:150px ;width: auto;">
                                 </li>

                              <?php
                              }

                              ?>

                           </div>

                           <div class="col-lg-4 order-2 order-lg-1  mt-2 py-2">
                              <div class="row">
                                 <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">

                                    <?php
                                    $img = array();

                                    $img[0] = "";
                                    $img[1] = "";
                                    $img[2] = "";

                                    $product_img_new_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_id . "'");
                                    $product_img_new_num = $product_img_new_rs->num_rows;

                                    for ($m = 0; $m < $product_img_new_num; $m++) {
                                       $product_img_new_data = $product_img_new_rs->fetch_assoc();
                                       $img[$m] = $product_img_new_data["code"];
                                    }
                                    ?>
                                    <div class="carousel-inner" style="margin-left:10px ;">
                                       <div class="carousel-item active">
                                          <img src="<?php echo $img[0]; ?>" class="d-block d-lg-block  " style="height:500px;">
                                       </div>
                                       <div class="carousel-item ">
                                          <img src="<?php echo $img[1]; ?>" class="d-block " style="height:500px ;">
                                       </div>
                                       <div class="carousel-item">
                                          <img src="<?php echo $img[2]; ?>" class="d-block " style="height:500px ;">
                                       </div>

                                    </div>
                                 </div>
                              </div>
                           </div>

                           <?php

                           $price = $product_data["price"];
                           $adding_price = ($price / 100) * 5;
                           $new_price = $price + $adding_price;
                           $difference = $new_price - $price;
                           $percentage = ($difference / $price) * 100;

                           ?>

                           <div class="col-12 col-lg-6 order-3 mt-3 mb-3 bg-white rounded-4 shadow p-3 mb-5 bg-body">
                              <div class="row g-2">
                                 <div class="col-12">
                                    <div class="row">
                                       <div class="col-12 my-1">
                                          <span class="fs-4"><?php echo $product_data["title"]; ?></span>
                                       </div>
                                       <div class="col-7 col-lg-6">
                                          <hr class="border border-1 rounded-4 border-primary">
                                       </div>

                                       <?php

                                       $avg_rs = Database::search("SELECT AVG(`rate_count`) FROM `rating` WHERE `product_id`='" . $product_id . "' ");
                                       $avg_data = $avg_rs->fetch_assoc();

                                       $star_rs = Database::search("SELECT * FROM `rating` WHERE `product_id`='" . $product_id . "' ");
                                       $star_num = $star_rs->num_rows;

                                       $average = 0;

                                       if ($star_num != 0) {
                                          $avg = implode(" ", $avg_data);
                                          $average = number_format($avg);
                                       }
                                       ?>

                                       <div class="row  ">
                                          <div class="col-12 my-2">
                                             <span class="badge">

                                                <?php

                                                if ($average == 0) {

                                                ?>

                                                   <i class="bi bi-star-fill text-secondary fs-5"></i>
                                                   <i class="bi bi-star-fill text-secondary fs-5"></i>
                                                   <i class="bi bi-star-fill text-secondary fs-5"></i>
                                                   <i class="bi bi-star-fill text-secondary fs-5"></i>
                                                   <i class="bi bi-star-fill text-secondary fs-5"></i>

                                                <?php

                                                } else if ($average == 1) {

                                                ?>

                                                   <i class="bi bi-star-fill text-warning fs-5"></i>
                                                   <i class="bi bi-star-fill text-secondary fs-5"></i>
                                                   <i class="bi bi-star-fill text-secondary fs-5"></i>
                                                   <i class="bi bi-star-fill text-secondary fs-5"></i>
                                                   <i class="bi bi-star-fill text-secondary fs-5"></i>

                                                <?php

                                                } else if ($average == 2) {
                                                ?>
                                                   <i class="bi bi-star-fill text-warning fs-5"></i>
                                                   <i class="bi bi-star-fill text-warning fs-5"></i>
                                                   <i class="bi bi-star-fill text-secondary fs-5"></i>
                                                   <i class="bi bi-star-fill text-secondary fs-5"></i>
                                                   <i class="bi bi-star-fill text-secondary fs-5"></i>
                                                <?php
                                                } else if ($average == 3) {
                                                ?>
                                                   <i class="bi bi-star-fill text-warning fs-5"></i>
                                                   <i class="bi bi-star-fill text-warning fs-5"></i>
                                                   <i class="bi bi-star-fill text-warning fs-5"></i>
                                                   <i class="bi bi-star-fill text-secondary fs-5"></i>
                                                   <i class="bi bi-star-fill text-secondary fs-5"></i>
                                                <?php
                                                } else if ($average == 4) {
                                                ?>
                                                   <i class="bi bi-star-fill text-warning fs-5"></i>
                                                   <i class="bi bi-star-fill text-warning fs-5"></i>
                                                   <i class="bi bi-star-fill text-warning fs-5"></i>
                                                   <i class="bi bi-star-fill text-warning  fs-5"></i>
                                                   <i class="bi bi-star-fill text-secondary fs-5"></i>
                                                <?php
                                                } else if ($average == 5) {
                                                ?>
                                                   <i class="bi bi-star-fill text-warning fs-5"></i>
                                                   <i class="bi bi-star-fill text-warning fs-5"></i>
                                                   <i class="bi bi-star-fill text-warning fs-5"></i>
                                                   <i class="bi bi-star-fill text-warning  fs-5"></i>
                                                   <i class="bi bi-star-fill text-warning fs-5"></i>
                                                <?php
                                                }
                                                ?>
                                                &nbsp;&nbsp;

                                                <label class="fs-5 text-dark fw-bold"><?php echo $average; ?> Stars | <?php echo $star_num; ?> Reviews & Ratings</label>
                                             </span>
                                          </div>
                                       </div>

                                       <?php

                                       $city_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $_SESSION["u"]["email"] . "'");
                                       $city_num = $city_rs->num_rows;

                                       if ($city_num == 1) {

                                          $city_data = $city_rs->fetch_assoc();

                                          $city_id = $city_data["city_id"];

                                          $district_rs = Database::search("SELECT * FROM `city` WHERE `id` = '" . $city_id . "'");
                                          $district_data = $district_rs->fetch_assoc();

                                          $district_id = $district_data["district_id"];

                                          $delivery;

                                          if ($district_id == "1") {

                                             $delivery = $product_data["delivery_free_colombo"];
                                          } else {

                                             $delivery = $product_data["delivery_free_other"];
                                          }

                                          // $item = $product_data["title"];
                                          $amount = ((int)$product_data["price"] * (int)1) + (int)$delivery;
                                       }

                                       ?>

                                       <div class="col-11 offset-1 my-1">
                                          <span class="fs-4">Price : Rs. <b class="text-primary fs-4"><?php echo $price; ?></b> .00</span>&nbsp;&nbsp; | &nbsp; &nbsp;
                                          <span class="fs-4 text-danger text-decoration-line-through">Price : Rs. <b class="text-danger fs-4"><?php echo $new_price; ?></b> .00</span>&nbsp;&nbsp; | &nbsp; &nbsp;
                                          <span class="fs-4"> <b class="text-black-50 fs-4"><?php echo $difference; ?></b> .00(<?php echo $percentage ?>%)</span>
                                       </div>

                                       <div class="col-11 offset-1 my-1 mb-1">
                                          <?php
                                          $color_rs = Database::search("SELECT * FROM `color` WHERE `id`='" . $product_data["color_id"] . "'");
                                          $color_data = $color_rs->fetch_assoc();
                                          ?>
                                          <span class="fs-4 text-black">Colour : <?php echo $color_data["name"] ?></span>
                                       </div>

                                       <div class="col-6 offset-1 col-lg-5 offset-lg-2 border rounded-4 border-danger shadow mt-2 mb-2">
                                          <div class="row  ">
                                             <div class="col-12">
                                                <span class=" text-text-black-50  fs-6">Warrent : <span class="text-danger fs-6">4</span> Months Warrent</span><br>
                                                <span class="fs-6 text-black">Return Policy : <span class="text-danger fs-6">1</span> Months Return Policy</span><br>
                                                <span class="fs-6 text-black">In Stock :<span class="text-danger fs-6">&nbsp;<?php echo $product_data["qty"]; ?></span>&nbsp;Items Available</span><br>
                                             </div>
                                          </div>
                                       </div>


                                       <div class="row mt-2  ">
                                          <div class="col-4 col-lg-3 offset-1 ">
                                             <label class="form-label fs-4">AVALIABLE : <b class="fs-4 text-warning"><?php echo $product_data["qty"]; ?></b> </label>
                                          </div>
                                          <div class="col-6 col-lg-4">
                                             <div class="row">
                                                <div class="col-6 col-lg-6">
                                                   <label class="form-label fs-4">Quantity :</label>
                                                </div>
                                                <div class="col-6 col-lg-6">
                                                   <input type="number" class="form-control " value="1" min="0" id="qty_input" onclick='qty_dec(<?php echo $product_data["qty"]; ?>)' onkeyup="checkValues(<?php echo $product_data['qty']; ?>)">
                                                </div>
                                             </div>
                                          </div>
                                       </div>

                                       <div class="col-6 offset-1 col-lg-5 offset-lg-2 border rounded-4 border-dark shadow mt-3 mb-3">
                                          <?php
                                          $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                          $seller_data = $seller_rs->fetch_assoc();

                                          $seller_product_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $seller_data["email"] . "'");
                                          $seller_product_data = $seller_product_rs->fetch_assoc();
                                          ?>
                                          <span class="fs-5 fw-bold ms-3"><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?> </span>&nbsp;&nbsp; | &nbsp; &nbsp;
                                          <span class="fs-5 fw-bold">Solad items : <?php echo $seller_product_data["qty"]; ?></span>
                                       </div>

                                       <div class="col-12">
                                          <hr class="border border-2 bg-warning border-warning rounded-3">
                                       </div>

                                       <div class="col-10 col-lg-10 offset-lg-2 offset-0">
                                          <img src="resocess/payment_method/paypal_img.png" style="height:80px ;background-repeat: no-repeat;background-size: contain;margin-left: 10px;">
                                          <img src="resocess/payment_method/mastercard_img.png" style="height:80px ;background-repeat: no-repeat;background-size: contain;margin-left: 30px;">
                                          <img src="resocess/payment_method/visa_img.png" style="height:80px ;background-repeat: no-repeat;background-size: contain;margin-left: 30px;">
                                          <img src="resocess/payment_method/american_express_img.png" style="height:80px ;background-repeat: no-repeat;background-size: contain;margin-left: 30px;">
                                       </div>

                                       <div class="col-12">
                                          <hr class="border border-2 bg-warning border-warning rounded-3">
                                       </div>

                                       <div class="row">
                                          <div class="col-12 offset-lg-2 offset-2 ">
                                             <div class="row g-1">
                                                <input class="d-none" type="text" value="<?php echo $product_data["title"]; ?>" id="title">
                                                <input class="d-none" type="text" value="<?php echo $product_id; ?>" id="id">
                                                <input class="d-none" type="text" value="<?php echo $product_data["price"]; ?>" id="price">
                                                <input class="d-none" type="text" value="<?php echo $delivery; ?>" id="deliveryFee">
                                                <div class="col-5 col-lg-5 d-grid ">
                                                   <button class="btn btn-primary fs-4 shadow rounded-5" type="submit" onclick="buyNow();">Buy Now</button>
                                                   <!-- onclick="payNow();" -->
                                                </div>
                                                <div class="col-5 col-lg-3 offset-1 offset-lg-1">
                                                   <button class="btn btn-outline-dark fs-4" onclick="addToCart(<?php echo $product_id; ?>);"><i class="bi bi-cart-fill fs-4"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                   <button class="btn btn-outline-dark fs-4" onclick="addToWatchlist(<?php echo $product_id; ?>);"><i class="bi bi-plus-lg text-black fw-bold fs-4"></i></button>
                                                </div>
                                             </div>
                                          </div>
                                       </div>


                                       <!-- payment model -->
                                       <!-- <div class="modal fade" id="buyNow" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                          <div class="modal-dialog modal-dialog-centered">
                                             <div class="modal-content">
                                                <div class="modal-header" style="background-color:#f8f9f9;">
                                                   <h1 class="modal-title fs-4  fw-bold " id="exampleModalToggleLabel">Payment Method</h1>
                                                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="clos"></button>
                                                </div>
                                                <div class="modal-body ">

                                                   <div class="col-12">
                                                      <div class="row">

                                                      </div>
                                                   </div>

                                                </div>
                                                <div class="modal-footer" style="background-color:#f8f9f9;">
                                                   <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btnClos">Close</button>
                                                   <button type="button" class="btn btn-primary" onclick="verifiNewCategory();">Save New Category</button>
                                                </div>
                                             </div>
                                          </div>
                                       </div> -->
                                       <!-- payment model -->


                                    </div>
                                 </div>



                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-12 col-lg-12 mt-3 mb-3 bg-white rounded-4 shadow p-3 mb-5 bg-body">
                        <div class="row">
                           <div class="col-12 mt-2">
                              <span class="fs-3 fw-bold">Related Items</span>
                           </div>

                           <div class="col-12 col-lg-9 offset-0 offset-lg-1 mt-2">
                              <div class="row">
                                 <?php

                                 $brand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `id`='" . $product_data["brand_has_model_id"] . "'");
                                 $brand_data = $brand_rs->fetch_assoc();

                                 $p_rs = Database::search("SELECT product.id AS product_id,product.title,product.price,product.qty,product.type,
                                          product.description,brand.id,brand.name AS brand_name, model.name AS model_name  FROM `product` INNER JOIN `brand_has_model` ON product.brand_has_model_id = brand_has_model.id
                                          INNER JOIN `brand` ON brand.id = brand_has_model.brand_id INNER JOIN `model` ON model.id = brand_has_model.model_id WHERE brand.id = '" . $brand_data["brand_id"] . "' AND type='1' LIMIT 4");

                                 $p_num = $p_rs->num_rows;

                                 for ($z = 0; $z < $p_num; $z++) {
                                    $p_data = $p_rs->fetch_assoc();
                                    if ($p_data["type"] == 1 && $p_data["qty"] > 0) {



                                 ?>
                                       <?php

                                       ?>
                                       <div class="card mb-3 mx-0 mx-lg-2 col-12 col-lg-5 rounded-4">
                                          <div class="row g-0">

                                             <div class="col-12">
                                                <div class="row">

                                                   <!-- <div class="col-6"> -->

                                                   <div class="col-md-5 mt-4">

                                                      <div class="col-12 mt-3">
                                                         <div class="row">

                                                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">

                                                               <?php
                                                               $img = array();

                                                               $img[0] = "";
                                                               $img[1] = "";
                                                               $img[2] = "";

                                                               $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $p_data["product_id"] . "'");
                                                               $product_img_num = $product_img_rs->num_rows;

                                                               for ($y = 0; $y < $product_img_num; $y++) {
                                                                  $product_img_data = $product_img_rs->fetch_assoc();
                                                                  $img[$y] = $product_img_data["code"];
                                                               }
                                                               ?>
                                                               <div class="carousel-inner">
                                                                  <div class="carousel-item active">
                                                                     <img src="<?php echo $img[0]; ?>" class="d-block w-75 " alt="...">
                                                                  </div>
                                                                  <div class="carousel-item">
                                                                     <img src="<?php echo $img[1]; ?>" class="d-block w-75" alt="...">
                                                                  </div>
                                                                  <div class="carousel-item">
                                                                     <img src="<?php echo $img[2]; ?>" class="d-block w-75" alt="...">
                                                                  </div>

                                                               </div>
                                                            </div>


                                                         </div>
                                                      </div>


                                                   </div>

                                                   <!-- </div> -->
                                                   <!-- <div class="col-6"> -->
                                                   <div class="col-md-5 mt-4 mb-3 bg-white rounded-4 shadow p-3 mb-5 bg-body " style="width: 20rem;">
                                                      <div class="col-1 col-lg-1 mb-1">
                                                         <span class="badge bg-danger text-start">New</span>
                                                      </div>
                                                      <div class="card-body">

                                                         <h5 class="card-title fw-bold text-black"><?php echo $p_data["title"]; ?></h5>
                                                         <span class="fs-5 fw-bold text-black-50 card-text">Color : <b class="text-black fs-6"> <?php echo $color_data["name"] ?></b> </span><br>
                                                         <?php
                                                         $condition_rs = Database::search("SELECT * FROM `condition` WHERE `id` = '" . $product_data["condition_id"] . "'");
                                                         $condition_data = $condition_rs->fetch_assoc();
                                                         ?>
                                                         <span class="fs-5 fw-bold text-black-50 card-text">Condition :<b class="text-black fs-6"><?php echo $condition_data["name"]; ?></b></span><br>
                                                         <span class="fs-5 fw-bold text-black-50 card-text">Price : <b class="fs-5 text-black">Rs.</b> <b class="text-primary fs-6"><?php echo $p_data["price"]; ?>.00</b></span><br>

                                                         <?php
                                                         $user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $product_data["user_email"] . "'");
                                                         $user_data = $user_rs->fetch_assoc();
                                                         ?>
                                                         <span class="fs-5 fw-bold text-black-50 card-text">Seller : <b class="text-secondary fs-6"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?> </b></span>
                                                         <?php

                                                         if ($p_data["qty"] > 0) {
                                                         ?>
                                                            <span class="fs-5 fw-bold text-black-50 card-text">Quantity : <b class="text-danger fs-6"><?php echo $p_data["qty"]; ?></b><b class="text-black fs-6"> Items Availible</b></span><br>
                                                            <div class="row ">
                                                               <div class="col-12  mt-2">
                                                                  <a href='<?php echo "singleProductView.php?id=" . $product_data["id"]; ?>' class="btn btn-outline-primary">Buy Now</a>
                                                                  <a href="" class="btn btn-outline-secondary " onclick="addToCart(<?php echo $p_data['id']; ?>);"><i class="bi bi-cart-fill fs-6"></i></a>
                                                               <?php
                                                            } else {
                                                               ?>
                                                                  <span class="card-text text-danger">Out Of Stock</span><br>
                                                                  <span class="card-text text-danger">No Items Available</span><br>
                                                                  <span class="col-5 btn btn-outline-danger">Buy Now</span>
                                                                  <span class=" col-5 btn btn-outline-danger">Add To Cart</span>
                                                                  <?php

                                                               }

                                                               if (isset($_SESSION["u"])) {
                                                                  $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $p_data["id"] . "' AND
                                                      `user_email`='" . $_SESSION["u"]["email"] . "'");
                                                                  $watchlist_num = $watchlist_rs->num_rows;

                                                                  if ($watchlist_num == 1) {
                                                                  ?>

                                                                     <a href="" class="btn btn-outline-info" onclick="addToWatchlist(<?php echo $p_data['product_id']; ?>);"> <i class="bi bi-plus-lg text-black fw-bold fs-6"></i></a>
                                                                  <?php


                                                                  } else {
                                                                  ?>
                                                                     <a href="" class="btn btn-outline-info" onclick="addToWatchlist(<?php echo $p_data['product_id']; ?>);"> <i class="bi bi-plus-lg text-black fw-bold fs-6"></i></a>
                                                                  <?php
                                                                  }
                                                               } else {
                                                                  ?>
                                                                  <a href="" class="btn btn-outline-info" onclick='window.location ="index.php;"'><i class="bi bi-plus-lg text-black fw-bold fs-5"></i></a>

                                                               <?php


                                                               }
                                                               ?>
                                                               </div>
                                                            </div>
                                                      </div>
                                                   </div>
                                                   <!-- </div> -->


                                                </div>
                                             </div>

                                          </div>
                                       </div>
                                 <?php
                                    }
                                 }

                                 ?>



                              </div>

                           </div>


                           <div class="col-12">
                              <div class="row">

                                 <div class="col-6 col-lg-6">
                                    <div class="col-12">
                                       <span class="fs-3 fw-bold">Product Details</span>
                                    </div>
                                 </div>
                                 <div class="col-6 col-lg-6">
                                    <div class="col-12">
                                       <span class="fs-3 fw-bold">Feedbacks</span>
                                    </div>
                                 </div>

                              </div>
                           </div>

                           <div class="col-6 ">
                              <div class="row">

                                 <div class="col-12 col-lg-6 mt-2">

                                    <div class="col-4">
                                       <span class="fs-4 fw-bold">Brand :</span>
                                    </div>
                                    <div class="col-8">
                                       <span class="fs-4"><?php echo $product_data["brand_name"]; ?></span>
                                    </div>

                                 </div>

                                 <div class="col-12 col-lg-6">

                                    <div class="col-4">
                                       <span class="fs-5 fw-bold">Model :</span>
                                    </div>
                                    <div class="col-8">
                                       <span class="fs-5"><?php echo $product_data["model_name"]; ?></span>
                                    </div>

                                 </div>

                              </div>
                           </div>

                           <div class="col-6 mt-3 mb-3 bg-white rounded-4 shadow p-3 mb-5 bg-body">
                              <div class="row overflow-scroll" style="height:300px;">
                                 <?php

                                 $feedback_rs = Database::search("SELECT * FROM `feedback` WHERE `product_id` ='" . $product_id . "'");
                                 $feedback_num = $feedback_rs->num_rows;

                                 if ($feedback_num == 0) {

                                 ?>


                                    <div class="col-12 mt-1 mb-1 mx-1">
                                       <div class="row">
                                          <div class="col-12 text-center">
                                             <span class="text-black-50 fs-3">Not Feedbacks Yet..</span>
                                          </div>
                                       </div>
                                    </div>
                                    <?php
                                 } else {

                                    for ($w = 0; $w < $feedback_num; $w++) {
                                       $feedback_data = $feedback_rs->fetch_assoc();

                                       $buy_rs = Database::search("SELECT * FROM `user` WHERE `email` ='" . $feedback_data["user_email"] . "'");
                                       $buy_data = $buy_rs->fetch_assoc();

                                    ?>

                                       <div class="col-10 mt-1 mb-1 mx-1">
                                          <div class="row me-0">

                                             <div class="col-12 col-lg-7 bg-info rounded-5 shadow">
                                                <div class="row">
                                                   <div class="col-1 col-lg-1 mb-2 mt-2">
                                                      <?php
                                                      $feedback_user_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $feedback_data["user_email"] . "'");
                                                      $feedback_user_num = $feedback_user_rs->num_rows;

                                                      if ($feedback_user_num == 1) {
                                                         $feedback_user_data = $feedback_user_rs->fetch_assoc();
                                                      ?>

                                                         <img src="<?php echo $feedback_user_data["path"]; ?>" class="rounded-circle" style="height: 60px;width: auto;">

                                                      <?php
                                                      } else {
                                                      ?>

                                                         <img src="resocess/projectUser.png" class="rounded-circle" style="height: 60px;width: auto;">

                                                      <?php
                                                      }

                                                      ?>
                                                   </div>
                                                   <div class="col-9 col-lg-9 offset-1 mb-2 mt-3 ">
                                                      <div class="col-9 mt-2 mb-2 ms-5 ms-lg-3   offset-lg-0">
                                                         <span class="fw-bold fs-6 text-uppercase text-white "><?php echo $buy_data["fname"] . " " . $buy_data["lname"]; ?></span>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>



                                             <div class="col-9 offset-5 mt-2">
                                                <div class="row">
                                                   <div class="col-12 bg-dark justify-content-center d-flex rounded-5 shadow">
                                                      <div class="row align-items-center">
                                                         <p class="text-center fw-bold text-white mt-2 fs-6"><?php echo $feedback_data["feedback"]; ?></p>
                                                         <div class="col-12 ">
                                                            <div class="row text-end">
                                                               <p class="text-center fw-bold text-white text-end"><?php echo $feedback_data["date_time"]; ?></p>
                                                            </div>
                                                         </div>

                                                      </div>
                                                   </div>
                                                </div>
                                             </div>

                                          </div>
                                       </div>
                                 <?php

                                    }
                                 }

                                 ?>
                              </div>
                           </div>
                           <div class="col-12 col-lg-12 bg-white  rounded-4 shadow-sm p-3 mb-5 bg-body">
                              <div class="row">
                                 <div class="col-12">
                                    <span class="fs-3 fw-bold">Description</span>
                                 </div>
                                 <textarea cols="60" rows="10" class="form-control" readonly><?php echo $product_data["description"]; ?></textarea>
                              </div>
                           </div>


                        </div>
                     </div>


                     <?php include "fooler.php";?>


                  </div>
               </div>
            </div>
         </div>

         <script src="script.js"></script>
         <script src="bootstrap.js"></script>
         <!-- <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script> -->


      </body>

      </html>
<?php
   } else {
      echo ("Sorry For the Inconvenience..");
   }
} else {
   echo ("Something Went Wrong..");
}


?>