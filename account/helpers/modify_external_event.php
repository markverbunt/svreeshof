<?php
include_once('db.php');

$external_event_id = $_POST['external_event_id'];
$external_event_time = $_POST['external_event_time'];
$external_event_date = $_POST['external_event_date'];
$external_event_category = $_POST['external_event_category'];
$external_event_info = $_POST['external_event_info'];
$external_event_status = $_POST['external_event_status'];
$external_event_partners = $_POST['external_event_partners'];
$external_event_location = $_POST['external_event_location'];

ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');
error_reporting(E_ALL);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if ($stmt = $mysqli->query("UPDATE external_events SET external_event_time='$external_event_time', external_event_date='$external_event_date', external_event_category='$external_event_category', external_event_info='$external_event_info', external_event_status='$external_event_status', external_event_partners='$external_event_partners', external_event_location='$external_event_location' WHERE external_event_id='$external_event_id'")) {
    header("location: /account/list_external_events.php?eventSuccessUpdated&external_event_category=$external_event_category");
}
mysqli_stmt_close($stmt);
$mysqli->close();
?>