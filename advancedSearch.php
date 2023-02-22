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
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
   <link rel="stylesheet" href="style.css" />

   <link rel="icon" href="resocess/webLogo/logo.jpg" >
   <title>Shooping Hall | Advanced</title>
</head>

<body style="overflow-x:hidden ;">

   <div class="container-fluid ">
      <div class="row">

         <div class="col-12 shadow-sm mb-3 mt-3">
            <div class="row">

               <?php include "header.php"; ?>

            </div>
         </div>

         <div class="col-12">
            <div class="row ">

               <div class="col-10 offset-1 shadow rounded-4 mt-2 mb-2">
                  <div class="row">

                     <div class="col-12">
                        <div class="row g-1">

                           <div class="col-12 bg-body mb-4 shadow  bg-body rounded-3 mt-3">
                              <div class="row g-1">
                                 <div class="offset-lg-4 col-10 col-lg-4 mb-3 mt-3">
                                    <div class="row g-1">
                                       <div class="col-4">
                                          <div class="offset-0 offset-lg-6 col-6 col-lg-8 newLogo " style="height: 60px;"></div>
                                       </div>
                                       <div class="col-6  text-center">
                                          <p class="fs-3 text-primary fw-bold mt-2 pt-2">Advanced Search</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>

                        </div>
                     </div>


                     <div class="col-12">
                        <div class="row g-1">

                           <div class="offset-lg-0 col-12 offset-0 col-lg-12 bg-body rounded-3 shadow mt-2 mb-2">
                              <div class="row">

                                 <div class="offset-lg-2 col-10 col-lg-8 ">
                                    <div class="row">
                                       <div class="col-7 offset-1  offset-lg-0 col-lg-8 mt-4 mb-1">
                                          <input type="text" class="form-control" placeholder="Type Keyword to Search......" id="txt">
                                       </div>
                                       <div class="col-4  col-lg-4 mt-4 mb-1 d-grid">
                                          <button class="btn btn-primary" onclick="advancedSearch(0);"> Search</button>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-12">
                                    <hr class="border border-3 border-primary">
                                 </div>
                              </div>
                           </div>

                           <div class="offset-lg-0 col-12 offset-0 col-lg-12 bg-body rounded-3 mt-2 ">
                              <div class="row g-1">

                                 <div class="col-12">
                                    <div class="row g-1">

                                       <div class="col-12 mt-3">
                                          <div class="row g-1">

                                             <div class="col-8 offset-2 col-lg-3 offset-lg-1 mb-3 mt-2 shadow rounded-4">
                                                <select class="form-select border-end-0 border-start-0 border-top-0 mt-3 mb-3" id="category">
                                                   <option value="0">Select Category</option>
                                                   <?php

                                                   $category_rs = Database::search("SELECT * FROM `category`");
                                                   $category_num = $category_rs->num_rows;

                                                   for ($x = 0; $x < $category_num; $x++) {
                                                      $category_data = $category_rs->fetch_assoc();

                                                   ?>
                                                      <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>
                                                   <?php
                                                   }
                                                   ?>
                                                </select>
                                             </div>
                                             <div class="col-7 col-lg-3 offset-lg-1 mb-3 mt-2 shadow rounded-4">
                                                <select class="form-select border-end-0 border-start-0 border-top-0 mt-3 mb-3" id="model">
                                                   <option value="0">Select Model</option>
                                                   <?php

                                                   $model_rs = Database::search("SELECT * FROM `model`");
                                                   $model_num = $model_rs->num_rows;

                                                   for ($x = 0; $x < $model_num; $x++) {
                                                      $model_data = $model_rs->fetch_assoc();

                                                   ?>
                                                      <option value="<?php echo $model_data["id"]; ?>"><?php echo $model_data["name"]; ?></option>
                                                   <?php
                                                   }
                                                   ?>
                                                </select>
                                             </div>
                                             <div class="col-7 offset-5 col-lg-3 offset-lg-1 mb-3 mt-2 shadow rounded-4">
                                                <select class="form-select border-end-0 border-start-0 border-top-0 mt-3 mb-3" id="brand">
                                                   <option value="0">Select Brand</option>
                                                   <?php

                                                   $brand_rs = Database::search("SELECT * FROM `brand`");
                                                   $brand_num = $brand_rs->num_rows;

                                                   for ($x = 0; $x < $brand_num; $x++) {
                                                      $brand_data = $brand_rs->fetch_assoc();

                                                   ?>
                                                      <option value="<?php echo $brand_data["id"]; ?>"><?php echo $brand_data["name"]; ?></option>
                                                   <?php
                                                   }
                                                   ?>
                                                </select>
                                             </div>
                                             <div class="col-7 offset-0 col-lg-5 mb-3 mt-2 shadow rounded-4">
                                                <select class="form-select border-end-0 border-start-0 border-top-0 mt-3 mb-3" id="color">
                                                   <option value="0">Select Colour</option>
                                                   <?php

                                                   $color_rs = Database::search("SELECT * FROM `color`");
                                                   $color_num = $color_rs->num_rows;

                                                   for ($x = 0; $x < $color_num; $x++) {
                                                      $color_data = $color_rs->fetch_assoc();

                                                   ?>
                                                      <option value="<?php echo $color_data["id"]; ?>"><?php echo $color_data["name"]; ?></option>
                                                   <?php
                                                   }
                                                   ?>
                                                </select>
                                             </div>
                                             <div class="col-8 offset-4 col-lg-5 offset-lg-1 mb-3 mt-2 shadow rounded-4">
                                                <input type="text" class=" form-control border-end-0 border-start-0 border-top-0 mt-3 mb-3" placeholder="Price From........" id="pr">
                                             </div>
                                             <div class="col-6 col-lg-5 offset-lg-1 mb-3 mt-2 shadow rounded-4">
                                                <input type="text" class=" form-control border-end-0 border-start-0 border-top-0 mt-3 mb-3" placeholder="Price To........" id="pt">
                                             </div>
                                             <div class="col-7 offset-4 col-lg-5 offset-lg-1 mb-3 mt-2 shadow rounded-4">
                                                <select class="form-select border-end-0 border-start-0 border-top-0 mt-3 mb-3" id="con">
                                                   <option value="0">Select Condition</option>
                                                   <?php

                                                   $condition_rs = Database::search("SELECT * FROM `condition`");
                                                   $condition_num = $condition_rs->num_rows;

                                                   for ($x = 0; $x < $condition_num; $x++) {
                                                      $condition_data = $condition_rs->fetch_assoc();

                                                   ?>
                                                      <option value="<?php echo $condition_data["id"]; ?>"><?php echo $condition_data["name"]; ?></option>
                                                   <?php
                                                   }
                                                   ?>
                                                </select>
                                             </div>

                                             <div class=" col-8 offset-1 col-lg-4 offset-lg-8 text-center mt-2 mb-3 shadow rounded-4">
                                                <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-primary mt-3 mb-3" id="sort">
                                                   <option value="0">SORT BY</option>
                                                   <option value="1">PRICE LOW TO HIGH</option>
                                                   <option value="2">PRICE HIGH TO LOW</option>
                                                   <option value="3">QUANTITY LOW TO HIGH</option>
                                                   <option value="4">QUANTITY HIGH TO LOW</option>
                                                </select>
                                             </div>

                                          </div>
                                       </div>

                                    </div>
                                 </div>



                              </div>
                           </div>

                           <div class="col-12 shadow rounded-4 mb-4">
                              <div class="row g-1">

                                 <!-- <div class="offset-lg-1 col-10 offset-1 col-lg-10 bg-body rounded-3 mt-2 shadow">
                                    <div class="row rounded-3" style="background-color: #f2f3f4  ;"> -->


                                       <div class="offset-lg-1 col-12 col-lg-12  mt-3  ">
                                          <div class="row " id="view_area">
                                             <div class="offset-5 col-2 mt-5">
                                                <span class="fw-bold text-black text-center"><i class="bi bi-search h1" style="font-size: 100px;"></i></span>
                                             </div>
                                             <div class="offset-2 offset-lg-2 col-9 col-lg-7 mt-3 mb-5 text-center">
                                                <span class="h1 text-black-50 fw-bold text-center">No Items Searched Yet...</span>
                                             </div>


                                          </div>
                                       </div>
                                    <!-- </div>
                                 </div> -->

                              </div>
                           </div>



                        </div>
                     </div>




                  </div>
               </div>

            </div>
         </div>



         <?php include "fooler.php"; ?>

      </div>
   </div>
   <script src="bootstrap.bundle.js"></script>
   <script src="script.js"></script>
</body>

</html>