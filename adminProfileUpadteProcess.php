<?php
session_start();
require "connection.php";

if (isset($_SESSION["admin"])) {

 $fname = $_POST["fname"];
 $lname = $_POST["lname"];

 if (empty($fname) && empty($lname)) {
  echo ("Please not empty input Filed.");
 } else {


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

    $file_name = "resocess/admin_img/"  . $_SESSION["admin"]["fname"] . "_" . uniqid() . $new_file_extention;
    move_uploaded_file($image["tmp_name"], $file_name);

    $image_rs = Database::search("SELECT * FROM `admin_profile` WHERE `admin_email`='" . $_SESSION["admin"]["email"] . "'");
    $image_num = $image_rs->num_rows;

    if ($image_num == 1) {

     Database::iud("UPDATE `admin_profile` SET `path`='" . $file_name . "' WHERE `admin_email`='" . $_SESSION["admin"]["email"] . "'");
    } else {

     Database::iud("INSERT INTO `admin_profile` (`path`,`admin_email`) VALUES('" . $file_name . "','" . $_SESSION["admin"]["email"] . "')");
    }
   }
  }


  Database::iud("UPDATE `admin` SET `fname`='" . $fname . "',`lname`='" . $lname . "' WHERE `email`='" . $_SESSION["admin"]["email"] . "'");


  echo ("success");
 }
} else {
 echo ("Please Login First.");
}
