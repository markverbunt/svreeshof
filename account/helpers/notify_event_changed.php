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
$event_id = $_POST['event_id'];

include_once('db.php');

//$result = mysqli_query($mysqli, 'SELECT firstname, email, lastname FROM test_users WHERE email_updates = FALSE AND role = 1');

$result = mysqli_query($mysqli, "SELECT event_bookings.bookings_id, event_bookings.bookings_status, event_bookings.event_id, event_bookings.user_id, users.firstname, users.lastname, users.email, event_bookings.updated_at, events.category, events.week, events.event_date, events.info, events.gameinfo, events.location, events.event_status, events.modified_at FROM event_bookings INNER JOIN users ON event_bookings.user_id=users.id INNER JOIN events ON event_bookings.event_id=events.event_id WHERE event_bookings.event_id='$event_id' AND email_updates = TRUE");

foreach ($result as $row) {
  $body = file_get_contents('mails/event_changed.html');
  $type = 'wijziging';
  $user_id = $row['user_id'];
  $event_id = $row['event_id'];
  $bookings_id = $row['bookings_id'];
  $firstname = $row['firstname'];
  $lastname = $row['lastname'];
  $email = $row['email'];
  $category = $row['category'];
  $week = $row['week'];
  $info = $row['info'];
  $gameinfo = $row['gameinfo'];
  $location = $row['location'];
  $orgDate = $row['event_date'];
  $event_date = date("d-m-Y", strtotime($orgDate));
  $Rawevent_status = $row['event_status'];
  $orgDateTime = $row['modified_at'];
  $modified_at = date("d-m-Y H:i:s", strtotime($orgDateTime));
  $Rawbookings_status = $row['bookings_status'];

  $mail->Subject = 'Wjziging voor de ' . $category . ' van week '  .$week . ' op ' . $event_date;

  if($Rawevent_status=="0") {
    $event_status = 'Afgelast';
  }
  else if($Rawevent_status=="1") {
    $event_status = 'Actief';
  }

  if($Rawbookings_status=="0") {
    $bookings_status = 'Afgemeld';
  }
  else if($Rawbookings_status=="1") {
    $bookings_status = 'Aangemeld';
  }

    try {
        $mail->addAddress($email, $firstname);
        $body = str_replace('%firstname%', $firstname, $body); 
        $body = str_replace('%lastname%', $lastname, $body); 
        $body = str_replace('%email%', $email, $body); 
        $body = str_replace('%category%', $category, $body);
        $body = str_replace('%week%', $week, $body);
        $body = str_replace('%info%', $info, $body);
        $body = str_replace('%gameinfo%', $gameinfo, $body);
        $body = str_replace('%location%', $location, $body);
        $body = str_replace('%event_date%', $event_date, $body);
        $body = str_replace('%event_id%', $event_id, $body);
        $body = str_replace('%modified_at%', $modified_at, $body);
        $body = str_replace('%event_status%', $event_status, $body);
        $body = str_replace('%bookings_status%', $bookings_status, $body);
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
        $mail->send();
        echo 'Mail is verzonden aan :' . htmlspecialchars($firstname) . ' (' .
            htmlspecialchars($email) . ')<br>';
        //Mark it as sent in the DB
        mysqli_query(
            $mysqli,
            "INSERT INTO email_logs (user_id, event_id, bookings_id, type) VALUES ('$user_id', '$event_id', '$bookings_id', '$type' )"
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
            window.location.href = "/account/edit_event.php?event_id=<?php echo $event_id ?>&EmailUpdateSend";
            window.clearTimeout(tID);   // clear time out.
        }, 2000);
    }

</script>
<script>redirect_Page();</script>
