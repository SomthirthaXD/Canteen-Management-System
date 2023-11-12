<?php
//Download PHPMailer folders and files from GitHub
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPAuth = true;                 
$mail->SMTPSecure = "tls";      
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587; 
$mail->Username = "Your Mail Here";
$mail->Password = "Your generated App Password here"; 
$mail->FromName = "The Heritage Canteen by Somthirtha";
$mail->isHTML( TRUE );
?>