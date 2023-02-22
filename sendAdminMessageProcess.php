<?php
session_start();

require "connection.php";

$msg_txt = $_POST["text"];
$receiver = $_POST["mail"];

if (empty($msg_txt)) {
 echo ("Ematy Message");
} else {
 $date = new DateTime();
 $timeZone = new DateTimeZone("Asia/Colombo");
 $date->setTimezone($timeZone);
 $newDate = $date->format("Y-m-d H:i:s");

 $sender;

 if (isset($_SESSION["u"])) {
  $sender = $_SESSION["u"]["email"];
 } else if (isset($_SESSION["admin"])) {
  $sender = $_SESSION["admin"]["email"];
 }

 if (empty($receiver)) {
  
  Database::iud("INSERT INTO `admin_chat`(`content`,`date_time`,`status`,`user_email`,`admin_email`) VALUES('" . $msg_txt . "','" . $newDate . "','0','" . $sender . "','" . $receiver . "')");
  echo ("Success");

 } else {

  if (isset($_SESSION["u"]) && !isset($_SESSION["admin"])) {

   if ($sender == $_SESSION["u"]["email"]) {

    Database::iud("INSERT INTO `admin_chat`(`content`,`date_time`,`status`,`user_email`,`admin_email`) VALUES('" . $msg_txt . "','" . $newDate . "','1','" . $sender . "','ishannikeshala99@gmail.com')");
    echo ("1");

   }

  } else if (isset($_SESSION["admin"]) && !isset($_SESSION["u"])) {

   if ($sender == $_SESSION["admin"]["email"]) {

    Database::iud("INSERT INTO `admin_chat`(`content`,`date_time`,`status`,`user_email`,`admin_email`) VALUES('" . $msg_txt . "','" . $newDate . "','2','ishannikeshala99@gmail.com','" . $receiver . "')");
    echo ("2");

   }

  }

 }
}
