<?php

session_start();

require "connection.php";

// if(isset($_SESSION["u"]) ==0){

$email = $_POST["signEmail"];
$password = $_POST["signPassword"];
$rememberme = $_POST["rememberMe"];

if (empty($email)) {
   echo ("Please Enter Your Email");
} else if (strlen($email) >= 100) {
   echo ("Email must have lass then 100 Characters.");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   echo ("Invalid Email Please correct Email");
} else if (empty($password)) {
   echo ("Pleas Enter Your Password.");
} else if (strlen($password) < 5 || strlen($password) > 20) {
   echo ("Password must be between 5 - 20 Characters");
} else {

   $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' AND `password`='" . $password . "'");
   $n = $rs->num_rows;

   if ($n == 1) {

      $data = $rs->fetch_assoc();

      if ($data["status"] == 0) {
         echo ("Sorry, your account has been suspended by the admin due to inappropriate behavior in your activity,Correct it and make it ");
     }else {
     echo ("success");
     }

      $_SESSION["u"] = $data;

      // if ($data["password"] == $password) {
         // echo ("success");
      // } else {
      //    echo ("Invalid Password");
      // }

      if ($rememberme == "true") {

         setcookie("email", $email, time() + (60 * 60 * 60 * 24 * 365));
         setcookie("password", $password, time() + (60 * 60 * 60 * 24 * 365));
      } else {
         setcookie("email", "", -1);
         setcookie("password", "", -1);
      }
   } else {
      echo ("Invalid Username or Password");
   }
}

// }else{
//    echo("Invalid User.");
// }
