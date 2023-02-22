<?php
session_start();
require "connection.php";

if($_GET["id"]){
    $product_id = $_GET["id"];
   Database::iud("UPDATE `product` SET `type`='0' WHERE `id`='".$product_id."' AND `user_email`='".$_SESSION["u"]["email"]."'");
    echo ("success");
  
}else{
    echo("Login First.");
}




