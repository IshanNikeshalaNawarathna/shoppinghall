<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["adEmail"])) {

 $email = $_POST["adEmail"];

 $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $email . "'");
 $admin_rs_num = $admin_rs->num_rows;


 if ($admin_rs_num == 1) {

  $code = uniqid();

  Database::iud("UPDATE `admin` SET `varification_code`='" . $code . "' WHERE `email`='" . $email . "'");

  // email code
  $mail = new PHPMailer;
  $mail->IsSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'ishannikeshala1999@gmail.com';
  $mail->Password = 'zdfagjnshfyecacx';
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465;
  $mail->setFrom('ishannikeshala1999@gmail.com', 'Reset Password');
  $mail->addReplyTo('ishannikeshala1999@gmail.com', 'Reset Password');
  $mail->addAddress($email);
  $mail->isHTML(true);
  $mail->Subject = 'shopping hall Admin verification code';
  $bodyContent = '<h1 style ="color:black;">Your Verification is  ' . $code . '</h1>';
  $mail->Body    = $bodyContent;

  if (!$mail->send()) {
   echo 'Verification code sending failed';
  } else {
   echo 'Success';
  }
 } else {
  echo("You are not a Valid Admin");
 }
}else{
 echo("Email Field Shoudt be not empty");
}
