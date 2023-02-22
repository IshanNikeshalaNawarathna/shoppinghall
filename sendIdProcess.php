<?php 

session_start();

require "connection.php";

$user_email = $_SESSION["u"]["email"];
$product_id = $_GET["id"];

$product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$product_id."' AND `user_email`='".$user_email."'");
$product_num = $product_rs->num_rows;

if($product_num == 1){

 $product_data = $product_rs->fetch_assoc();
 $_SESSION["p"] = $product_data;

 echo("success");

}else{
 echo("Something went wrong. Please try agin Later");
}



?>