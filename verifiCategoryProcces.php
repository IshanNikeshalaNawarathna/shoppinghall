<?php

require "connection.php";

if (isset($_POST["verificationCode"]) && isset($_POST["newCategory"]) && isset($_POST["email"])) {

    $verificationCode = $_POST["verificationCode"];
    $newCategory = $_POST["newCategory"];
    $email = $_POST["email"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $email . "'");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num > 0) {

        $admin_data = $admin_rs->fetch_assoc();
        if ($admin_data["varification_code"] == $verificationCode) {

            Database::iud("INSERT INTO `category`(`name`) VALUES ('" . $newCategory . "')");
            echo ("success");
        } else {
            echo ("Invalid Verification Code.");
        }
    } else {
        echo ("Invalid User.");
    }
}
