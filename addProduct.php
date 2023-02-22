<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="style.css">
  <title>Shopping Hall | Add Product</title>
  <link rel="icon" href="resocess/webLogo/logo.jpg">
</head>

<body style="overflow-x: hidden;">

  <div class="container-fluid">
    <div class="row gy-3 ">
      <div class="col-12 mb-2">
        <div class="col-12 shadow-sm p-3 mb-3 bg-body rounded-2">
          <?php

          session_start();

          require "connection.php";

          include "header.php";



          if (isset($_SESSION["u"])) {

          ?>
        </div>
        <div class="col-12">
          <div class="row">
            <div class="col-12 mb-2  shadow-sm  rounded-4 mt-1">
              <div class="row  bg-body ">
                <div class="col-12 mt-2">
                  <label class="form-label fs-1 fw-bold"><i class="bi bi-cart-plus-fill fs-1"></i>&nbsp;| Add Product</label>
                </div>
                <div class="col-7 col-lg-6">
                  <hr class="border border-5 bg-warning border-warning rounded-3">
                </div>
                <div class="row">
                  <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white">
                      <li class="breadcrumb-item"><a href="myProducts.php">My Product</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
            <div class="col-10 col-lg-10 offset-1 offset-lg-1 bg-white rounded-4 shadow  bg-body mt-3">
              <div class="row">
                <div class="col-12  mt-3">
                  <div class="row">

                    <div class="col-12 d-none mt-3" id="msgdiv-1">
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

                    <div class="col-12 p-2">
                      <div class="row">
                        <div class="col-6  ">

                          <div class="col-11 offset-1 shadow rounded-4 mt-3 mb-3">
                            <div class="row">
                              <div class="col-11 offset-0 mt-2 pb-2 ">
                                <label class="form-label fw-bold fs-5 ">&nbsp;Select&nbsp;Product&nbsp;Category</label>
                              </div>

                              <div class="col-10 offset-1  mt-3 mb-3">
                                <select class="form-select text-center border-start-0 border-end-0 border-top-0" id="category" onchange="brand_load();" >
                                  <option value="0">Select Category</option>

                                  <?php

                                  $catedory_rs = Database::search("SELECT * FROM `category`");
                                  $catedory_num = $catedory_rs->num_rows;

                                  for ($x = 0; $x < $catedory_num; $x++) {
                                    $catedory_data  = $catedory_rs->fetch_assoc();

                                  ?>
                                    <option value="<?php echo $catedory_data["id"]; ?>"><?php echo $catedory_data["name"]; ?></option>
                                  <?php


                                  }

                                  ?>

                                </select>
                              </div>

                            </div>
                          </div>
                          <div class="col-11  offset-1 shadow rounded-4 mt-3 mb-3">
                            <div class="row">
                              <div class="col-11 offset-0 mt-2 pb-2">
                                <label class="form-label fw-bold fs-5">&nbsp;Select Product Brand</label>
                              </div>

                              <div class="col-10 offset-1  mt-3 mb-3">
                                <select class="form-select text-center border-start-0 border-end-0 border-top-0" id="brand" onchange="load_model();">
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

                            </div>
                          </div>

                          <div class="col-11  offset-1 shadow rounded-4 mt-3 mb-3">
                            <div class="row">
                              <div class="col-11 offset-0 mt-2 pb-2">
                                <label class="form-label fw-bold fs-5">&nbsp;Select Product Model</label>
                              </div>

                              <div class="col-10 offset-1  mt-3 mb-3">
                                <select class="form-select text-center border-start-0 border-end-0 border-top-0" id="model" >
                                  <option value="0">Select Model</option>
                                  <?php

                                  $model_rs = Database::search("SELECT * FROM `model`");
                                  $model_num = $model_rs->num_rows;

                                  for ($s = 0; $s < $model_num; $s++) {
                                    $model_data = $model_rs->fetch_assoc();

                                  ?>
                                    <option value="<?php echo $model_data["id"]; ?>"><?php echo $model_data["name"]; ?></option>
                                  <?php


                                  }

                                  ?>
                                </select>
                              </div>

                            </div>
                          </div>
                        </div>

                        <div class="col-6 mt-5">

                          <div class="col-12 mt-5  shadow rounded-4  mb-3">
                            <div class="row">

                              <div class="col-12 mt-5">
                                <label class="form-label fw-bold fs-5">&nbsp;Add Title to your Product</label>
                              </div>

                              <div class="col-10 col-lg-10 offset-1 offset-lg-1 mb-4">
                                <input type="text" class="form-control border-start-0 border-end-0 border-top-0" placeholder="Title to your Product..." id="title">
                              </div>

                            </div>
                          </div>

                        </div>

                      </div>
                    </div>


                    <div class="col-12">
                      <div class="row g-1">

                        <div class="col-10 col-lg-3 offset-1 shadow rounded-4 mt-2 mb-3">
                          <div class="row">
                            <div class="col-12 mb-1 mt-3">
                              <label class="form-label fw-bold fs-5">&nbsp;Select Product Condition</label>
                            </div>

                            <!-- radio button -->
                            <div class="col-12 mb-3">
                              <div class="form-check form-check-inline mx-5">
                                <input class="form-check-input" type="radio" name="c" id="b" checked>
                                <label class="form-check-label" for="b">Brandnew</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="c" id="u">
                                <label class="form-check-label" for="u">Used</label>
                              </div>
                            </div>
                            <!-- radio button -->

                          </div>
                        </div>
                        <div class="col-10 col-lg-3 offset-1 shadow rounded-4 mt-2 mb-3">
                          <div class="row">
                            <div class="col-12 mt-3">
                              <label class="form-label fw-bold fs-5 ">&nbsp;Select Product Colour</label>
                            </div>

                            <div class="col-10 offset-1 mb-3">
                              <select class="form-select text-center border-start-0 border-end-0 border-top-0" id="color">
                                <option value="0">Select Colour</option>
                                <?php

                                $colour_rs = Database::search("SELECT * FROM `color`");
                                $colour_num = $colour_rs->num_rows;

                                for ($x = 0; $x < $colour_num; $x++) {
                                  $colour_data = $colour_rs->fetch_assoc();

                                ?>
                                  <option value="<?php echo $colour_data["id"]; ?>"><?php echo $colour_data["name"]; ?></option>
                                <?php

                                }


                                ?>
                              </select>
                            </div>
                            <div class="col-10 offset-1 ">
                              <div class="input-group mt-2 mb-2">
                                <input type="text" class="form-control border-start-0 border-end-0 border-top-0" placeholder="Add New Colour..." id="color_in">
                                <button class="btn btn-outline-warning border-start-0 border-end-0 border-top-0" type="button" id="button-addon2">+ Add</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-10 col-lg-3 offset-1 shadow rounded-4 mt-2 mb-3">
                          <div class="row">
                            <div class="col-12 mt-3">
                              <label class="form-label fw-bold fs-5">&nbsp;Select Product Quantity</label>
                            </div>

                            <div class="col-10 offset-1 mb-3">
                              <input type="number" class="form-control border-start-0 border-end-0 border-top-0" value="0" min="0" id="qty">
                            </div>

                          </div>
                        </div>

                      </div>
                    </div>



                    <div class="col-12">
                      <div class="row g-2">

                        <div class="col-lg-5 offset-lg-1 shadow rounded-4 mt-2 mb-3">
                          <div class="row g-2">
                            <div class="col-12 mt-3">
                              <label class="form-label fs-5 fw-bold">&nbsp;Cost Per Items</label>
                            </div>
                            <div class="offset-0 offset-lg-2 col-12 col-lg-8 mb-3">
                              <div class="input-group mb-2 mt-2">
                                <span class="input-group-text border-start-0 border-end-0 border-top-0 bg-white">Rs.</span>
                                <input type="text" class="form-control border-start-0 border-end-0 border-top-0" id="cost" placeholder="Add to Price............">
                                <span class="input-group-text border-start-0 border-end-0 border-top-0 bg-white">.00</span>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-12 col-lg-5 offset-lg-1 shadow rounded-4 mt-2 mb-3">
                          <div class="row">
                            <div class="col-12 mt-3">
                              <label class="form-label fw-bold fs-5">&nbsp;Approved Pyament Methods</label>
                            </div>
                            <div class="col-11">
                              <div class="row">
                                <div class="offset-0 offset-lg-2 col-2 "><img src="resocess/payment_method/mastercard_img.png" style="height:60px ;background-repeat: no-repeat;background-size: contain;"></div>
                                <div class="col-2 offset-1 offset-lg-0"><img src="resocess/payment_method/visa_img.png" style="height:60px ;background-repeat: no-repeat;background-size: contain;"></div>
                                <div class="col-2 offset-1 offset-lg-0"><img src="resocess/payment_method/american_express_img.png" style="height:60px ;background-repeat: no-repeat;background-size: contain;"></div>
                                <div class="col-2 offset-1 offset-lg-0"><img src="resocess/payment_method/paypal_img.png" style="height:60px ;background-repeat: no-repeat;background-size: contain;"></div>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>



                    <div class="col-12">
                      <div class="row g-1">

                        <div class="col-12 shadow rounded-4 mt-2 mb-3">
                          <div class="row g-1">

                            <div class="col-12 mt-3">
                              <label class="form-label fs-5 fw-bold">&nbsp;Delivery Cost</label>
                            </div>
                            <div class="col-6 col-lg-6 border-end border-info mb-1">
                              <div class="row">
                                <div class="col-12 offset-lg-1 col-lg-4">
                                  <label class="form-label fs-6">&nbsp;Delivery cost within Colombo</label>
                                </div>
                                <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                  <div class="input-group mb-2 mt-2">
                                    <span class="input-group-text border-start-0 border-end-0 border-top-0 bg-white">Rs.</span>
                                    <input type="text" class="form-control border-start-0 border-end-0 border-top-0" id="dcwc" placeholder="Add to price within Colombo...">
                                    <span class="input-group-text border-start-0 border-end-0 border-top-0 bg-white">.00</span>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-6 col-lg-6 ">
                              <div class="row">
                                <div class="col-12 offset-lg-1 col-lg-4">
                                  <label class="form-label fs-6">&nbsp;Delivery cost out of Colombo</label>
                                </div>
                                <div class="offset-0 offset-lg-2 col-12 col-lg-8 mb-3">
                                  <div class="input-group mb-2 mt-2">
                                    <span class="input-group-text border-start-0 border-end-0 border-top-0 bg-white">Rs.</span>
                                    <input type="text" class="form-control border-start-0 border-end-0 border-top-0" id="dcoc" placeholder="Add to Price Out of Colombo...">
                                    <span class="input-group-text border-start-0 border-end-0 border-top-0 bg-white">.00</span>
                                  </div>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>




                        <div class="col-12 shadow rounded-4 mt-2 mb-3">
                          <div class="row">
                            <div class="col-12 mt-3">
                              <label class="form-label fs-5 fw-bold">&nbsp;Product Description</label>
                            </div>
                            <div class="col-12">
                              <textarea id="text" cols="30" rows="15" class="form-control border-start-0 border-end-0 border-top-0" placeholder="Please Type Product Description.........."></textarea>
                            </div>
                          </div>
                        </div>



                        <div class="col-12 shadow rounded-4 mt-2 mb-3">
                          <div class="row">
                            <div class="col-12 mt-3">
                              <label class="form-label fw-bold fs-5">&nbsp;Add Product Images</label>
                            </div>
                            <div class="offset-lg-3 col-12 col-lg-6">
                              <div class="row g-2">
                                <div class="col-4 border border-ligh ">
                                  <img src="resocess/addproductimg.svg" class="img-fluid" style="height:200px  ;" id="i0">
                                </div>
                                <div class="col-4 border border-ligh ">
                                  <img src="resocess/addproductimg.svg" class="img-fluid" style="height:200px ;" id="i1">
                                </div>
                                <div class="col-4 border border-ligh ">
                                  <img src="resocess/addproductimg.svg" class="img-fluid" style="height:200px ;" id="i2">
                                </div>
                              </div>
                            </div>
                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                              <input type="file" class="d-none" id="imageUploader" multiple>
                              <label for="imageUploader" class="col-12 btn btn-warning" onclick="changeProductImage();">Upload Images</label>
                            </div>
                          </div>
                        </div>



                        <div class="col-12 shadow rounded-4 mt-2 mb-3">
                          <div class="row">
                            <div class="col-12 ">
                              <div class="row rounded-3 border-5 border-start border-info g-2" style="background-color:  #f9ebea ;">
                                <label class="form-label fw-bold fs-4 ">Notice......</label><br>
                                <label class="form-label fs-5"> We are taking 5% of the product from price from every
                                  product as a service charge.</label>
                              </div>
                            </div>

                          </div>
                        </div>

                        <div class="col-12 shadow rounded-4 mt-2 mb-3">
                          <div class="row g-1">
                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                              <button class="btn btn-primary" onclick="addProduct();">Save Product</button>
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
      </div>
      <?php require "fooler.php"; ?>
    </div>
  </div>
  <script src="bootstrap.bundle.js"></script>
  <script src="script.js"></script>
</body>

</html>