<?php
include_once('db.php');

ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');
error_reporting(E_ALL);


if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$password = $_POST['password'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if ($stmt = $mysqli->query("UPDATE users SET password='$hashed_password' WHERE id='$_POST[id]'")) {
}
$mysqli->close();
?>