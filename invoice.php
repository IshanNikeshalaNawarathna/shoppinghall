<?php

session_start();
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
     <title>Shopping Hall | Invoice</title>
</head>

<body>

     <div class="container-fluid">
          <div class="row">

               <div class="col-12 shadow-sm mb-3 mt-3">
                    <div class="row">
                         <?php

                         require "connection.php";

                         include "header.php";

                         if (isset($_SESSION["u"])) {
                              $mail = $_SESSION["u"]["email"];
                              $order_id = $_GET["id"];

                         ?>
                    </div>
               </div>


               <!-- hader -->
               <div class="col-12" id="page">
                    <div class="row g-2">

                         <div class="col-12 shadow mb-2 mt-3 rounded-4">
                              <div class="row">
                                   <div class="col-7 offset-lg-2 offset-2">
                                        <div class="ms-5 logo "></div>
                                   </div>
                              </div>
                         </div>


                         <div class="col-12  text-start shadow  mt-2 rounded-4">
                              <div class="row g-1">
                                   <span class="col-12 text-warning text-decoration-underline text-start fs-2 mt-3 ">&nbsp;Shopping Hall</span>
                                   <div class="col-12 text-start mt1 mb-3 ">
                                        <div class="row ">
                                             <span class="fs-6 text-dark">&nbsp;&nbsp;Colombo,Colombo 10 Sri Lanka</span><br>
                                             <span class="fs-6 text-dark">&nbsp;&nbsp;+999 999 999</span><br>
                                             <span class="fs-6 text-dark">&nbsp;&nbsp;shoppinghall@gmail.com</span><br>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <!-- invoice seller deteils -->

                         <div class="col-12 shadow mt-2 mb-3 rounded-4">
                              <div class="row g-2">
                                   <div class="col-12 mb-3 mt-4 p-2">
                                        <div class="row g-1">

                                             <div class="col-6">
                                                  <h1 class=" text-danger fw-bold">INVOICE TO</h1>
                                                  <?php

                                                  $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $mail . "'");
                                                  $address_data = $address_rs->fetch_assoc();

                                                  $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $mail . "'");
                                                  $user_data = $user_rs->fetch_assoc();

                                                  ?>

                                                  <span class="fs-5 text-black-50"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></span><br>
                                                  <span class="fs-5 text-black-50"><?php echo $address_data["line1"] . " " . $address_data["line2"]; ?></span><br>
                                                  <span class="fs-5 text-black-50"><?php echo $mail; ?></span><br>
                                             </div>
                                             <?php

                                             $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $order_id . "'");
                                             $invoice_data = $invoice_rs->fetch_assoc();

                                             ?>
                                             <div class=" col-6 text-end">
                                                  <h1 class="text-black">INVOICE <b class="text-primary fs-1">0<?php echo $invoice_data["id"]; ?></b></h1>
                                                  <span class="text-black fs-5">Date & Time of Invoice :</span><br>
                                                  <span class="text-black fs-5"><?php echo $invoice_data["date"]; ?></span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="col-12 shadow rounded-4 mt-3 mb-3">
                              <div class="row">
                                   <!-- table -->
                                   <div class="col-12 offset-0 offset-lg-0 col-lg-12 mt-4">
                                        <table class="table">

                                             <thead>
                                                  <tr>

                                                       <th class="fs-6">#</th>
                                                       <th class="fs-6 ">Order ID & Product</th>
                                                       <th class="fs-6 text-end">Unit Price</th>
                                                       <th class="fs-6 text-end">Quantity</th>
                                                       <th class="fs-6 text-end">Price</th>

                                                  </tr>
                                             </thead>
                                             <tbody>

                                                  <?php

                                                  $inovi_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $order_id . "'");
                                                  $inovi_num  = $inovi_rs->num_rows;

                                                  for ($x = 0; $x < $inovi_num; $x++) {
                                                       $inovi_data = $inovi_rs->fetch_assoc();



                                                  ?>

                                                       <tr style="height: 70px;">
                                                            <td class="fs-6">0<?php echo $inovi_data["id"]; ?></td>
                                                            <td>
                                                                 <?php

                                                                 $product_rs = Database::search("SELECT * FROM `product` WHERE `id` ='" . $inovi_data["product_id"] . "'");
                                                                 $product_data = $product_rs->fetch_assoc();

                                                                 ?>
                                                                 <span class="fs-6 text-black"><?php echo $product_data["title"]; ?></span><br>
                                                                 <span class="fw-bold fs-6 text-primary text-decoration-underline p-2"><?php echo $order_id; ?></span>
                                                            </td>
                                                            <td class="fs-6 text-end pt-4">Rs.<?php echo $product_data["price"]; ?>.00</td>
                                                            <td class="text-end pt-4 fs-6"><?php echo $inovi_data["qty"]; ?></td>
                                                            <td class="text-end fs-5 text-danger pt-4">Rs.<?php echo $inovi_data["total"]; ?>.00</td>
                                                       </tr>
                                                  <?php

                                                  }
                                                  ?>
                                             </tbody>
                                             <tfoot>

                                                  <?php

                                                  $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $address_data["city_id"] . "'");
                                                  $city_data = $city_rs->fetch_assoc();

                                                  $delivery = 0;

                                                  if ($inovi_num == 1) {
                                                       if ($city_data["district_id"] == 1) {
                                                            $delivery = $product_data["delivery_free_colombo"];
                                                       } else {
                                                            $delivery = $product_data["delivery_free_other"];
                                                       }
                                                       $t = $inovi_data["total"];
                                                       $g = $t - $delivery;
                                                  } else {
                                                       if ($city_data["district_id"] == 1) {
                                                            $delivery_rs = Database::search("SELECT SUM(`delivery_free_colombo`) FROM `product` INNER JOIN `invoice` ON `product`.`id`=`invoice`.`product_id` WHERE `order_id`='" . $order_id. "'");
                                                            $delivery_data = $delivery_rs->fetch_assoc();
                                                            $delivery = implode(" ", $delivery_data);
                                                       } else {
                                                            $delivery_rs = Database::search("SELECT SUM(`delivery_free_other`) FROM `product` INNER JOIN `invoice` ON `product`.`id`=`invoice`.`product_id` WHERE `order_id`='" . $order_id. "'");
                                                            $delivery_data = $delivery_rs->fetch_assoc();
                                                            $delivery = implode(" ", $deliveryl_data);
                                                       }
                                                       $total_rs = Database::search("SELECT SUM(`total`) FROM `invoice` WHERE `order_id`='" . $order_id. "'");
                                                       $total_data = $total_rs->fetch_assoc();
                                                       $t = implode(" ", $total_data);
                                                       $subTotal_rs = Database::search("SELECT SUM(`price`) FROM `product` INNER JOIN `invoice` ON `product`.`id`=`invoice`.`product_id` WHERE `order_id`='" .$order_id . "'");
                                                       $subTotal_data = $subTotal_rs->fetch_assoc();
                                                       $g = implode(" ", $subTotal_data);
                                                  }

                                                 ?>
                                                  <tr>
                                                       <td colspan="3"></td>
                                                       <td class="fs-6 text-info ">SUBTOTAL</td>
                                                       <td class="fs-6 text-end">Rs.<?php echo $g; ?>.00</td>
                                                  </tr>
                                                  <tr>
                                                       <td colspan="3"></td>
                                                       <td class="fs-6 text-end">Delivery Fee</td>
                                                       <td class="fs-6 text-end">Rs.<?php echo $delivery; ?>.00</td>
                                                  </tr>
                                                  <tr>
                                                       <td colspan="3"></td>
                                                       <td class="fs-6 text-secondary ">GRAND&nbsp;TOTAL</td>
                                                       <td class="fs-6 text-end text-danger">Rs.<?php echo $t; ?>.00</td>
                                                  </tr>

                                             </tfoot>

                                        </table>
                                   </div>

                              </div>
                         </div>

                         <div class="col-12 shadow rounded-4 mt-3 mb-2">
                              <div class="row g-1">
                                   <div class="col-4 text-center" style="margin-top: 25px;">
                                        <span class="fs-1 fw-bold text-primary">Thank You !</span>
                                   </div>

                                   <div class="col-12 col-lg-10 offset-0 offset-lg-1 border-start border-5 border-primary mt-4 mb-3 rounded-3" style="background-color:#e7f2ff; ;">
                                        <div class="row">
                                             <div class="col-12 mt-3 mb-3">
                                                  <label class="form-label fw-bold fs-4">NOTICE :</label><br>
                                                  <label class="fs-5 form-label fw-bold">Purchased items can return befor 7 days of Delivery.</label>
                                             </div>
                                        </div>
                                   </div>

                                   <div class="col-12 text-center mb-3 mt-3">
                                        <label class="form-label fs-4 text-black-50 fw-bold">nvoice was created on a computer and is valid without the Signature and Seal.</label>
                                   </div>
                                   <!-- print -->

                              </div>
                         </div>



                    </div>
               </div>
               <div class="col-12 btn-toolbar justify-content-end  mt-3 mb-3">
                    <button class="btn btn-dark me-2"><i class="bi bi-printer-fill" onclick="printInovice();"></i>Print</button>
                    <a class="btn btn-danger me-2" onclick="downloadPDF();"><i class="bi bi-filetype-pdf"></i>Export An PDF</a>
               </div>

          <?php
                         }

          ?>

          <?php include "fooler.php"; ?>

          </div>
     </div>
     <script src="bootstrap.bundle.js"></script>
     <!-- <script src="bootstrap.js"></script> -->
     <script src="script.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
</body>

</html>