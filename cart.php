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
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" href="resocess/webLogo/logo.jpg">
  <title>Shopping Hall | Cart</title>
</head>

<body class="bg-white " style="overflow-x: hidden;">

  <div class="container-fluid">
    <div class="row">

      <div class="col-12 shadow-sm p-3 mb-3 bg-body rounded-2">
        <?php include "header.php";


        if (isset($_SESSION["u"])) {

          $email = $_SESSION["u"]["email"];

          $total = 0;
          $subtotal = 0;
          $shipping = 0;

        ?>

      </div>

      <div class="col-12 col-lg-12 mt-1 bg-white mb-4 shadow-sm  rounded-4">
        <div class="row ">

          <div class=" col-9 col-lg-5 offset-lg-2 offset-0  mb-3 mt-4 ">
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
        <div class="row g-5">

          <div class="col-12 mb-2  shadow-sm  rounded-4 mt-3">
            <div class="row  bg-body ">
              <div class="col-12 mt-2">
                <label class="form-label fs-1 fw-bold"><i class="bi bi-cart-plus-fill fs-1"></i>&nbsp;| Shopping Cart</label>
              </div>
              <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                  <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
              </nav>
              <div class="col-7 col-lg-6">
                <hr class="border border-5 bg-warning border-warning rounded-3">
              </div>
            </div>
          </div>

          <?php
          $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $email . "'");
          $cart_num = $cart_rs->num_rows;

          if ($cart_num == 0) {

          ?>
            <!-- empty view -->
            <div class="col-12 mt-3 shadow-sm  bg-body rounded-4 mb-3 ">
              <div class="row">
                <div class="col-12 text-center carticon mt-5"></div>
                <div class="col-12 text-center mt-3">
                  <label class="form-label fs-3 fw-bold">
                    You don't have any items in your cart.
                  </label>
                  <div class=" col-4 col-lg-2 offset-4 offset-lg-5 d-grid mb-3 p-2">
                    <a href="home.php" class="btn btn-secondary">Start Shopping</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- empty view -->
          <?php

          } else {
          ?>

            <!-- card -->

            <div class="col-12 col-lg-8 ">
              <div class="row g-1 ">

                <?php

                for ($x = 0; $x < $cart_num; $x++) {

                  $cart_data = $cart_rs->fetch_assoc();

                  $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
                  $product_data = $product_rs->fetch_assoc();

                  $total = $total + ($product_data["price"] * $cart_data["qty"]);

                  $address_rs = Database::search("SELECT district_id AS did FROM `user_has_address` INNER JOIN `city` ON user_has_address.city_id=city_id
          INNER JOIN `district` ON city.district_id=district.id WHERE `user_email`='" . $email . "'");

                  $address_data = $address_rs->fetch_assoc();

                  $sip = 0;

                  if ($address_data["did"] == 1) {

                    $sip = $product_data["delivery_free_colombo"];
                    $shipping = $shipping + $sip;
                  } else {

                    $sip = $product_data["delivery_free_other"];
                    $shipping = $shipping + $sip;
                  }

                  $color_rs = Database::search("SELECT * FROM `color` WHERE `id`='" . $product_data["color_id"] . "'");
                  $color_data = $color_rs->fetch_assoc();

                  $condition_rs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $product_data["condition_id"] . "'");
                  $condition_data = $condition_rs->fetch_assoc();

                ?>



                  <div class="card  mt-1 mb-3 bg-white rounded-4 shadow p-3  bg-body">
                    <div class="row g-0">
                      <div class="col-md-3">

                        <div class="col-12 mt-3 mt-4 mb-3 bg-white rounded-4 shadow p-3 mb-5 bg-body" style="margin-left:2px ;">
                          <div class="row">

                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                              <div class="carousel-inner">

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

                                <div class="carousel-item active">
                                  <img src="<?php echo $img[0]; ?>" class="d-block w-75 img-fluid" alt="...">
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


                      </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <div class="col-md-5 mt-4 mb-3 bg-white rounded-4 shadow p-3 mb-5 bg-body" style="margin-left:0px ;">
                        <div class="col-1 col-lg-1 mb-1">
                          <span class="badge bg-danger text-start">New</span>
                        </div>
                        <div class="card-body">
                          <h5 class="card-title text-black fs-2 "><?php echo $product_data["title"]; ?> pro &nbsp;</h5>
                          <span class="card-text text-black fs-5">Rs. <b class="fs-5" style="color:#2471a3;"><?php echo $product_data["price"]; ?>.00</b></span><br>
                          <span class="card-text fs-5"><b class="text-danger fs-5"><?php echo $cart_data["qty"]; ?></b>&nbsp;Items Available</span><br>
                          <span class="card-text fs-5">Colour : <?php echo $color_data["name"]; ?></span><br>
                          <span class="card-text fs-5">Condition : <?php echo $condition_data["name"]; ?></span><br><br>&nbsp;&nbsp;&nbsp;&nbsp;
                          <span class="card-text fs-5">Delivery Fee :</span>
                          <span class="card-text fs-5">Rs. <b class="text-info fs-5"><?php echo $sip; ?></b> .00</span>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class=" card-body d-grid rounded-5">
                          <a class="btn btn-outline-danger mb-3 shadow " onclick="deleteFromCart(<?php echo $cart_data['id']; ?>);">Remove</a>
                        </div>
                      </div>
                      <div class="col-6 col-lg-8">
                        <hr class="border border-3 border-secondary bg-secondary rounded-4">
                      </div>

                      <div class="col-md-12 mt-2 mb-3">
                        <div class="row">
                          <div class="col-6 col-md-6">
                            <span class="fw-bold fs-5 text-black">Requested Total&nbsp;<i class="bi bi-info-circle fw-bold fs-5"></i></span>
                          </div>
                          <div class="col-6 col-lg-6 text-end">
                            <span class="text-black fs-5 fw-bold">Rs. <b class="text-danger fs-5"><?php echo ($product_data["price"] * $cart_data["qty"]) + $sip; ?></b>.00</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 col-lg-12 text-end">
                        <a href='<?php echo "singleProductView.php?id=" . $product_data["id"]; ?>' class="fs-5 text-decoration-none">View Product <b class="fs-3 fw-normal">&raquo;</b></a>
                      </div>
                    </div>
                  </div>

                  <!-- card -->
                <?php

                }


                ?>

              </div>
            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



            <div class="col-12 col-lg-3 ">
              <div class="row g-2">

                <div class="card  shadow p-3 mb-5 bg-white  rounded-4 col">
                  <div class="row g-0 ">

                    <div class="col-md-12">
                      <div class="card-body">
                        <h5 class="card-title fs-3 fw-bold ">Summary</h5>
                      </div>
                      <div class="col-12 col-lg-12">
                        <hr class="border border-1 border-danger">
                      </div>
                      <div class="col-12">
                        <div class="row">

                          <div class="col-6 mb-3">
                            <span class="fs-4 text-dark">Items(<?php echo $cart_num; ?>)</span>
                          </div>
                          <div class="col-6 text-end mb-3 mt-2">
                            <span class="fs-6 fw-bold">Rs.<?php echo $total; ?>.00</span>
                          </div>

                        </div>
                      </div>
                      <div class="col-12">
                        <div class="row">

                          <div class="col-6 mb-3">
                            <span class="fs-4 text-dark">Shipping</span>
                          </div>
                          <div class="col-6 text-end mb-3 mt-2">
                            <span class="fs-6 fw-bold">Rs.<?php echo $shipping; ?>.00</span>
                          </div>

                        </div>
                      </div>

                      <div class="col-12 col-lg-12">
                        <hr class="border border-1 border-danger">
                      </div>

                      <div class="col-12">
                        <div class="row">

                          <div class="col-6 mb-3 mt-2">
                            <span class="fs-4 text-dark fw-bold">Total</span>
                          </div>
                          <div class="col-6 text-end mb-3 mt-2">
                            <span class="fs-6 fw-bold fs-4">Rs. <b class="text-danger fs-3"><?php echo ($shipping + $total); ?>.00</b> </span>
                          </div>

                        </div>
                      </div>

                      <div class="col-8 col-lg-12 offset-2 offset-lg-0 mt-3 mb-3 d-grid mt">
                        <button class="btn btn-warning rounded-4 shadow fw-bold text-white " type="submit" onclick="payNow();">CHECKOUT</button>
                      </div>


                      <!-- payment model -->
                      <div class="modal fade" id="buyNow" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header" style="background-color:#f8f9f9;">
                              <h1 class="modal-title fs-4  fw-bold " id="exampleModalToggleLabel">Payment Method</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="clos"></button>
                            </div>
                            <div class="modal-body ">

                              <div class="col-12">
                                <div class="row">
                                  <div id="card_container"></div>
                                </div>
                              </div>

                            </div>
                            <div class="modal-footer" style="background-color:#f8f9f9;">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btnClos">Close</button>
                              <!-- <button type="button" class="btn btn-primary" onclick="verifiNewCategory();">Save New Category</button> -->
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- payment model -->


                    </div>
                  </div>
                </div>




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
        window.location = "index.php";
      </script>
    <?php

        }

    ?>

    <?php
    
    
    $mobile_rs = Database::search("SELECT SUBSTRING(`mobile`,2,10) FROM `user` WHERE `email`='" . $_SESSION["u"]["email"] . "'");
    $mobile_data = $mobile_rs->fetch_assoc();


    include "fooler.php"; ?>

    </div>
  </div>
  <script src="script.js"></script>
  <script src="bootstrap.bundle.js"></script>
  <!-- <script src="bootstrap.js"></script> -->

  <script src="https://cdn.directpay.lk/dev/v1/directpayCardPayment.js?v=1"></script>

  <script>
    DirectPayCardPayment.init({
      container: 'card_container', //<div id="card_container"></div>
      merchantId: 'ES15243', //your merchant_id
      amount: "<?php echo ($shipping + $total); ?>.00",
      refCode: "DP12345", //unique referance code form merchant
      currency: 'LKR',
      type: 'ONE_TIME_PAYMENT',
      customerEmail: '<?php echo $_SESSION["u"]["email"]; ?>',
      customerMobile: '+94<?php echo implode(" ", $mobile_data); ?>',
      description: ' CHECKOUT', //product or service description
      debug: true,
      responseCallback: responseCallback,
      errorCallback: errorCallback,
      logo: 'https://test.com/directpay_logo.png',
      apiKey: '7509d3045cae3f15e690949762d5085a7633069c157b54e1aaeedd1f88d3aed1'
    });

    //response callback.
    function responseCallback(result) {
      console.log("successCallback-Client", result);
      // alert(JSON.stringify(result));

     document.getElementById("clos").classList.add("d-none");
     document.getElementById("btnClos").classList.add("d-none");

   
      var request = new XMLHttpRequest();
      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          var text = request.responseText;
          // alert(text);
          var obj = JSON.parse(text);
          if (obj["status"] == 1) {
            var x = setTimeout(function(){
              window.location = "invoice.php?id=" + obj["id"];
            }, 4000);
         
          } else {
            alert(text);
          }
        }
      };
      request.open("GET", "checkoutProcess.php", true);
      request.send();

    }

    //error callback
    function errorCallback(result) {
      console.log("successCallback-Client", result);
      alert(JSON.stringify(result));
    }
  </script>
</body>

</html>