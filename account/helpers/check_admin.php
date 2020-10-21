<?php

// If you are not an admin it will redirect to your dashboard
if(!isset($is_admin) || empty($is_admin)){
  header("location: /account/dashboard.php");
  exit;
}
?>