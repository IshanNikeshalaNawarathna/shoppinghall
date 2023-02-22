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
  <title>Add Product | Shopping Hall</title>
  <link rel="icon" href="resocess/webLogo/logo.jpg">
</head>

<body style="overflow-x: hidden;">

  <div class="container-fluid">
    <div class="row gy-3 ">
      <div class="col-12 mb-2">

        <div class="col-12 shadow-sm p-3 mb-3 bg-body rounded-2">
          <?php include "header.php";

          if (isset($_SESSION["u"])) {

            if (isset($_SESSION["p"])) {

              $product = $_SESSION["p"];

          ?>
        </div>

        <div class="col-12">
          <div class="row">
            <div class="col-12 mb-2  shadow-sm  rounded-4 mt-1">
              <div class="row  bg-body ">
                <div class="col-12 mt-2">
                  <label class="form-label fs-1 fw-bold"><i class="bi bi-cart-plus-fill fs-1"></i>&nbsp;| Update Product</label>
                </div>
                <div class="col-7 col-lg-6">
                  <hr class="border border-5 bg-warning border-warning rounded-3">
                </div>
              </div>
              <div class="row">
                <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                  <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item"><a href="myProducts.php">My Product</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Product</li>
                  </ol>
                </nav>
              </div>
            </div>
            <div class="col-10 col-lg-10 offset-1 offset-lg-1 bg-white rounded-4 shadow mt-2">
              <div class="row">
                <div class="col-12 rounded-4">
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

                    <div class="col-12 mt-4">
                      <div class="row">
                        <div class="col-6">

                          <div class="col-11 offset-1 shadow rounded-4 mt-3 mb-3">
                            <div class="row ">
                              <div class="col-12 mt-3">
                                <label class="form-label fw-bold fs-5">&nbsp;Select Product Category</label>
                              </div>

                              <div class="col-10 offset-1 mt-4 mb-3">
                                <select class="form-select text-center border-end-0 border-start-0 border-top-0 " readonly>
                                  <?php
                 


                                  $catedory_rs = Database::search("SELECT * FROM `category` WHERE `id`='" . $product["category_id"] . "'");
                                  $catedory_data  = $catedory_rs->fetch_assoc();

                                  ?>
                                  <option><?php echo $catedory_data["name"]; ?></option>
                                </select>
                              </div>

                            </div>
                          </div>
                          <div class="col-11 offset-1 shadow rounded-4 mt-3 mb-3 ">
                            <div class="row">
                              <div class="col-12 mt-3">
                                <label class="form-label fw-bold fs-5">&nbsp;Select Product Brand</label>
                              </div>

                              <div class="col-10 offset-1  mt-4 mb-3">
                                <select class="form-select text-center border-end-0 border-start-0 border-top-0 " readonly>

                                  <?php

                                  $brand_rs = Database::search("SELECT * FROM `brand` WHERE `id` IN (SELECT `brand_id` FROM `brand_has_model`
                                WHERE `id`='" . $product["brand_has_model_id"] . "')");
                                  $brand_data = $brand_rs->fetch_assoc();



                                  ?>
                                  <option><?php echo $brand_data["name"]; ?></option>
                                </select>
                              </div>

                            </div>
                          </div>

                          <div class="col-11 offset-1 shadow rounded-4 mt-3 mb-3">
                            <div class="row">
                              <div class="col-12 mt-3 ">
                                <label class="form-label fw-bold fs-5">&nbsp;Select Product Model</label>
                              </div>

                              <div class="col-10 offset-1  mt-4 mb-3">
                                <select class="form-select text-center border-end-0 border-start-0 border-top-0" readonly>

                                  <?php

                                  $model_rs = Database::search("SELECT * FROM `model` WHERE `id` IN (SELECT `model_id` FROM `brand_has_model` WHERE
                                `id` = '" . $product["brand_has_model_id"] . "')");
                                  $model_data = $model_rs->fetch_assoc();

                                  ?>
                                  <option><?php echo $model_data["name"]; ?></option>
                                </select>
                              </div>

                            </div>
                          </div>



                        </div>

                        <div class="col-6 mt-5">

                          <div class="col-12  shadow rounded-4 mt-5 mb-3">
                            <div class="row">

                              <div class="col-12 mt-5">
                                <label class="form-label fw-bold fs-5">&nbsp;Add a Title to your Product</label>
                              </div>

                              <div class="col-10 col-lg-10 offset-1 offset-lg-1 mb-3">
                                <input type="text" class="form-control border-end-0 border-start-0 border-top-0" value="<?php echo $product["title"]; ?>" placeholder="Title to your Product..." id="title">
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
                            <div class="col-12 mt-3">
                              <label class="form-label fw-bold fs-5">&nbsp;Select Product Condition</label>
                            </div>
                            <?php
                            if ($product["condition_id"] == 1) {
                            ?>
                              <!-- radio button -->
                              <div class="col-12">
                                <div class="form-check form-check-inline mx-5 mb-3">
                                  <input class="form-check-input" type="radio" name="c" id="b" checked readonly>
                                  <label class="form-check-label" for="b">Brandnew</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="c" id="u" readonly>
                                  <label class="form-check-label" for="u">Used</label>
                                </div>
                              </div>
                              <!-- radio button -->
                            <?php
                            } else {
                            ?>
                              <!-- radio button -->
                              <div class="col-12">
                                <div class="form-check form-check-inline mx-5 mb-3">
                                  <input class="form-check-input" type="radio" name="c" id="b" checked readonly>
                                  <label class="form-check-label" for="b">Brandnew</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="c" id="u" readonly>
                                  <label class="form-check-label" for="u">Used</label>
                                </div>
                              </div>
                              <!-- radio button -->
                            <?php
                            }
                            ?>


                          </div>
                        </div>
                        <div class="col-10 col-lg-3 offset-1 shadow rounded-4 mt-2 mb-3">
                          <div class="row">
                            <div class="col-12 mt-3">
                              <label class="form-label fw-bold fs-5">&nbsp;Select Product Colour</label>
                            </div>

                            <div class="col-10 offset-1">
                              <select class="form-select text-center border-start-0 border-end-0 border-top-0" id="color" readonly>

                                <?php

                                $colour_rs = Database::search("SELECT * FROM `color` WHERE `id` ='" . $product["color_id"] . "'");
                                $colour_data = $colour_rs->fetch_assoc();

                                ?>
                                <option><?php echo $colour_data["name"]; ?></option>

                              </select>
                            </div>
                            <div class="col-10 offset-1 mb-3">
                              <div class="input-group mt-2 mb-2">
                                <input type="text" class="form-control border-start-0 border-end-0 border-top-0" placeholder="Add New Colour..." id="color_in" readonly>
                                <button class="btn btn-outline-warning border-start-0 border-end-0 border-top-0" type="button" id="button-addon2" readonly>+ Add</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-10 col-lg-3 offset-1 shadow rounded-4 mt-2 mb-3 ">
                          <div class="row">
                            <div class="col-12 mt-3">
                              <label class="form-label fw-bold fs-5">&nbsp;Select Product Quantity</label>
                            </div>

                            <div class="col-10 offset-1 mb-3">
                              <input type="number" class="form-control border-start-0 border-end-0 border-top-0" value="<?php echo $product["qty"]; ?>" min="0" id="qty">
                            </div>

                          </div>
                        </div>

                      </div>
                    </div>



                    <div class="col-12">
                      <div class="row g-1">

                        <div class="col-lg-5 offset-lg-1 shadow rounded-4 mt-2 mb-3">
                          <div class="row">
                            <div class="col-12 mt-3">
                              <label class="form-label fs-5 fw-bold">&nbsp;Cost Per Items</label>
                            </div>
                            <div class="offset-1 offset-lg-2 col-10 col-lg-8 mb-3">
                              <div class="input-group mb-2 mt-2">
                                <span class="input-group-text border-start-0 border-end-0 border-top-0 bg-white">Rs.</span>
                                <input type="text" class="form-control border-start-0 border-end-0 border-top-0 bg-white" readonly value="<?php echo $product["price"]; ?>">
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
                            <div class="col-11 mb-3">
                              <div class="row  ">
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



                    <div class="col-12 ">
                      <div class="row g-1">

                        <div class="col-12 shadow rounded-4 mt-2 mb-3">
                          <div class="row ">

                            <div class="col-12 mt-3">
                              <label class="form-label fs-5 fw-bold">&nbsp;Delivery Cost</label>
                            </div>
                            <div class="col-6 col-lg-6 border-end border-info mb-2">
                              <div class="row">
                                <div class="col-12 offset-lg-1 col-lg-4">
                                  <label class="form-label fs-6">Delivery cost within Colombo</label>
                                </div>
                                <div class="offset-0 offset-lg-2 col-12 col-lg-8 mb-3">
                                  <div class="input-group mb-2 mt-2">
                                    <span class="input-group-text border-start-0 border-end-0 border-top-0 bg-white">Rs.</span>
                                    <input type="text" class="form-control border-start-0 border-end-0 border-top-0 bg-white" id="dcwc" value="<?php echo $product["delivery_free_colombo"]; ?>">
                                    <span class="input-group-text border-start-0 border-end-0 border-top-0 bg-white">.00</span>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-6 col-lg-6 ">
                              <div class="row">
                                <div class="col-12 offset-lg-1 col-lg-4">
                                  <label class="form-label fs-6">Delivery cost out of Colombo</label>
                                </div>
                                <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                  <div class="input-group mb-2 mt-2">
                                    <span class="input-group-text border-start-0 border-end-0 border-top-0 bg-white">Rs.</span>
                                    <input type="text" class="form-control border-start-0 border-end-0 border-top-0 bg-white" id="dcoc" value="<?php echo $product["delivery_free_other"]; ?>">
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
                            <div class="col-12 mb-3">
                              <textarea cols="30" rows="15" class="form-control border-start-0 border-end-0 border-top-0" id="ds"><?php echo $product["description"]; ?></textarea>
                            </div>
                          </div>
                        </div>




                        <div class="col-12 shadow rounded-4 mt-2 mb-3">
                          <div class="row">
                            <div class="col-12 mt-3">
                              <label class="form-label fw-bold fs-5">&nbsp;Add Product Images</label>
                            </div>
                            <div class="offset-lg-3 col-12 col-lg-6">

                              <?php
                              $img = array();


                              $img[0] = "resocess/addproductimg.svg";
                              $img[1] = "resocess/addproductimg.svg";
                              $img[2] = "resocess/addproductimg.svg";

                              $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product["id"] . "'");
                              $product_img_num = $product_img_rs->num_rows;

                              for ($x = 0; $x < $product_img_num; $x++) {
                                $product_img_data = $product_img_rs->fetch_assoc();

                                $img[$x] = $product_img_data["code"];
                              }

                              ?>
                              <div class="row g-2">
                                <div class="col-4 border border-ligh text-center">
                                  <img src="<?php echo $img[0]; ?>" class="img-fluid" style="height:160px  ;" id="i0">
                                </div>
                                <div class="col-4 border border-ligh text-center">
                                  <img src="<?php echo $img[1]; ?>" class="img-fluid" style="height:160px ;" id="i1">
                                </div>
                                <div class="col-4 border border-ligh text-center">
                                  <img src="<?php echo $img[2]; ?>" class="img-fluid" style="height:160px ;" id="i2">
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
                          <div class="row rounded-3 border-5 border-start border-info g-2" style="background-color:  #f9ebea ;">
                            <label class="form-label fw-bold fs-4 ">Notice......</label><br>
                            <label class="form-label fs-5"> We are taking 5% of the product from price from every
                              product as a service charge.</label>
                          </div>
                        </div>

                        <div class="col-12 shadow rounded-4 mt-2 mb-3">
                          <div class="row g-1">

                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                              <button class="btn btn-primary" onclick="updateProduct();">Update Product</button>
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
            }
          } else {
            // header("Location:http://localhost/shopping%20hall/home.php");
      ?>
      <script>
        window.location = "home.php";
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