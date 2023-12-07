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
  $email=$_POST["email"];
  $firstname = $_POST['firstname'];
  $password = $_POST['password'];
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
    $rutaImagen = 'logo.png';
    //Content
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject = 'Registro Intellysys';  
    //$mail->Body = "!Hola";
    //$mail->Body .= $_POST['firstname'];
    //$mail->Body .= "!Hola   \r ".$firstname."   Bienvenido a nuestro servicio Intellysys Encode .\r\n  Has sido registrado exitosamente! .";
    $mail->Body .= "
    <html lang=\"es\">
    <head>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <title>¡Bienvenido!</title>

        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 600px;
                margin: 20px auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h1 {
                color: #333;
            }

            p {
                color: #555;
            }

            .logo {
                text-align: center;
                margin-bottom: 20px;
            }

            img {
                max-width: 100%;
                height: auto;
            }

            .cta-button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #3498db;
                color: #fff;
                text-decoration: none;
                border-radius: 3px;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class=\"container\">
            
            <h1>¡Bienvenido a  IntellySys Encode!</h1>
            <p>Se ha creado un nuevo usuario para ti. A continuación, encontrarás los detalles de tu cuenta:</p>

            <ul>
                <p>Usuario:$email </p>
                <p>Contraseña:$password </p>
            </ul>

            <p>Por favor, inicia sesión con esta información .</p>

            <p>Gracias por unirte a nosotros.</p>

        </div>
    </body>
    </html>
";

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