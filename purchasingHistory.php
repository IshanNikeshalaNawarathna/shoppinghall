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
      <link rel="stylesheet" href="style.css" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
      <link rel="icon" href="resocess/webLogo/logo.jpg">
      <title>Shopping Hall | Purchasing History</title>
</head>

<body class="bg-white" style="overflow-x: hidden;">

      <div class="container-fluid ">
            <div class="row ">



                  <div class="col-12 shadow-sm mb-3 mt-3 ">
                        <div class="row">

                              <?php



                              include "header.php";

                              if (isset($_SESSION)) {
                                    $user_email = $_SESSION["u"]["email"];
                                    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $user_email . "' AND `type`='1'");
                                    $invoice_num = $invoice_rs->num_rows;


                              ?>
                        </div>
                  </div>


                  <div class="col-12 mt-2 mb-1 bg-white shadow-sm  rounded-4">
                        <div class="row">
                              <div class="col-12  mt-1 ">
                                    <span class="fs-2  fw-bold"><b class="mt-5">&nbsp;<i class="bi bi-card-list fs-1"></i></b>&nbsp;|Purchasing History</span>
                              </div>
                              <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-white">
                                          <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                          <li class="breadcrumb-item active" aria-current="page">Purchasing History</li>
                                    </ol>
                              </nav>

                              <div class="col-6 col-lg-7">
                                    <hr class="border border-4 border-warning rounded-4">
                              </div>
                        </div>
                  </div>


                  <?php

                                    if ($invoice_num == 0) {
                  ?>

                        <div class="col-12 d-flex mt-3 mb-2 justify-content-center align-items-center mb-3 bg-white rounded-4 shadow  bg-body" style="height:400px;">
                              <span class="fs-1 text-black-50 d-block">You Have Not Purchased Any Product Yet...</span>
                        </div>

                  <?php

                                    } else {

                  ?>

                        <?php

                                          for ($q = 0; $q < $invoice_num; $q++) {
                                                $invoice_data = $invoice_rs->fetch_assoc();

                                                if($invoice_data["type"] == 1){

                                                $images_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $invoice_data["product_id"] . "'");
                                                $images_data = $images_rs->fetch_assoc();

                        ?>



                              <!-- product -->
                              <div class="col-12 col-lg-6 offset-0  mb-3 bg-white rounded-4 shadow bg-body ">
                                    <div class="row ">

                                          <div class=" col-12 col-lg-10  mt-3 mb-0 ">
                                                <div class="row ">

                                                      <!-- card -->
                                                      <div class="card mb-3 col-10 offset-1 col-lg-10 offset-lg-1 offset-0 mt-3 ">
                                                            <div class="row ">

                                                                  <div class="col-md-4 text-center mt-3 mb-3">
                                                                        <img src="<?php echo $images_data["code"]; ?>" class="img-fluid rounded-start " style="height: 250px;width:auto ;">
                                                                  </div>
                                                                  <div class="col-md-8">
                                                                        <div class="card-body">
                                                                              <?php

                                                                              $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                                                                              $product_data = $product_rs->fetch_assoc();

                                                                              $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $invoice_data["user_email"] . "'");
                                                                              $seller_data = $seller_rs->fetch_assoc();



                                                                              ?>
                                                                              <h3 class="card-title mt-2"><?php echo $product_data["title"]; ?></h3>
                                                                              <span class="card-text fs-5 ">Order ID : <b class="text-decoration-underline text-black-50"><?php echo $invoice_data["order_id"] ?></b></span><br>
                                                                              <span class="card-text fs-5">Quantity : 0<b class="text-dark fs-5 fw-bold"><?php echo $invoice_data["qty"]; ?></b> </span><br>
                                                                              <span class="fs-5 card-text " style="color: #3498db ;margin-left:30px ;">Price : Rs. <b class="text-dark fs-5 fw-bold"><?php echo $product_data["price"]; ?></b>.00</span><br>
                                                                              <span class="card-text fs-4 fw-bold">AMOUNT : Rs. <b class="fs-4 fw-bold text-primary"> <?php echo $invoice_data["total"]; ?></b>/=</span><br>
                                                                              <span class="card-text fs-5">Purchased Date & Time : <?php echo $invoice_data["date"]; ?></span><br>
                                                                              <span class="card-text fs-5">Seller : <?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></span>
                                                                        </div>

                                                                  </div>
                                                                  <div class="row">

                                                                        <div class="col-5 col-lg-4 mb-2 mt-3 mt-lg-0">
                                                                              <a href="<?php echo "invoice.php?id=" . $invoice_data["order_id"]; ?>" class="fs-5 text-decoration-none" style="margin-top: 40px;">Seen Invoice&nbsp;&raquo;</a>
                                                                        </div>

                                                                        <div class="col-4 col-lg-4 mb-2 mt-0 d-grid ">
                                                                              <button class="btn btn-warning" onclick="addFeedback(<?php echo $invoice_data['product_id']; ?>);"><i class="bi bi-info-circle-fill"></i>&nbsp;Feedback</button>

                                                                        </div>
                                                                        <div class="col-2 col-lg-4 d-grid mt-0 mb-2">
                                                                              <button class="btn btn-danger" onclick="productDelete(<?php echo $invoice_data['id']; ?>);"><i class="bi bi-trash-fill"></i>&nbsp;Delete</button>
                                                                        </div>

                                                                  </div>

                                                            </div>
                                                      </div>

                                                      <!-- card -->

<?php
}
?>


                                                </div>
                                          </div>


                                    </div>
                              </div>


                              <!-- product -->







                        <?php
                                          }

                        ?>

                        <div class="col-12 col-lg-2 offset-lg-10 d-grid">

                              <button class=" btn btn-danger" onclick="deletePurchasingHistory()"><i class="bi bi-trash-fill"></i>&nbsp;Delete History</button>

                        </div>

                  <?php

                                    }

                  ?>




            <?php

                              }

                              include "fooler.php"; ?>




            </div>
      </div>

      <script src="bootstrap.bundle.js"></script>
      <script src="script.js"></script>


</body>

</html>