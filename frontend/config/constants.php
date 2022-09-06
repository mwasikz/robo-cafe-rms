<?php 

//Starting the Session
ob_start();

session_start();

//Creating constant to store non repeating values
define('SITEURL', 'http://192.168.0.103/projects/Robo_Cafe_RMS/');

define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'new-food-order');



    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
    
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //Selecting Database

?>