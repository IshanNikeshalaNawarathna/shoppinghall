<?php 


session_start();
require "connection.php";

if(isset($_SESSION["u"])){

$email = $_SESSION["u"]["email"];
$pid = $_POST["pid"];
$type = $_POST["t"];
$feedback = $_POST["feedback"];

$date = new DateTime();
$timeZone = new DateTimeZone("Asia/Colombo");
$date->setTimezone($timeZone);
$newDate = $date->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `feedback`(`type`,`massage`,`date`,`product_id`,`user_email`) VALUES ('".$type."','".$feedback."','".$newDate."','".$pid."','".$email."')");

echo "1";

}




?>