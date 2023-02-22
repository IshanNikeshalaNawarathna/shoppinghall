<?php
require "connection.php";
if(isset($_GET["email"])){
 $mail = $_GET["email"];

 $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$mail."'");
  $user_num = $user_rs->num_rows;

  if($user_num == 1){
   $user_data = $user_rs->fetch_assoc();

   if($user_data["status"] == 1){
    Database::iud("UPDATE `user` SET `status`='0' WHERE `email`='".$mail."'");
    echo("1");
   }else if($user_data["status"] == 0){
   Database::iud("UPDATE `user` SET `status`='1' WHERE `email`='".$mail."'");
   echo("2");
   }

  }else{
   echo("Can not find User.Please try again later.");
  }



 }else{
  echo("Somenthing went wrong.");
 }
