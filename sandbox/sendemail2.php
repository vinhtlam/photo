<?php
ini_set('display_errors',1);

require_once("../photogallery/includes/PHPMailer/class.phpmailer.php");
require_once("../photogallery/includes/PHPMailer/class.smtp.php");
require_once("../photogallery/includes/PHPMailer/language/phpmailer.lang-vi.php");
$to_name = "Junk mail";
$to = "lam.thevinh@gmail.com";
$subject = "Mail Test at ". strftime("%T", time());
$message = "This is a test mail.";
$message = wordwrap($message, 70, "\r\n");

$from_name= "Vinh Neo";
$from= "neotv50@gmail.com";

//PHP mail version (default)

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->SMTPAuth = false;
$mail->Username = "neotv50@gmail.com";
$mail->Password = "7894568072";

$mail->FromName = $from_name;
$mail->From = $from;
$mail->AddAddress($to, $to_name);
$mail->Subject = $subject;
$mail->Body = $message;


$result = $mail->Send();

echo $result ? 'Sent' : 'Error';

echo phpinfo();

?>