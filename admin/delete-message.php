<?php 

//Including the constant file

include('../config/constants.php');
include('login-check.php');




$id = $_GET['id'];
$sql = "DELETE FROM message WHERE id=$id";

$res = mysqli_query($conn, $sql);


if($res == true){
    
   $_SESSION['delete'] = "<div class='success'>Message Deleted Successfully</div>";

    header('location:'.SITEURL.'admin/messages.php');
}
else{

    $_SESSION['delete'] = "<div class='error'>Failed to Delete Message</div>";
    header('location:'.SITEURL.'admin/messages.php');
}


?>