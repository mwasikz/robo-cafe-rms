<?php 

//Including the constant file

include('../config/constants.php');
include('login-check.php');




$id = $_GET['id'];
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//Execute the query

$res = mysqli_query($conn, $sql);

//Check whether the query executed succesfully or not

if($res == true){
    
   $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";

    header('location:'.SITEURL.'admin/manage-admin.php');
}
else{

    $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}

//3. Redirect to manage admin page with message(Succuess/error)



?>