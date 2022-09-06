
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

    <title>Login</title>
</head>
<body>


        <!-- Login Form -->
<div class="container">
  <div class="brand-logo"></div>
  <div class="brand-title">User Login</div>
  
  <form action="" class="inputs" method="POST" name="form1">
    <label>Username</label>
    <input type="text" placeholder="" name="username" required>
    <label>Password</label>
    <input type="password" name="password">
    <br>
   
        Don't Have an account?
        <br>
        <a href="register.php">Create Account</a>
    
    <button type="submit" name="submit" value="login">Login</button>  
  </form>
</div>



</body>
</html>

<?php 
    if(isset($_POST['submit']))
    {

       // $username = $_POST['username'];
       // $password = md5($_POST['password']); //md5 encryption

       //Preventing From SQL Injection

       $username = mysqli_real_escape_string($conn, $_POST['username']);
       $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        $sql = "SELECT * FROM tbl_users WHERE username='$username' AND password='$password'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            //User found, login success
            $_SESSION['login']  = "<div class='success'>Login Successful</div>";
            $_SESSION['user'] = $username;
         
            header('location:'.SITEURL.'index.php');
        }
        else
        {
          echo "<script>
                alert('Wrong Username or Password'); 
                window.location.href='login.php';
                </script>";
        
        }
      }

?>