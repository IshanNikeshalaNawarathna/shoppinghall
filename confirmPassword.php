<?php

require "connection.php";

$email = $_POST["email"];
$newPassword = $_POST["newPassword"];
$confirmNewPassword = $_POST["confirmNewPassword"];
$verificationCode = $_POST["verificationCode"];

if (empty($email)) {
 echo ("Pleas Enter Your Email.");
} else if (strlen($email) >= 100) {
 echo ("Email must have lass then 100 Characters.");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 echo ("Invalid Email Please correct Email");
} else if (empty($newPassword)) {
 echo ("Pleas Enter Your New Password.");
} else if (strlen($newPassword) < 5 || strlen($newPassword) > 20) {
 echo ("Invalid Password");
} else if (empty($confirmNewPassword)) {
 echo ("Pleas Enter Your Confirm Password.");
} else if ($newPassword != $confirmNewPassword) {
 echo ("Password does not matched.");
} else if (empty($verificationCode)) {
 echo ("Please Enter your Verification Code");
} else {


 $newPassword_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'
 AND `verification_code`='" . $verificationCode . "'");

 $newPassword_num = $newPassword_rs->num_rows;

 if ($newPassword_num == 1) {

  Database::iud("UPDATE `user` SET `password`='" . $newPassword . "' WHERE `email`='" . $email . "'");

  echo ("success");
  
 } else {

  echo ("Invalid Emali or Verification Code Please Check.");
 }
}
