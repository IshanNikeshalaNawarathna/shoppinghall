<?php
session_start();
require "connection.php";

if($_SESSION["u"]){
   Database::iud("UPDATE `invoice` SET `type`='2' WHERE `user_email`='".$_SESSION["u"]["email"]."'");
    echo ("success");
  
}else{
    echo("Login First.");
}





