<?php

session_start();
require "connection.php";

if(isset($_GET["verifiyCode"])){
 $verificationCode = $_GET["verifiyCode"];

 $admin_rs = Database::search("SELECT * FROM `admin` WHERE `varification_code`='".$verificationCode."'");
 $admin_num = $admin_rs->num_rows;

 if($admin_num == 1){
  $admin_data = $admin_rs->fetch_assoc();

  $_SESSION["admin"] = $admin_data;

  echo("Success");

 }else{
  echo("Invalid Verification Code");
 }
}else{
 echo("Please Enter your Verification Code");
}



?>