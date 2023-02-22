<?php

session_start();
require "connection.php";

$email = $_SESSION["u"]["email"];

$category = $_POST["ca"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$color = $_POST["co"];
$qty = $_POST["qty"];
$cost = $_POST["cost"];
$dcwc = $_POST["dcwc"];
$dcoc = $_POST["dcoc"];
$text = $_POST["txt"];
$condition = $_POST["con"];


  if($category == "0"){
    echo ("Please select a Category");
}else if($brand == "0"){
    echo ("Please select a Brand");
}else if($model == "0"){
    echo ("Please select a Model");
}else if(empty($title)){
    echo ("Please add the Title");
}else if(strlen($title) >= 100){
    echo ("Title should have less than 100 characters");
}else if ($condition == "0"){
    echo ("Please select a Condition");
}else if ($color == "0"){
    echo ("Please select a Colour");
}else if(empty($qty)){
    echo ("Please add the Quantity");
}else if($qty == "0" | $qty == "e" | $qty < 0){
    echo ("Invalid value for field Quantity");
}else if(empty($cost)){
    echo ("Please add the Cost");
}else if(!is_numeric($cost)){
    echo ("Invalid value for field Cost Per Item");
}else if(empty($dcwc)){
    echo ("Please add the Cost for Delivery inside Colombo");
}else if(!is_numeric($dcwc)){
    echo ("Invalid value for field Delivery cost within Colombo");
}else if(empty($dcoc)){
    echo ("Please add the Cost for Delivery outside Colombo");
}else if(!is_numeric($dcoc)){
    echo ("Invalid value for field Delivery cost out of Colombo");
}else if(empty($text)){
    echo ("Please add the Description");
}else{



  $brand_has_model_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `model_id`='" . $model . "' AND `brand_id`='" . $brand . "'");

  $brand_has_model_id;

  if ($brand_has_model_rs->num_rows > 0) {

    $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
    $brand_has_model_id = $brand_has_model_data["id"];
  } else {

    Database::iud("INSERT INTO `brand_has_model`(`model_id`,`brand_id`) VALUES ('" . $model . "','" . $brand . "')");
    $brand_has_model_id = Database::$connection->insert_id;

    echo($brand_has_model_id);
  }

  $d = new DateTime();
  $timeZone = new DateTimeZone("Asia/Colombo");
  $d->setTimezone($timeZone);
  $date = $d->format("Y-m-d H:i:s");

  $status = 1;

  Database::iud("INSERT INTO `product` (`price`,`qty`,`description`,`title`,`datetime_added`,`delivery_free_colombo`,`delivery_free_other`,`color_id`,`category_id`,
  `brand_has_model_id`,`condition_id`,`user_email`,`status_id`,`type`) VALUES ('" . $cost . "','" . $qty . "','" . $text . "','" . $title . "','" . $date . "','" . $dcwc . "',
  '" . $dcoc  . "','" . $color . "','" . $category . "','" . $brand_has_model_id. "','" . $condition. "','" . $email. "','" .$status . "','1')");

  Database::iud("UPDATE `brand_has_model` SET `brand_id`='".$brand." AND `model_id`='".$model."''");

  echo ("Product Added Successfully");

  $product_id = Database::$connection->insert_id;

  $length = sizeof($_FILES);

  if ($length <= 3 && $length > 0) {
    $allowed_image_extention = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

    for ($x = 0; $x < $length; $x++) {
      if (isset($_FILES["image" . $x])) {

        $image_file = $_FILES["image" . $x];
        $file_extention = $image_file["type"];

        if (in_array($file_extention, $allowed_image_extention)) {

          $new_img_extention;

          if ($file_extention == "image/jpg") {
            $new_img_extention = ".jpg";
          } else if ($file_extention == "image/jpeg") {
            $new_img_extention = ".jpeg";
          } else if ($file_extention == "image/png") {
            $new_img_extention = ".png";
          } else if ($file_extention == "image/svg+xml") {
            $new_img_extention = ".svg";
          }

          $file_name = "resocess//mobile_img//" . $title . "_" . uniqid() . $new_img_extention;
          move_uploaded_file($image_file["tmp_name"], $file_name);

          Database::iud("INSERT INTO `images`(`code`,`product_id`) VALUES ('" . $file_name . "','" . $product_id . "')");
          // Database::iud("INSERT INTO `images`(`code`,`product_id`) VALUES ('".$file_name."','".$product_id."')");
        } else {
          echo ("Not an allowed image type");
        }
      }
    }

    echo ("Product image Saved Successfully");
  } else {
    echo ("Invalid Image Count");
  }
}
