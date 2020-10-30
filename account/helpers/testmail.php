<?php

/**
 * This example shows sending a message using PHP's mail() function.
 */

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

require '../../vendor/autoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
//Set who the message is to be sent from
$mail->setFrom('info@svreeshof-bierteam.nl', 'SV Reeshof Bierteam');
//Set an alternative reply-to address
$mail->addReplyTo('info@svreeshof-bierteam.nl', 'SV Reeshof Bierteam');
//Set who the message is to be sent to
$mail->addAddress('m_verbunt@hotmail.com');
//Set the subject line
$mail->Subject = 'Event aangemaakt';
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