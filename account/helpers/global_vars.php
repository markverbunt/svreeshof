<?php
	require_once('session.php');

	include_once('db.php');
	// Check connection
	if ($mysqli->connect_error) {
	  die("Connection failed: " . $mysqli->connect_error);
	}
	
	$username = $_SESSION['username'];
	$sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
	$result = $mysqli->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  $row = $result->fetch_assoc();
	} else {
	  echo "Geen gebruiker gevonden";
	}

	$sql2 = "SELECT * FROM events ORDER BY event_id DESC LIMIT 1 ";
	$result2 = $mysqli->query($sql2);

	if ($result2->num_rows > 0) {
	  // output data of each row
	  $row2 = $result2->fetch_assoc();
	} else {
	  echo "Geen event gevonden";
	}

	$sql3 = "SELECT * FROM settings";
	$result3 = $mysqli->query($sql3);

	if ($result3->num_rows > 0) {
	  // output data of each row
	  $row3 = $result3->fetch_assoc();
	} else {
	  echo "Geen settings gevonden";
	}

// Global vars# //
// USERS# //
$id = $row['id'];
$hashed_id = $row['hashed_id'];
$username = $row['username'];
$firstname = $row['firstname'];
$lastname = $row['lastname'];
$email = $row['email'];
$password = $row['password'];
$confirm_password = $row['password'];
$user_status = $row['user_status'];
$finance = $row['finance'];
$role = $row['role'];
$player_type = $row['player_type'];
$email_updates = $row['email_updates'];
if($role=='1') $is_admin = true;
// EVENTS# //
$lasteventid = $row2['event_id'];
// SETTINGS# //
$finance_popup = $row3['finance_popup'];
if($finance_popup=='1') $finance_popup_true = true;
$finance_threshold_amount = $row3['finance_threshold_amount'];
$booking_block = $row3['booking_block'];
if($booking_block=='1') $booking_block = true;
?>