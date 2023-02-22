<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["email"])) {

 $email = $_GET["email"];

 $result_set = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
 $result_set_num = $result_set->num_rows;


 if ($result_set_num == 1) {

  $code = uniqid();

  Database::iud("UPDATE `user` SET `verification_code`='" . $code . "' WHERE `email`='" . $email . "'");

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
  $mail->Subject = 'shopping hall Forgot Password verification code';
  $bodyContent = '<h1 style ="color:black;">Your Verification is  ' . $code . '</h1>';
  $mail->Body    = $bodyContent;

  if (!$mail->send()) {
   echo 'Verification code sending failed';
  } else {
   echo 'Success';
  }
 } else {
  echo("Invalid Email Address Please Correct Email Address.");
 }
}
