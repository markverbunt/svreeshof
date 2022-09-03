<?php
include_once('db.php');

$event_id = $_POST['event_id'];
$bookings_status = $_POST['bookings_status'];

ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');
error_reporting(E_ALL);


if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$sql = "SELECT * FROM users WHERE user_status = 1 AND player_type = 0";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$id=$row['id'];
		$values= array('id' => $id );
		$all_users = implode($values);
		
		if ($stmt = $mysqli->query("INSERT INTO event_bookings (user_id, event_id, bookings_status) VALUES ('$all_users', '$event_id', '$bookings_status' )")) {
		header("location: /account/edit_event.php?event_id=$event_id&playersConnected");
		}
	}
}
$sql2 = "SELECT * FROM users WHERE user_status = 1 AND player_type = 1";
$result2 = $mysqli->query($sql2);
if ($result2->num_rows > 0) {
	while ($row2 = $result2->fetch_assoc()) {
		$id2=$row2['id'];
		$values2= array('id' => $id2 );
		$all_users2 = implode($values2);
		
		if ($stmt2 = $mysqli->query("INSERT INTO event_bookings (user_id, event_id, bookings_status) VALUES ('$all_users2', '$event_id', 0 )")) {
		header("location: /account/edit_event.php?event_id=$event_id&playersConnected");
		}
	}
}
mysqli_stmt_close($stmt);
mysqli_stmt_close($stmt2);
$mysqli->close();
?>