<?php

require "connection.php";

if (isset($_GET["id"])) {

 $watchlist_id = $_GET["id"];

 $watch_rs = Database::search("SELECT  * FROM `watchlist` WHERE `id`='" . $watchlist_id . "'");
 $watch_num = $watch_rs->num_rows;
 $watch_data = $watch_rs->fetch_assoc();

 if ($watch_num == 0) {

  echo ("Something Went Wrong.Please try Again Later.");
 } else {

  Database::iud("INSERT INTO `recent`(`product_id`,`user_email`) VALUES ('" . $watch_data["product_id"] . "','" . $watch_data["user_email"] . "')");

  Database::iud("DELETE FROM `watchlist` WHERE `id`='" . $watchlist_id . "'");

  echo ("success");
 }
} else {

 echo ("Please Select a Product");
}
