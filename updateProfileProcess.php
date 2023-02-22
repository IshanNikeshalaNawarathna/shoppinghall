<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

 $fname = $_POST["fn"];
 $lname = $_POST["ln"];
 $mobile = $_POST["m"];
 $line1 = $_POST["li1"];
 $line2 = $_POST["li2"];
 $provice = $_POST["pro"];
 $district = $_POST["dis"];
 $city = $_POST["ci"];
 $postalcode = $_POST["pos"];

 // if(empty($fname)){
 // echo("Please Update New First Name");
 // } else if (strlen($fname) > 50) {
 //  echo ("First Name must have lass than 50 Characters.");
 // }else if(empty($lname)){
 //  echo("Please Update New Last Name");
 // }else if (strlen($fname) > 50) {
 //  echo ("Last Name must have lass than 50 Characters.");
 // }else if (empty($mobile)) {
 //  echo ("Pleas Enter your Mobile Number");
 // } else if (strlen($mobile) != 10) {
 //  echo ("Mobile Number must have 10 Characters.");
 // } else if (!preg_match("/07[1,2,4,5,6,7,8,9][0-9]/", $mobile)) {
 //  echo ("Invaild Mobile Number.");
 // }else if(empty($line1)){
 //  echo("Please Update Address Line 01");
 // }else if (strlen($line1) > 50) {
 //  echo ("Last Name must have lass than 50 Characters.");
 // }else if(empty($line2)){
 //  echo("Please Update Address Line 01");
 // }else if (strlen($line2) > 50) {
 //  echo ("Last Name must have lass than 50 Characters.");
 // }

 if (isset($_FILES["image"])) {
  $image = $_FILES["image"];

  $allowed_image_extention = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
  $file_extention = $image["type"];


  if (!in_array($file_extention, $allowed_image_extention)) {

   echo ("Please Select a valid Image");
  } else {
   $new_file_extention;

   if ($file_extention == "image/jpg") {
    $new_file_extention = ".jpg";
   } else if ($file_extention == "image/jpeg") {
    $new_file_extention = ".jpeg";
   } else if ($file_extention == "image/png") {
    $new_file_extention = ".png";
   } else if ($file_extention == "image/svg+xml") {
    $new_file_extention = ".svg";
   } 

   $file_name = "resocess/profile_img/"  . $_SESSION["u"]["fname"] . "_" . uniqid() . $new_file_extention;
   move_uploaded_file($image["tmp_name"], $file_name);

   $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
   $image_num = $image_rs->num_rows;

   if ($image_num == 1) {

    Database::iud("UPDATE `profile_image` SET `path`='" . $file_name . "' WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
   } else {

    Database::iud("INSERT INTO `profile_image` (`path`,`user_email`) VALUES('" . $file_name . "','" . $_SESSION["u"]["email"] . "')");
   }
  }
 }

 Database::iud("UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`mobile`='" . $mobile . "' WHERE `email`='" . $_SESSION["u"]["email"] . "'");

 $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");

 $address_num = $address_rs->num_rows;

 if ($address_num == 1) {

  Database::iud("UPDATE `user_has_address` SET `line1`='" . $line1 . "',
  `line2`='" . $line2 . "',
  `city_id`='" . $city . "',
  `postal_code`='" . $postalcode . "' WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
 } else {


  Database::iud("INSERT INTO `user_has_address` 
  (`line1`,`line2`,`user_email`,`city_id`,`postal_code`) VALUES 
  ('" . $line1 . "','" . $line2 . "','" . $_SESSION["u"]["email"] . "','" . $city . "','" . $postalcode . "')");
 }


 echo ("success");
} else {
 echo ("Please Login First");
}
