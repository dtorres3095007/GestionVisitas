<?php

require_once './esUsuario.php';
require '../PHPMailer/PHPMailerAutoload.php';
require_once './Parametros.php';
if (isset($_POST["nombre"]) && isset($_POST["correo"]) && isset($_POST["tema"]) && isset($_POST["mensaje"])) {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $tema = $_POST["tema"];
    $mensaje = $_POST["mensaje"];
}else{
    echo json_encode($_POST["nombre"]);
    return false;
}



$email = BuscarCorreos();

$correoPrincipal = $email[0];


/**
 * This example shows making an SMTP connection with authentication.
 */
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
//date_default_timezone_set('Etc/UTC');
//Create a new PHPMailer instance
//  $mail->charSet = "UTF-8";
//$mail­->Encoding = "quoted­printable";
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 1;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = "smtp.office365.com";
// Seteo de la seguridad
$mail->SMTPSecure = 'tls';
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 25;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = $correoPrincipal["valor"];
//Password to use for SMTP authentication
$mail->Password = $correoPrincipal["id_aux"];
//Set who the message is to be sent from
$mail->setFrom($correoPrincipal["valor"], 'Gestion de Visitas');
//Set an alternative reply-to address
//$mail->addReplyTo('ocantill4@cuc.edu.co', 'Oscar Cantillo Menco');
//Set who the message is to be sent to
$mail->addAddress($correo, "Ayuda");
//Set the subject line
$mail->Subject = $tema;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('inicio.php'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->Body = $mensaje;
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
// Esta es una pequena validación, que solo envie el correo si todas las variables tiene algo de contenido:
//if($nombre != '' && $email != '' && $telefono != '' && $mensaje != ''){
//  mail($dest,$asunto,$cuerpo,$headers); //ENVIAR!
//}

if (!$mail->send()) {
    echo json_encode(1);
} else {
    echo json_encode(2);
}
?>