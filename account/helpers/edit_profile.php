<?php
include_once('db.php');

$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$email_updates = $_POST['email_updates'];
$hashed_id = $_POST['hashed_id'];

ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');
error_reporting(E_ALL);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if ($stmt = $mysqli->query("UPDATE users SET username='$username', firstname='$firstname', lastname='$lastname', email='$email', email_updates='$email_updates' WHERE hashed_id='$hashed_id'")) {
    header("location: /account/dashboard.php");
}
mysqli_stmt_close($stmt);
$mysqli->close();
?>