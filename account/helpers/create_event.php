<?php
include_once('db');

$week = $_POST['week'];
$event_date = $_POST['event_date'];
$category = $_POST['category'];
$info = $_POST['info'];
$gameinfo = $_POST['gameinfo'];
$location = $_POST['location'];

ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');
error_reporting(E_ALL);


if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if ($stmt = $mysqli->query("INSERT INTO events (week, event_date, category, info, gameinfo, location, event_status) VALUES ('$week', '$event_date', '$category', '$info', '$gameinfo', '$location', '1' )")) {
			/*$last_id = $mysqli->insert_id;

			$sql2 = "SELECT * FROM users";
			$result = $mysqli->query($sql2);
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$id=$row['id'];
					$values= array('id' => $id );
					$all_users = implode($values);
					
					if ($stmt = $mysqli->query("INSERT INTO event_bookings (user_id, event_id, bookings_status) VALUES ('$all_users', '$last_id', '1' )")) {
					header("location: /account/event?event_id=$last_id");
					}
				}
			}*/

    		header("location: /account/list_events?eventSuccess");
		}
$mysqli->close();
?>