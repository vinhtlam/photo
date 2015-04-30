<?php

$to = "neotv50@gmail.com";

//Windows may not handle this format wee
//$to = "Vin Lam <neotv50@gmail.com>" ;



//multible recipients
//$to = "neotv50@gmail.com, neotv50@yahoo.com";

$subject = "Mail Test at ". strftime("%T", time());

$message = "This is a test mail.";
//Ooptional: Wrap liens for old email programs
//wrap at 70/72/75,78

$message = wordwrap($message, 70);

$from= "vinh@tuoitre.com.vn";
$headers = "From: {$from}";

$result = mail($to, $subject, $message, $headers);

echo $result ? 'sent' : 'error';

?>