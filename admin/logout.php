<?php 
include('../frontend/config/constants.php');
//session_destroy();
unset($_SESSION['user-admin']);
header('location:'.SITEURL.'login.php');
?>