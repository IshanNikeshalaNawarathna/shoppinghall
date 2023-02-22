<?php

require "connection.php";

if (isset($_POST["newModelverificationCode"]) && isset($_POST["newModel"]) && isset($_POST["modelTonewEmail"])) {

    $verificationCode = $_POST["newModelverificationCode"];
    $newModel = $_POST["newModel"];
    $email = $_POST["modelTonewEmail"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $email . "'");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num > 0) {

        $admin_data = $admin_rs->fetch_assoc();
        if ($admin_data["varification_code"] == $verificationCode) {

            Database::iud("INSERT INTO `model`(`name`) VALUES ('" . $newModel . "')");
            echo ("success");
        } else {
            echo ("Invalid Verification Code.");
        }
    } else {
        echo ("Invalid User.");
    }
}
