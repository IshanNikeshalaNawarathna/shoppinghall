<?php
session_start();
require "connection.php";

if (isset($_SESSION["admin"])) {

    if (isset($_GET["id"])) {
        $delete_category = $_GET["id"];

        $category_rs = Database::search("SELECT * FROM `category` WHERE `id`='" . $delete_category . "'");
        $category_num = $category_rs->num_rows;

        if ($category_num == 0) {

            Database::iud("DELETE FROM `category` WHERE `id`='" . $category_data["id"] . "'");
            echo ("1");
        } else {
            $category_data = $category_rs->fetch_assoc();
     
            Database::iud("UPDATE `brand_has_model` SET  `brand_id`='0',`model_id`='0' WHERE `id`='" . $category_data["id"] . "'");
            Database::iud("DELETE FROM `category` WHERE `id`='" . $delete_category. "'");
            echo ("2");
        }
    } else {
        echo ("Something Went Wrong");
    }
} else {
    echo ("Login First");
}
