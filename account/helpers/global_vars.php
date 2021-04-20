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


// Global vars# //
$id = $row['id'];
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
?>