<?php

require "connection.php";

$firstname = $_POST["fname"];
$lastname = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["password"];
$mobile = $_POST["mobile"];
$gender = $_POST["gender"];

if (empty($firstname)) {
  echo ("Pleas Enter Your First Name.");
} else if (strlen($firstname) > 50) {
  echo ("First Name must have lass than 50 Characters.");
} else if (empty($lastname)) {
  echo ("Pleas Inter Your Last Name.");
} else if (strlen($lastname) > 50) {
  echo ("Last Name must have lass than 50 Characters.");
} else if (empty($email)) {
  echo ("Pleas Enter Your Email.");
} else if (strlen($email) >= 100) {
  echo ("Email must have lass then 100 Characters.");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo ("Invalid Email Please correct Email");
} else if (empty($password)) {
  echo ("Pleas Enter Your Password.");
} else if (strlen($password) < 5 || strlen($password) > 20) {
  echo ("Password must be between 5 - 20 Characters");
} else if (empty($mobile)) {
  echo ("Pleas Enter your Mobile Number");
} else if (strlen($mobile) != 10) {
  echo ("Mobile Number must have 10 Characters.");
} else if (!preg_match("/07[1,2,4,5,6,7,8,9][0-9]/", $mobile)) {
  echo ("Invaild Mobile Number.");
} else {

 

  $nu = Database::search("SELECT * FROM `user` WHERE `email`= '" . $email . "' OR `mobile`= '" . $mobile . "'");
  $s = $nu->num_rows;

  if ($s > 0) {

    echo ("User with same Email or Mobile alreday exsist");
  } else {

    $d = new DateTime();
    $b = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($b);
    $date = $d->format("Y:m:d H:i:s");

    Database::iud("INSERT INTO `user`(`fname`,`lname`,`email`,`password`,`mobile`,`gender_id`,`joined_data`,`status`) VALUES 
    ('" . $firstname . "','" . $lastname . "','" . $email . "','" . $password . "','" . $mobile . "','" . $gender . "','" . $date . "','1')");

    echo ("Success");
  }
}
