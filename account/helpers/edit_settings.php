<?php
include_once('db.php');

$settings_id = $_POST['settings_id'];
$finance_popup = $_POST['finance_popup'];
$finance_threshold_amount = $_POST['finance_threshold_amount'];
$booking_block = $_POST['booking_block'];

ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');
error_reporting(E_ALL);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if ($stmt = $mysqli->query("UPDATE settings SET finance_popup='$finance_popup', finance_threshold_amount='$finance_threshold_amount', booking_block='$booking_block' WHERE settings_id='$settings_id'")) {
    header("location: /account/settings.php?eventSuccessUpdated");
}
mysqli_stmt_close($stmt);
$mysqli->close();
?>