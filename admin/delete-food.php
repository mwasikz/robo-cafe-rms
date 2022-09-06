<?php include('../config/constants.php');
	  include('login-check.php');
	  error_reporting(0);
      @ini_set('display_errors', 0);

?>

<?php

if(isset($_GET['id']) && isset($_GET['image_name']))
{
    //Proceed to delete
    //echo "Proceed to Delete";

    //1. Get ID and Image Name

    $id = $_GET['id']; //GET method used because id passed by URL
    $image_name = $_GET['image_name'];

    //2. Remove the image if available

    //Check whether the image is available or not and Delete if only available

    if($image_name != "")
    {
        //Image name not empty so image is available
        //Getting the Image path

        $path = "../images/food/".$image_name;

        //Remove image file from folder

        $remove = unlink($path);

        //Check whether the image is removed or not

        if($remove == false)
        {
            //Failed to remove image
            $_SESSION['upload'] = "<div class='error text-center'>Failed to Remove Image</div>";
            //Redirect to Manage Food page
            header('location:'.SITEURL.'admin/manage-food.php');

            //Stop the process

            die();

        }
    }

    //3. Delete Food from database

    //Creating SQL Query
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    //Executing the Query

    $res = mysqli_query($conn, $sql);
    //4. Redirect to Manage Food page with session message

    //Check whether the query is executed or not nad set session message
    if($res == true)
    {
        //Food Deleted
        $_SESSION['delete'] = "<div class='success text-center'>Food Deleted Successfully</div>";
            //Redirect to Manage Food page
            header('location:'.SITEURL.'admin/manage-food.php');
    }
    else
    {
        //Failed to delete food
        $_SESSION['delete'] = "<div class='error text-center'>Failed to Delete Food</div>";
            //Redirect to Manage Food page
            header('location:'.SITEURL.'admin/manage-food.php');
    }



    



}
else
{
    //Redirect to Manage Food Page
    //echo "Redirect";
    $_SESSION['unauthorized'] = "<div class='error text-center'>Unauthorized Access</div>";
    header('location:'.SITEURL.'admin/manage-food.php');

}





 ?>