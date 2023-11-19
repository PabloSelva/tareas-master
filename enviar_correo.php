<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Verificar campos requeridos
  //if (empty($_POST['name']) || empty($_POST['lastname']) || empty($_POST['mail'])) {
    //echo "Por favor, completa todos los campos";
    //return false;
  //}

  // Datos del formulario
  $name = $_POST['name'];
  $lastname = $_POST['lastname'];
  $mail2 = $_POST['mail'];

  // Configuración del servidor SMTP
  $smtpHost = 'smtp.gmail.com'; // Dirección del servidor SMTP
  $smtpPort = 465; // Puerto del servidor SMTP
  $smtpUsername = 'rayito.cm3@gmail.com'; // Tu dirección de correo electrónico
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
  $mail->setFrom($mail2, $name,$lastname);
  $mail->addAddress(''); // Dirección de correo del destinatario
  $mail->Subject = 'Contacto desde formulario';

  // Cuerpo del mensaje
  $mail->Body = "Estimado : $name ,$lastname, su cuenta ha sido creada con exito\n";
  $mail->Body .= "Ha sido asigando al : $departament_id\n";
  $mail->Body .= "Mensaje:\n";

  // Enviar correo
  if ($mail->send()) {
    echo "Tu mensaje se envió con éxito";
    return true;
  } else {
    echo "Hubo un error al enviar el mensaje";
    return false;
  }
}
