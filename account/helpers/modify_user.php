<?php
include_once('db.php');

$id = $_POST['id'];
$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$role = $_POST['role'];
$finance = $_POST['finance'];
$user_status = $_POST['user_status'];

ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');
error_reporting(E_ALL);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if ($stmt = $mysqli->query("UPDATE users SET username='$username', firstname='$firstname', lastname='$lastname', email='$email', role='$role', finance='$finance', user_status='$user_status' WHERE id='$id'")) {
    header("location: /account/users.php");
}
mysqli_stmt_close($stmt);
$mysqli->close();
?>