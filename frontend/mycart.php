<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Robo Cafe</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" 
      type="image/png" 
      href="../images/logo.png">

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
                   
                   <img src="../images/logo.png" alt="Logo"> 
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="about.php" class="nav-item nav-link">About</a>
                        <a href="categories.php" class="nav-item nav-link">Categories</a>
                        <a href="menu.php" class="nav-item nav-link">Menu</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                
                                <a href="team.php" class="dropdown-item active">Our Team</a>
                                <a href="testimonial.php" class="dropdown-item">Testimonial</a>
                            </div>
                        </div>
                        <a href="contact.php" class="nav-item nav-link">Contact</a>
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
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Cart</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                
            </div>

            <div class="col-lg-9 table-responsive">
                <table class="table" id="cart_table">
    <thead class="text-center">
    <tr>
    <th scope="col">S.N.</th>
    <th scope="col">Item Name</th>
    <th scope="col">Price</th>
    <th scope="col">Quantity</th>
    <th scope="col">Sub Total</th>
    <th scope="col"></th>
    </tr>
    </thead>
<tbody class="text-center">
    <?php 
    
    $item_price = 0;
    $total_amount = 0;
    
    if(isset($_SESSION['cart']))
    {

        foreach($_SESSION['cart'] as $key => $value)
            {
                $item_price = $value['Price']*$value['Quantity'];
                $total_amount = $total_amount + $item_price;
                
                

                $sn=$key+1;
              

            echo"

            <tr>
                <td>$sn</td>
                <td>$value[Item_Name]</td>
                <td>$value[Price]<input type='hidden' class='iprice' value='$value[Price]'></td>
                <td>
                    <form action='manage-cart.php' method='POST'>
                    <input class='text-center iquantity' name='Mod_Quantity' onchange='this.form.submit();' type='number' value='$value[Quantity]' min = '1' max = '20'>
                    <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                    </form>
                </td>
                <td class='itotal'></td>
                <td>
                    <form action='manage-cart.php' method='POST'>
                <button name='Remove_Item' class='btn btn-danger btn-sm'>REMOVE</button>
                    <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                    </form>
                </td>
        </tr>

                ";
            }
    }

    ?>
    
</tbody>
</table>
        </div>

           
            

        <div class="col-lg-3">
            <div class="border bg-light rounded p-4">
                <h4 class="text-center">Total</h4>
                <h2 class="text-center" id="gtotal"></h2>
                
                
                <br>

                <?php
                if(isset($_SESSION['user']))
                {
                    $username = $_SESSION['user'];

                    $fetch_user = "SELECT * FROM tbl_users WHERE username = '$username'";
                    $res_fetch_user = mysqli_query($conn, $fetch_user);
                     while($rows=mysqli_fetch_assoc($res_fetch_user))
                     {
                        $username = $rows['username'];
                        $cus_name = $rows['name'];
                        $cus_email = $rows['email'];
                        $cus_add1 = $rows['add1'];
                        $cus_city = $rows['city'];
                        $cus_phone = $rows['phone'];
                        
                     }

                    if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0)
                    {
                        
                
                ?>

                <?php
                error_reporting(0);
                date_default_timezone_set('Asia/Dhaka');
                //Generate Unique Transaction ID
                function rand_string( $length ) {
	            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

	            $size = strlen( $chars );
	            for( $i = 0; $i < $length; $i++ ) {
		        $str .= $chars[ rand( 0, $size - 1 ) ];
	            }

	            return $str;
                }
                $cur_random_value=rand_string(10);

                ?> 


            <form action="purchase.php" method="POST">
            <div class="form-group"> 
                <input type="hidden" name="amount" value="<?php echo $total_amount;?>" class="form-control" >
            </div>
            <div class="form-group"> 
                <input type="hidden" name="tran_id" value="ONL-PAY-<?php echo "$cur_random_value"; ?>" class="form-control" >
            </div>
            <div class="form-group">
                <h4 class="text-center">Delivery Address</h4>
            </div>
            <div class="form-group">
                <label><?php echo $cus_name; ?></label>
                <input type="hidden" name="cus_name" value="<?php echo $cus_name; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label><?php echo $cus_email; ?></label>
                <input type="hidden" name="cus_email" value="<?php echo $cus_email; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label><?php echo $cus_add1; ?></label>
                <input type="hidden" name="cus_add1" value="<?php echo $cus_add1; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label><?php echo $cus_city; ?></label>
                <input type="hidden" name="cus_city" value="<?php echo $cus_city; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label><?php echo $cus_phone ?></label>
                <input type="hidden" name="cus_phone" value="<?php echo $cus_phone; ?>" class="form-control" min='1' required>
            </div>
            <div class="form-group">
                
                <input type="hidden" name="payment_status" value="pending" class="form-control">
            </div>
            <div class="form-group">
                
                <input type="hidden" name="username" value="<?php echo $username; ?>" class="form-control">
            </div>

            <br>
              <a href="update-account.php">Change Shipping Address</a>
              <br>
              <br>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pay_mode" value="amrpay" id="flexRadioDefault1" required>
                    <label class="form-check-label" for="flexRadioDefault1">
                    Pay With AAMARPAY
                    </label>
                </div>
                <br>

                <!-- Creating Session Variables --->
                 <?php

                  $_SESSION['amount']=$total_amount;
                 ?>
               
                <!-- Creating Session Variables --->
               
                  

                <div class="d-grid gap-2 col-12 mx-auto">
                <button class="btn btn-primary btn-lg" name="purchase">Checkout</button>
                </form>
                <?php
                        
                        
                
                    }
                }
                else
                {
                    echo "Please login to place order";
                    ?>
                    <a href="login.php">Login</a>
                    <?php

                   
                }
                ?>
            
          
                </div>
            </div>
        </div>

        </div>

    </div>

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

    <script>
        var gt=0;
        var iprice=document.getElementsByClassName('iprice');
        var iquantity=document.getElementsByClassName('iquantity');
        var itotal=document.getElementsByClassName('itotal');
        var igtotal=document.getElementById('gtotal');

        function subTotal()
        {
            gt=0;
            for(i=0;i<iprice.length;i++)
            {
                itotal[i].innerText=(iprice[i].value)*(iquantity[i].value);

                gt=gt+(iprice[i].value)*(iquantity[i].value);
            }
            gtotal.innerText=gt;
        }

        subTotal();


    </script>
</body>

</html>