
<?php 
include('config/constants.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login-front.css">
    <link rel="icon" 
      type="image/png" 
      href="img/logo_ntx.png">

    <title>Registration</title>
</head>
<body>


        <!-- Login Form -->
<div class="container">
  <div class="brand-title">Registration</div>
  
  <form action="" class="inputs" method="POST" name="form1">
    <label>Name</label>
    <input type="text" placeholder="" name="name" required>
    <label>Email ID</label>
    <input type="email" name="email" required>
    <label>Address</label>
    <input type="text" name="add1" required>
    <label>City</label>
    <input type="text" name="city" required>
    <label>Phone</label>
    <input type="number" name="phone" required>
    <label>Username</label>
    <input type="text" name="username" required>
    <label>Password</label>
    <input type="password" name="password" required>

    <br>
    
    <button type="submit" name="create_account" value="create_account">Create Account</button>  
  </form>
</div>

</body>
</html>

<?php 
    if(isset($_POST['create_account']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $add1 = $_POST['add1'];
        $city = $_POST['city'];
        $phone = $_POST['phone'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //md5 encryption

        $check_duplicate = "SELECT username FROM tbl_users
						    WHERE username = '$username'";
	      $res_check_duplicate = mysqli_query($conn, $check_duplicate);

        $rows_check_duplicate = mysqli_num_rows($res_check_duplicate);
	      if($rows_check_duplicate>0)
	      {
		      echo "<script>
                alert('Username already exists! Try a different username.'); 
                window.location.href='register.php';
                </script>";
	      }
	    else
	    {
	  	$sql = "INSERT INTO tbl_users SET
        name='$name',
        email = '$email',
        add1 = '$add1',
        city = '$city',
        phone = '$phone',
        username='$username',
        password='$password'
    	";

        $res = mysqli_query($conn, $sql);

        echo "<script>
                alert('Account Created'); 
                window.location.href='login.php';
                </script>";

                
	}
    //header("location:".SITEURL.'login.php');

    }
?>