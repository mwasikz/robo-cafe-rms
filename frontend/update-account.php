<?php include('config/constants.php'); ?> 

<?php 
 date_default_timezone_set('Asia/Dhaka');
 if(!isset($_SESSION['user'])) //If user session is not set
{
    //User is not logged in
    //Redirect to login page with message

    $_SESSION['no-login-message'] = "<div class='error'>Please login to access Admin Panel</div>";
    header('location:'.SITEURL.'login.php');
}

    if(isset($_SESSION['user']))
    {
       $username = $_SESSION['user'];

       $fetch_user = "SELECT * FROM tbl_users WHERE username = '$username'";

       $res_fetch_user = mysqli_query($conn, $fetch_user);

       while($rows=mysqli_fetch_assoc($res_fetch_user))
       {
           $id = $rows['id'];
           $name = $rows['name'];
           $email = $rows['email'];
           $add1 = $rows['add1'];
           $city = $rows['city'];
           $phone = $rows['phone'];
           $username = $rows['username'];
           $password = $rows['password'];

       }
    }
?>

    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Robo Cafe - Categories</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" 
      type="image/png" 
      href="img/logo_ntx.png">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="<?php echo SITEURL; ?>" class="navbar-brand p-0">
                    
                    <img src="img/logo_new.png" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="about.php" class="nav-item nav-link">About</a>
                        <a href="categories.php" class="nav-item nav-link active">Categories</a>
                        <a href="menu.php" class="nav-item nav-link">Menu</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                             
                                <a href="team.php" class="dropdown-item">Our Team</a>
                                <a href="testimonial.php" class="dropdown-item">Testimonial</a>
                            </div>
                        </div>
                        <a href="contact.php " class="nav-item nav-link">Contact</a>
                    </div>

                    <?php
                        if(isset($_SESSION['user']))
	                    {
                            $username = $_SESSION['user'];
                            
                            ?>
                            <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><?php echo $username; ?></a>
                            <div class="dropdown-menu m-0">
                           <a href="myaccount.php" class="dropdown-item">My Account</a>
                            <a href="logout.php" class="dropdown-item">Logout</a>
                        </div>
                        </div>
                            <?php
	                    }
                        else
                        {
                            ?>
                            <a href="login.php" class="nav-item nav-link">Login</a>
                            <?php
                            
                        }
                        ?>

                     <?php
                        $count=0;
                        if(isset($_SESSION['cart']))
                        {
                            $count=count($_SESSION['cart']);
                        }
                    
                    ?>
                    <a href="mycart.php" class="btn btn-primary py-2 px-4"><i class="fas fa-shopping-cart"></i><span> Cart <?php echo $count; ?></span></a>
                </div>
            </nav>

           <div class="container-xxl py-5 bg-dark hero-header mb-1">
                <div class="container text-center my-2 pt-4 pb-1">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Edit Profile</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="myaccount.php">My Account</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Edit Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <div class="container bootstrap snippets bootdey">
<div class="row">
  <div class="profile-info col-md-9">
   
      <div class="panel">

      	<div class="table-data">
			<div class="order">
			<div class="head">

        <form action="" method="POST">


        <table class="rtable">
            <tr>
                <td>Name</td>
                <td>
                    <input type="text" name="cus_name" value="<?php echo $name; ?>" id="ip2">
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <input type="text" name="cus_email" value="<?php echo $email; ?>" id="ip2">
                </td>
            </tr>
              <tr>
                <td>Address</td>
                <td>
                    <textarea name="cus_add1" cols="30" rows="5"><?php echo $add1; ?></textarea id="ip2">
                </td>
            </tr>
              <tr>
                <td>City</td>
                <td>
                    <input type="text" name="cus_city" value="<?php echo $city; ?>" id="ip2">
                </td>
            </tr>
              <tr>
                <td>Phone</td>
                <td>
                    <input type="text" name="cus_phone" value="<?php echo $phone; ?>" id="ip2">
                </td>
            </tr>

            <tr>
                <td >
                    <input type="hidden" name="username" value="<?php echo $username; ?>">
                    <input type="submit" name="submit" value="Update" class="btn btn-primary btn-lg">
                </td>
            </tr>

        </table>

        </form>

        <?php

    if(isset($_POST['submit']))
    {

     $username = $_POST['username'];
     $cus_name = $_POST['cus_name'];
     $cus_email = $_POST['cus_email'];
     $cus_add1 = $_POST['cus_add1'];
     $cus_city = $_POST['cus_city'];
     $cus_phone = $_POST['cus_phone'];

     $update_account = "UPDATE tbl_users SET
     name = '$cus_name',
     email = '$cus_email',
     add1 = '$cus_add1',
     city = '$cus_city',
     phone = '$cus_phone'
     WHERE username='$username'
     ";


     $res_update_account = mysqli_query($conn, $update_account);
     if($res_update_account == true)
     {
         $_SESSION['update'] = "<div class='success'>Account Updated Successfully</div>";

         header('location:'.SITEURL.'myaccount.php');
     }
     else
     {
        $_SESSION['update'] = "<div class='error'>Failed to Update Account</div>";

         header('location:'.SITEURL.'myaccount.php');
         
     }

}
?>
	</div>
    </div>
</div>
          
      </div>
  </div>
</div>
</div>



 
        <!-- Categories End  -->
        

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Company</h4>
                        <a class="btn btn-link" href="">About Us</a>
                        <a class="btn btn-link" href="">Contact Us</a>
                        <a class="btn btn-link" href="">Reservation</a>
                        <a class="btn btn-link" href="">Privacy Policy</a>
                        <a class="btn btn-link" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Contact</h4>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Banani, Dhaka, Bangladesh</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>01717731002</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Opening</h4>
                        <h5 class="text-light fw-normal">Monday - Saturday</h5>
                        <p>09AM - 09PM</p>
                        <h5 class="text-light fw-normal">Sunday</h5>
                        <p>10AM - 08PM</p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Newsletter</h4>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control border-primary w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                            <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Robo Cafe</a>, All Right Reserved. 
							
							
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
