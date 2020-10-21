<?php
// Multiple recipients
$to = 'm_verbunt@hotmail.com, m_verbunt@hotmail.com'; // note the comma

// Subject
$subject = 'Birthday Reminders for August';

// Message
$message = '
<html>
<head>
  <title>Birthday Reminders for August</title>
</head>
<body>
  <p>Here are the birthdays upcoming in August!</p>
  <table>
    <tr>
      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
    </tr>
    <tr>
      <td>Johny</td><td>10th</td><td>August</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
    </tr>
  </table>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';

// Additional headers
$headers[] = 'To: Mark <m_verbunt@hotmail.com>, Mark <m_verbunt@hotmail.com>';
$headers[] = 'From: Birthday Reminder <info@svreeshof-bierteam.nl/>';
$headers[] = 'Cc: m_verbunt@hotmail.com';
$headers[] = 'Bcc: m_verbunt@hotmail.com';

// Mail it
mail($to, $subject, $message, implode("\r\n", $headers));
if($mail){
  echo "Thank you for using our mail form";
}else{
  echo "Mail sending failed."; 
}
?>