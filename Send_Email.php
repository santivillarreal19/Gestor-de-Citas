<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('model/functions.php');
require_once('conn/conn.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
}
require 'vendor/autoload.php'; // Adjust path if not using Composer



    $mail = new PHPMailer(true); // Enable exceptions
try {
// Server settings
$mail->isSMTP(); // Use SMTP
$mail->Host = 'smtp.gmail.com'; // SMTP server
$mail->SMTPAuth = true; // Enable authentication
$mail->Username = 'santivilla19maya@gmail.com'; // SMTP username
$mail->Password = 'etrn oymd svlj thjb'; // SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encryption (TLS/SSL)
$mail->Port = 587; // TCP port (587 for TLS)

// Recipients
$mail->setFrom('santivilla19maya@gmail.com');
$mail->addAddress($email); // Add recipient

// Content
$mail->isHTML(true); // Email format: HTML
$mail->Subject = 'Hola :D';
$mail->Body = '<b>Bienvenido a NUestro Software</b>';
$mail->AltBody = '';

$mail->send();

RegistroUsuario($conn,$name,$email,$phone);

} catch (Exception $e) {
echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>