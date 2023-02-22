<?php

session_start();
require "connection.php";



if($_GET["id"]){
    $invoice_id = $_GET["id"];

    // echo($invoice_id);

    Database::iud("UPDATE `invoice` SET `type`='2' WHERE `id`='".$invoice_id."' AND `user_email`='".$_SESSION["u"]["email"]."'");
    echo ("success");
  
}else{
    echo("Login First.");
}




