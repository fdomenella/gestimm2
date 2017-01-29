<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require './PHPMailer/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = "bellatrix.dnshigh.com";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->SMTPSecure = "ssl";

$mail->Port = 465;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = "gestionale@immobiliarerinaldelli.com";
//Password to use for SMTP authentication
$mail->Password = "Albertosordi1_";
//Set who the message is to be sent from
$mail->setFrom('gestionale@immobiliarerinaldelli.com', 'Immobiliare Rinaldelli');
//Set an alternative reply-to address
$mail->addReplyTo('estionale@immobiliarerinaldelli.com', 'Immobiliare Rinaldelli');
//Set who the message is to be sent to
$mail->addAddress('francesco.domenella@gmail.com', 'Francesco Domenella');
//Set the subject line
$mail->Subject = 'PHPMailer SMTP test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('PHPMailer/examples/contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
$mail->addAttachment('PHPMailer/examples/images/phpmailer_mini.png');

$mail->Body ='ciao';
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
