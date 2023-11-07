<?php
if($_SERVER['REQUEST_METHOD'] != 'POST' ){
    header("Location: index.html" );
}

require 'phpmailer/PHPMailer.php';
require 'phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];

if( empty(trim($nombre)) ) $nombre = 'anonimo';
if( empty(trim($apellido)) ) $apellido = '';

$body = <<<HTML
    <h1>Contact From WEBSITE</h1>
    <p>FROM: $nombre $apellido / $email</p>
    <h2>MESSAGE</h2>
    $mensaje
HTML;

$mailer = new PHPMailer();
$mailer->setFrom( $email, "$nombre $apellido" );
$mailer->addAddress('info@girosscarpet.com','Nuevo Mensaje');
$mailer->Subject = "WEB MESSAGE $asunto";
$mailer->msgHTML($body);
$mailer->AltBody = strip_tags($body);


$rta = $mailer->send( );

var_dump($rta);
header("Location: thanks.html" );