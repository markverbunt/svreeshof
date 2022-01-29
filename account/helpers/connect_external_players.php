<?php
include_once('db.php');

$external_event_id = $_POST['external_event_id'];
$bookings_status = $_POST['bookings_status'];
$with_partner = '0';

ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');
error_reporting(E_ALL);


if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$sql = "SELECT * FROM users";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$id=$row['id'];
		$values= array('id' => $id );
		$all_users = implode($values);
		
		if ($stmt = $mysqli->query("INSERT INTO external_event_bookings (user_id, external_event_id, bookings_status, with_partner) VALUES ('$all_users', '$external_event_id', '$bookings_status', '$with_partner' )")) {
		header("location: /account/edit_external_event.php?external_event_id=$external_event_id&playersConnected");
		}
	}
}
mysqli_stmt_close($stmt);
$mysqli->close();
?>