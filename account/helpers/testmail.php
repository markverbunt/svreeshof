<?php

/**
 * This example shows sending a message using PHP's mail() function.
 */

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

require '../../vendor/autoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_SERVER;
//Set the hostname of the mail server
$mail->Host = 'mail.svreeshof-bierteam.nl';
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 465;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = 'info@svreeshof-bierteam.nl';
//Password to use for SMTP authentication
$mail->Password = 'Mirko01!';

//Set who the message is to be sent from
$mail->setFrom('info@svreeshof-bierteam.nl', 'SV Reeshof Bierteam');
//Set an alternative reply-to address
$mail->addReplyTo('info@svreeshof-bierteam.nl', 'SV Reeshof Bierteam');
//Set who the message is to be sent to
$mail->addAddress('m_verbunt@hotmail.com');
//Set the subject line
$mail->Subject = 'SV Reeshof Bierteam - Event aangemaakt';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('mails/contents.html'), __DIR__);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}