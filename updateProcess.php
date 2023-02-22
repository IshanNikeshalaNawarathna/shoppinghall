<?php

session_start();

require "connection.php";

if (isset($_SESSION["p"])) {

    $product = $_SESSION["p"]["id"];

    $title = $_POST["t"];
    $qty = $_POST["q"];
    $dcwc = $_POST["dcwc"];
    $dcoc = $_POST["dcoc"];
    $ds = $_POST["d"];

    Database::iud("UPDATE `product` SET `title`='" . $title . "',`qty`='" . $qty . "',`delivery_free_colombo`='" . $dcwc . "',
    `delivery_free_other`='" . $dcoc . "',`description`='" . $ds . "'WHERE `id`='" . $product . "'");

    // Database::iud("UPDATE `product` SET `title`='" . $title . "',`qty`='" . $qty . "',`delivery_free_colombo`='" . $dcwc . "',`delivery_free_other`='" . $dcoc . "',
    // `description`='" . $ds . "' WHERE `id`='" . $product . "'");

    echo ("Product Updated Successfliy");

    $length = sizeof($_FILES);

    $allowed_img_extention = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

    Database::iud("DELETE FROM `images` WHERE `product_id`='" . $product . "'");


    if ($length <= 3 && $length > 0) {

        for ($x = 0; $x < $length; $x++) {
            if (isset($_FILES["i" . $x])) {

                $image_file = $_FILES["i" . $x];
                $file_type = $image_file["type"];

                if (in_array($file_type, $allowed_img_extention)) {

                    $new_image_extention;

                    if ($file_type == "image/jpg") {
                        $new_image_extention = ".jpg";
                    } else if ($file_type == "image/jpeg") {
                        $new_image_extention = ".jpeg";
                    } else if ($file_type == "image/png") {
                        $new_image_extention = ".png";
                    } else if ($file_type == "image/svg+xml") {
                        $new_image_extention = ".svg";
                    }

                    $file_name = "resocess//mobile_img//" . $title . "_" . uniqid() . $new_image_extention;
                    move_uploaded_file($image_file["tmp_name"], $file_name);

                    Database::iud("INSERT INTO `images`(`code`,`product_id`) VALUES ('" . $file_name . "','" . $product . "')");

                    // echo("success");
                } else {
                    echo ("File type not Allowed");
                }
            }
        }
    } else {
        echo ("Invalid Image Count");
    }
}
