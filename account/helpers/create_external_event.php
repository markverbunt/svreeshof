<?php
include_once('db.php');

$external_event_time = $_POST['external_event_time'];
$external_event_date = $_POST['external_event_date'];
$external_event_category = $_POST['external_event_category'];
$external_event_info = $_POST['external_event_info'];
$external_event_partners = $_POST['external_event_partners'];
$external_event_location = $_POST['external_event_location'];

ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');
error_reporting(E_ALL);


if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if ($stmt = $mysqli->query("INSERT INTO external_events (external_event_time, external_event_date, external_event_category, external_event_info, external_event_partners, external_event_location, external_event_status) VALUES ('$external_event_time', '$external_event_date', '$external_event_category', '$external_event_info', '$external_event_partners', '$external_event_location', '1' )")) {
			/*$last_id = $mysqli->insert_id;

			$sql2 = "SELECT * FROM users";
			$result = $mysqli->query($sql2);
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$id=$row['id'];
					$values= array('id' => $id );
					$all_users = implode($values);
					
					if ($stmt = $mysqli->query("INSERT INTO event_bookings (user_id, event_id, bookings_status) VALUES ('$all_users', '$last_id', '1' )")) {
					header("location: /account/event.php?event_id=$last_id");
					}
				}
			}*/

    		header("location: /account/list_events.php?eventSuccess");
		}
$mysqli->close();
?>