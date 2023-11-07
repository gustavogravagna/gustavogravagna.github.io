<?php
if($_SERVER['REQUEST_METHOD'] != 'POST' ){
    header("Location: index.html" );
}

require 'phpmailer/PHPMailer.php';
require 'phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;


$email = $_POST['email'];


$body = <<<HTML
    <h1>Contacto desde la web</h1>
    <p>De $email</p>
    <h2>Correo</h2>
HTML;

$mailer = new PHPMailer();
$mailer->setFrom( $email );
$mailer->addAddress('info@girosscarpet.com','Nuevo Contacto de Email');
$mailer->Subject = "Nuevo Suscriptor";
$mailer->msgHTML($body);
$mailer->AltBody = strip_tags($body);


$rta = $mailer->send( );

var_dump($rta);
header("Location: thanksyou.html" );