<?php

/**
 * This example shows sending a message using PHP's mail() function.
 */

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

error_reporting(E_STRICT | E_ALL);

date_default_timezone_set('Etc/UTC');

require '../../vendor/autoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer(true);
include_once('mail_settings.php');
$body_content = $_POST['body_content'];
$subject = $_POST['subject'];
$users = $_POST['users'];

$all_email_ids = implode(', ', $users);

include_once('db.php');

$result = mysqli_query($mysqli, "SELECT users.id, users.firstname, users.lastname, users.email FROM users WHERE id IN ($all_email_ids)");

foreach ($result as $row) {
  $body = file_get_contents('mails/template_empty.html');
  $firstname = $row['firstname'];
  $lastname = $row['lastname'];
  $email = $row['email'];
  $type = 'Bericht';
  if( isset($_POST['send_mail']) ) {
    $send_mail = $_POST['send_mail'];
    }
    else {
     $send_mail = '0';   
    }
  $body_content = $_POST['body_content'];
  $user_id = $row['id'];
  $hashed_email_id = bin2hex(random_bytes(18));

  $mail->Subject = $subject;

    try {
        $mail->addAddress($email, $firstname);
        $body_content = str_replace('%firstname%', $firstname, $body_content);
        $body_content = str_replace('%lastname%', $lastname, $body_content);
        $body = str_replace('%firstname%', $firstname, $body); 
        $body = str_replace('%lastname%', $lastname, $body); 
        $body = str_replace('%email%', $email, $body);
        $body = str_replace('%subject%', $subject, $body);
        $body = str_replace('%body_content%', $body_content, $body);
    } catch (Exception $e) {
        echo 'Invalid address skipped: ' . htmlspecialchars($email) . '<br>';
        continue;
    }
    //if (!empty($row['photo'])) {
        //Assumes the image data is stored in the DB
      //  $mail->addStringAttachment($row['photo'], 'YourPhoto.jpg');
    //}

    try {
      //set it inside the loop
        $mail->msgHTML($body);
        //msgHTML also sets AltBody, but if you want a custom one, set it afterwards
        //$mail->AltBody = 'SV reeshof bierteam!';
        if($send_mail=="1") {
            $mail->send();
            echo $body;
            echo 'Bericht en email is verzonden aan :' . htmlspecialchars($firstname) . ' (' .
                htmlspecialchars($email) . ')<br>';
        }
        else {
            echo $body;
            echo 'Bericht is verzonden aan :' . htmlspecialchars($firstname) . ' (' .
                htmlspecialchars($email) . ')<br>';
        }
        //Mark it as sent in the DB
        mysqli_query(
            $mysqli,
            "INSERT INTO messages_logs (user_id, hashed_email_id, subject, body, type, send_mail) VALUES ('$user_id', '$hashed_email_id', '$subject', '$body_content', '$type', '$send_mail' )"
        );
    } catch (Exception $e) {
        echo 'Mailer Error (' . htmlspecialchars($email) . ') ' . $mail->ErrorInfo . '<br>';
        //Reset the connection to abort sending this message
        //The loop will continue trying to send to the rest of the list
        $mail->getSMTPInstance()->reset();
    }
    //Clear all addresses and attachments for the next iteration
    $mail->clearAddresses();
    $mail->clearAttachments();
}
$mysqli->close();
?>
<script>
      let redirect_Page = () => {
        let tID = setTimeout(function () {
            window.location.href = "/account/list_messages.php?MessageSend";
            window.clearTimeout(tID);   // clear time out.
        }, 2000);
    }

</script>
<script>redirect_Page();</script>