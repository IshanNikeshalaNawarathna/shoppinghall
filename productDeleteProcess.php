<?php

// session_start();
require "connection.php";

if(isset($_GET["id"])){
    $product_id = $_GET["id"];
    // $user_maill = $_GET["u"];

    $delete_product_rs = Database::search("SELECT  * FROM `delete_product` WHERE `id`='" . $product_id. "'");
    $delete_product_num = $delete_product_rs->num_rows;
    $delete_product_data = $delete_product_rs->fetch_assoc();
   
    if ($delete_product_num == 0) {
   
     echo ("Something Went Wrong.Please try Again Later.");
    } else {

        Database::search("INSERT INTO `delete_product`(`product_id`,`user_email`) VALUES ('".$product_id["product_id"]."','".$delete_product["user_email"]."')");
        Database::iud("DELETE FROM `delete_product`  WHERE `id`='".$delete_product_data."'");

     echo ("success");
    }
   } else {
   
    echo ("Please Select a Product");
   }
   


?>