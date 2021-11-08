<?php
include_once('db.php');

$bookings_id = $_POST['bookings_id'];
$user_id = $_POST['user_id'];
$event_id = $_POST['event_id'];
$goals = $_POST['goals'];

ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');
error_reporting(E_ALL);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if ($stmt = $mysqli->query("INSERT INTO event_scorers (bookings_id, user_id, event_id, goals) VALUES ('$bookings_id', '$user_id', '$event_id', '$goals')")) {
    header("location: /account/edit_event.php?event_id=$event_id");
}
mysqli_stmt_close($stmt);
$mysqli->close();
?>