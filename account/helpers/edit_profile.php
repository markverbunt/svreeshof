<?php
include_once('db.php');

$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$id = $_POST['id'];

ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');
error_reporting(E_ALL);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if ($stmt = $mysqli->query("UPDATE users SET username='$username', firstname='$firstname', lastname='$lastname', email='$email' WHERE id='$id'")) {
    header("location: /account/dashboard.php");
}
mysqli_stmt_close($stmt);
$mysqli->close();
?>