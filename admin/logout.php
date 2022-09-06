<?php 
include('../config/constants.php');
//session_destroy();
unset($_SESSION['user-admin']);
header('location:'.SITEURL.'admin/login.php');
?>