<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    if (isset($_GET["id"]) && isset($_GET["q"])) {
        $pid = $_GET["id"];
        $qty = $_GET["q"];
        $email = $_SESSION["u"]["email"];

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id` = '" . $pid . "' AND `user_email` = '" . $email . "'");
        $cart_num = $cart_rs->num_rows;

        $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $pid . "'");
        $product_data = $product_rs->fetch_assoc();

        $q = $product_data["qty"];

        if ($cart_num == 1) {
            if ($q >= $qty) {
                Database::iud("UPDATE `cart`SET `qty`='" . $qty . "' WHERE `product_id`='" . $pid . "' AND `user_email` = '" . $email . "'");
                echo ("success");
            } else {
                echo ("Maximum Quantity reached");
            }
        }
    }
}

?>