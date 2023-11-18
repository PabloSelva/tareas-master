<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Verificar campos requeridos
  if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['mensaje'])) {
    echo "Por favor, completa todos los campos";
    return false;
  }

  // Datos del formulario
  $nombre = $_POST['nombre'];
  $correo = $_POST['correo'];
  $mensaje = $_POST['mensaje'];

  // Configuración del servidor SMTP
  $smtpHost = ''; // Dirección del servidor SMTP
  $smtpPort = 587; // Puerto del servidor SMTP
  $smtpUsername = ''; // Tu dirección de correo electrónico
  $smtpPassword = ''; // Tu contraseña de correo electrónico

  // Configurar el envío de correo
  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->Host = $smtpHost;
  $mail->Port = $smtpPort;
  $mail->SMTPAuth = true;
  $mail->Username = $smtpUsername;
  $mail->Password = $smtpPassword;
  $mail->SMTPSecure = 'tls';

  // Información del correo
  $mail->setFrom($correo, $nombre);
  $mail->addAddress(''); // Dirección de correo del destinatario
  $mail->Subject = 'Contacto desde formulario';

  // Cuerpo del mensaje
  $mail->Body = "Nombre: $nombre\n";
  $mail->Body .= "Correo electronico: $correo\n";
  $mail->Body .= "Mensaje: $mensaje\n";

  // Enviar correo
  if ($mail->send()) {
    echo "Tu mensaje se envió con éxito";
    return true;
  } else {
    echo "Hubo un error al enviar el mensaje";
    return false;
  }
}
