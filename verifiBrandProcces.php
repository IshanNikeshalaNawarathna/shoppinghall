<?php

require "connection.php";

if (isset($_POST["newBrandverificationCode"]) && isset($_POST["newBrand"]) && isset($_POST["brandTonewEmail"]) && isset($_POST["selectBrandCategory"])) {

    $verificationCode = $_POST["newBrandverificationCode"];
    $newModel = $_POST["newBrand"];
    $email = $_POST["brandTonewEmail"];
    $selectBrandCategory = $_POST["selectBrandCategory"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $email . "'");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num > 0) {

        $admin_data = $admin_rs->fetch_assoc();
        if ($admin_data["varification_code"] == $verificationCode) {

            Database::iud("INSERT INTO `brand`(`name`,`category_id`) VALUES ('" . $newModel . "','".$selectBrandCategory."')");
            echo ("success");
        } else {
            echo ("Invalid Verification Code.");
        }
    } else {
        echo ("Invalid User.");
    }
}
