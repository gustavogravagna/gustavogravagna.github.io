<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $receiving_email_address = 'gustavogravagna993@gmail.com';
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  // Validar los campos requeridos
  if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo 'Por favor, completa todos los campos.';
    exit;
  }

  // Validar el formato del correo electrónico
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Por favor, ingresa una dirección de correo electrónico válida.';
    exit;
  }

  // Construir el mensaje de correo electrónico
  $email_message = "Name: $name\n";
  $email_message .= "Email: $email\n";
  $email_message .= "Subject: $subject\n";
  $email_message .= "Message:\n$message\n";

  // Enviar el correo electrónico
  $headers = 'From: ' . $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

  if (mail($receiving_email_address, $subject, $email_message, $headers)) {
    echo 'success';
  } else {
    echo 'Error al enviar el mensaje.';
  }
} else {
  echo 'Acceso inválido.';
}
?>

