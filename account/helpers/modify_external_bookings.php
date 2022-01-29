<?php
include_once('db.php');

$external_bookings_id = $_POST['external_bookings_id'];
$user_id = $_POST['user_id'];
$external_event_id = $_POST['external_event_id'];
$bookings_status = $_POST['bookings_status'];
$with_partner = $_POST['with_partner'];

ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');
error_reporting(E_ALL);


if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if ($stmt = $mysqli->query("UPDATE external_event_bookings SET user_id='$user_id', external_event_id='$external_event_id', bookings_status='$bookings_status', with_partner='$with_partner' WHERE external_bookings_id='$external_bookings_id'")) {
    header("location: /account/external_event.php?external_event_id=$external_event_id");
}
mysqli_stmt_close($stmt);
$mysqli->close();
?>