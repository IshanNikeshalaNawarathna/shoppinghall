<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
    $seller_email = $_SESSION["u"]["email"];

    $user_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $seller_email . "'");
    $user_num = $user_rs->num_rows;

    if ($user_num == 0) {
        echo ("2");
    }
} else {
    echo ("1");
}
