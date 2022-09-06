<?php include('../config/constants.php');
	  include('login-check.php');
?>

<?php

//1. Get the ID of Order to be deleted
$id = $_GET['id'];
//2.Create SQL Query to delete admin

$sql = "DELETE FROM tbl_eipay WHERE id=$id";

//Execute the query

$res = mysqli_query($conn, $sql);

//Check whether the query executed succesfully or not

if($res == true){
    //Query executed successfully and admin deleted
    //echo "Order Deleted";
    //Create Session varibale to display message 

    $_SESSION['delete'] = "<div class='success'>Order Deleted Successfully</div>";

    //Redirecting to Admin Panel Page

    header('location:'.SITEURL.'admin/manage-ei-order.php');
}
else{
    //Failed to delete admin
    //echo "Failed to Delete Admin";

    $_SESSION['delete'] = "<div class='error'>Failed to Delete Order</div>";
    header('location:'.SITEURL.'admin/manage-ei-order.php');
}

//3. Redirect to manage admin page with message(Succuess/error)



?>