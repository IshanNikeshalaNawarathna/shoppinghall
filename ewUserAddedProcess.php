<?php

require "connection.php";

if(isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"]) && isset($_POST["mobileNumder"])){
    $fistName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $mobileNumber = $_POST["mobileNumder"];

    $newUser_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' OR `mobile`='".$mobileNumber."'");
    $newUser_num = $newUser_rs->num_rows;

    if($newUser_num > 0 ){
        echo ("User with same Email or Mobile alreday exsist");
    }else{
        $date = new DateTime();
        $dateTimeZone = new DateTimeZone("Asia/Colombo");
        $date->setTimezone($dateTimeZone);
        $newdate = $date->format("Y:m:d H:i:s");

        Database::iud("INSERT INTO `user`(`fname`,`lname`,`email`,`mobile`,`joined_data`,`status`) VALUES 
        ('" . $firstname . "','" . $lastname . "','" . $email . "','" . $mobile . "','" . $newdate . "','1')");

        echo("success");
    }

}else{
    echo("Not Ematy Input Fild.");
}
