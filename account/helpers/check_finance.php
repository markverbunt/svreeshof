<?php

// If you are not an admin it will redirect to your dashboard
if(!isset($is_finance) || empty($is_finance)){
  header("location: /account/dashboard.php");
  exit;
}
?>