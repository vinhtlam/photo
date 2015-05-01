<?php
ini_set('display_errors',1);

$to = "vinhtlam@yahoo.com";

//Windows may not handle this format wee
//$to = "Vin Lam <neotv50@gmail.com>" ;

//multible recipients
//$to = "neotv50@gmail.com, neotv50@yahoo.com";

$subject = "Mail Test at ". strftime("%T", time());

$message = "This is a test mail.";
//Ooptional: Wrap liens for old email programs
//wrap at 70/72/75,78

$message = wordwrap($message, 70, "\r\n");

$from= "vinhtlam@yahoo.com";
$headers = "From: {$from}\n";
$headers .= "Reply-To: {$from}\n";
// $headers .= "Cc: {$to}\n";
// $headers .= "Bcc: {$to}\n";
$headers .= "X-Mailer: PHP/".phpversion()."\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: text/plain; charset=iso-8859-1";

$result = mail($to, $subject, $message, $headers);

$mail=mail($to, "Subject: $subject",$message );
if($mail){
  echo "Thank you for using our mail form";
}else{
  echo "Mail sending failed."; 
}

echo $result;
echo $result ? 'Sent' : 'Error';

echo phpinfo();

?>