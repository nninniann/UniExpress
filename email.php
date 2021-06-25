<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$mail = new PHPMailer;

$mail->SMTPDebug = 0;                               
$mail->isSMTP();                                    
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;                             
$mail->Username = "midlightsfood@gmail.com";                 
$mail->Password = "midlights888";                           
$mail->Port = 587;                                   

$mail->From = "midlightsfood@gmail.com";
$mail->FromName = "Midlights";

$mail->smtpConnect(
    array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )
    )
);

$mail->addAddress($_SESSION['email'], $_SESSION['custname']);

$mail->isHTML(true);

$mail->Subject = "Your order has been placed";
$mail->Body = "<i>Thank you for ordering Midlights</i>";
$mail->AltBody = "Thank you for ordering Midlights";

if(!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message has been sent successfully";
}

?>