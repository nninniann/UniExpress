<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

if (isset($_POST['submit'])) {

$mail = new PHPMailer;
$mail->SMTPDebug = 0;                               
$mail->isSMTP();                                    
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;                             
$mail->Username = "midlightsfood@gmail.com";                 
$mail->Password = "midlights888";                           
$mail->Port = 587;                                   

$mail->From = $_POST['email'];
$mail->FromName = $_POST['name'];

$mail->smtpConnect(
    array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )
    )
);

$mail->addAddress("midlightsfood@gmail.com", "Midlights");

$mail->isHTML(true);

$mail->Subject = "Customer Support";
$mail->Body = "<i>".$_POST['desc']."</i>";
$mail->AltBody = "Thank you for ordering Midlights";

if(!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message has been sent successfully";
}

 header('Location: index.php');
 return;

}
?>