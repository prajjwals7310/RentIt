<?php
$id = $_REQUEST['email'];
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true); // Passing true enables exceptions

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'singh.73pankaj.00@gmail.com';
$mail->Password = 'pbiy kueu wkdu xech';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('singh.73pankaj.00@gmail.com', 'Rent IT');
               $mail->addAddress($id, 'Recipient Name');
               $mail->Subject = 'OTP for Sign-Up';
               $otp = rand(1000,9999);
               $mail->Body = 'This is Your One time password(OTP) <b>'.$otp.'</b> ';
               $mail->AltBody = 'This is the plain text version of the email body';
               try {
                    $mail->send();
                    echo $otp;
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
?>
