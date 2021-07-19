<?php
include_once('db.php');

$event_id = $_POST['event_id'];
$event_time = $_POST['event_time'];
$event_date = $_POST['event_date'];
$category = $_POST['category'];
$info = $_POST['info'];
$event_status = $_POST['event_status'];
$gameinfo = $_POST['gameinfo'];
$location = $_POST['location'];

ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');
error_reporting(E_ALL);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if ($stmt = $mysqli->query("UPDATE events SET event_time='$event_time', event_date='$event_date', category='$category', info='$info', event_status='$event_status', gameinfo='$gameinfo', location='$location' WHERE event_id='$event_id'")) {
    header("location: /account/list_events.php?eventSuccessUpdated&event_category=$category");
}
mysqli_stmt_close($stmt);
$mysqli->close();
?>