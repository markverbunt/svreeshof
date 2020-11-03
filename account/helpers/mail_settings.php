<?php
$mail->setLanguage('nl');
$mail->isSMTP();
$mail->Host = 'mail.svreeshof-bierteam.nl';
$mail->SMTPAuth = true;
$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
$mail->Port = 465;
$mail->SMTPSecure = "ssl";
$mail->Username = 'info@svreeshof-bierteam.nl';
$mail->Password = 'Mirko01!';
$mail->setFrom('info@svreeshof-bierteam.nl', 'SV Reeshof Bierteam');
$mail->addReplyTo('info@svreeshof-bierteam.nl', 'SV Reeshof Bierteam');
?>