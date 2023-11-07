<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: index.html");
}

require 'phpmailer/PHPMailer.php';
require 'phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];

if (empty(trim($nombre))) $nombre = 'anonimo';
if (empty(trim($apellido))) $apellido = '';

// Crear el correo principal
$body = <<<HTML
    <h1>Contacto desde la web</h1>
    <p>De: $nombre $apellido / $email</p>
    <h2>Mensaje</h2>
    $mensaje
HTML;

$mailer = new PHPMailer();
$mailer->setFrom($email, "$nombre $apellido");
$mailer->addAddress('contacto@boostmenow.cl', 'Creacion de Sitios Web');
$mailer->Subject = "Mensaje web: $asunto";
$mailer->msgHTML($body);
$mailer->AltBody = strip_tags($body);

$rta = $mailer->send();

// Crear el correo de confirmación al usuario
if ($rta) {
    $confirmation_mailer = new PHPMailer();
    $confirmation_mailer->setFrom('contacto@boostmenow.cl', 'Creacion de Sitios Web');
    $confirmation_mailer->addAddress($email, "$nombre $apellido");
    $confirmation_mailer->Subject = "Confirmación de mensaje web: $asunto";

    // Personaliza el cuerpo del correo de confirmación en HTML y CSS
    $confirmation_body = <<<HTML
        <html>
        <head>
            <style>
                /* Estilos CSS en línea para personalizar el correo de confirmación */
            </style>
        </head>
        <body>
            <h1>Agradecemos tu mensaje</h1>
            <p>Gracias por ponerte en contacto con nosotros. Tu mensaje ha sido recibido con éxito.</p>
            <!-- Puedes personalizar el mensaje de agradecimiento aquí -->
        </body>
        </html>
    HTML;

    $confirmation_mailer->msgHTML($confirmation_body);
    $confirmation_mailer->AltBody = strip_tags($confirmation_body);

    $confirmation_mailer->send();
}

header("Location: gracias.html");
