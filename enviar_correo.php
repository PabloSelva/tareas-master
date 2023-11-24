<?php
 
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
//required files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
 
//Create an instance; passing `true` enables exceptions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
  $nombre = $_POST['firstname'];
  $mail = new PHPMailer(true);
 
    //Server settings
    
    $mail->isSMTP();                              //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;             //Enable SMTP authentication
    $mail->Username   = 'intellysys.encode@gmail.com';   //SMTP write your email
    $mail->Password   = 'jnjvwjtegtadifmk';      //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
    $mail->Port       = 465;                                    
    $mail->SMTPOptions= array(
      'ssl'=>array(
      'verify_peer'=>false,
      'verify_peer_name'=>false,
      'allow_self_signed'=>true
      )
      );
    //Recipients
    $mail->setFrom('intellysys.encode@gmail.com'); // Sender Email and name
    $mail->addAddress($_POST["email"]);     //Add a recipient email
    //$mail->Subject = 'Contacto desde formulario';  
    //$mail->addReplyTo($_POST["email"], $_POST["name"]); // reply to sender email
 
    //Content
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject = 'Registro Intellysys';  
    $mail->Body = "¡Hola! $nombre\n";
    $mail->Body = "Bienvenido a nuestro servicio Intellysys Encode .\n
     Has sido registrado exitosamente .";

    //$mail->Body .= "Correo electrónico: \n";
    //$mail->Body .= "Mensaje: ";
    // Success sent message alert
    $mail->send();
    echo
    " 
    <script> 
     alert('Message was sent successfully!');
    </script>
    ";
}