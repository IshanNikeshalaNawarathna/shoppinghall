<?php


session_start();
require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["email"]) && isset($_POST["newCategory"])) {
    if ($_SESSION["admin"]["email"] == $_POST["email"]) {
        $categroy_name = $_POST["newCategory"];
        $email = $_POST["email"];



        $category_rs = Database::search("SELECT * FROM `category` WHERE `name` LIKE '%" . $categroy_name . "%'");
        $category_num = $category_rs->num_rows;


        if ($category_num == 0) {

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
            $mail->Subject = 'shopping hall Login Verification Code for Add New Category';
            $bodyContent = '<h1 style ="color:black;">Your Verification is  ' . $code . '</h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'Success';
            }
        } else {
            echo ("This Category Already Exists.");
        }
    } else {
        echo ("Invalid User.");
    }
} else {
    echo ("Something Missing");
}
