<?php
session_start();
$rand=rand(100000,999999);
if (isset($_SESSION['login_time'])) {
     unset($_SESSION['otp']); 
     unset($_SESSION['login_time']);
}
$_SESSION["otp"]=$rand;

if (!isset($_SESSION['login_time'])) {
    $_SESSION['login_time'] = time();
}

if (time() - $_SESSION['login_time'] > 300) {
    unset($_SESSION['otp']); 
}
$email =  $_SESSION["email"];
$msg = "Dear User,<br>

Your OTP to reset your StoreFinder password is:<br>

🔐 OTP: $rand<br>

This OTP is valid for the next 5 minutes.<br>

If you didn’t request a password reset, please ignore this email.<br>

— StoreFinder Support
";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';  // SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'storefinder.dev@gmail.com';  // Your Gmail address
    $mail->Password   = 'yrnr umaa prsk lfld';     // Use App Password (NOT your Gmail password)
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('storefinder.dev@gmail.com', 'StoreFinder');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Password Reset OTP - StoreFinder';
    $mail->Body    = wordwrap($msg);

    $mail->send();
    echo 'Email sent';
} catch (Exception $e) {
    echo "Mail failed: {$mail->ErrorInfo}";
}


?>