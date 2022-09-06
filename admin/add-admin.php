<?php include('../config/constants.php');
	  include('login-check.php');

$ei_order_notif = "SELECT order_status from tbl_eipay
				   WHERE order_status='Pending' OR order_status='Processing'";

$res_ei_order_notif = mysqli_query($conn, $ei_order_notif);

$row_ei_order_notif = mysqli_num_rows($res_ei_order_notif);

$online_order_notif = "SELECT order_status from order_manager
					   WHERE order_status='Pending'OR order_status='Processing' ";

$res_online_order_notif = mysqli_query($conn, $online_order_notif);

$row_online_order_notif = mysqli_num_rows($res_online_order_notif);

$stock_notif = "SELECT stock FROM tbl_food
				WHERE stock<50";

$res_stock_notif = mysqli_query($conn, $stock_notif);
$row_stock_notif = mysqli_num_rows($res_stock_notif);

//Message Notification
$message_notif = "SELECT message_status FROM message
				  WHERE message_status = 'unread'";
$res_message_notif = mysqli_query($conn, $message_notif);
$row_message_notif = mysqli_num_rows($res_message_notif);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="style-admin.css">
	<link rel="icon" 
      type="image/png" 
      href="img/logo_ntx.png">

	<title>Robo Cafe Admin</title>
</head>
<body>


	
<section id="sidebar">
	<a href="index.php" class="brand">
		<img src="img/logo.png" width="190px" alt="">
	</a>
		<ul class="side-menu top">
			<li >
				<a href="index.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="active">
				<a href="manage-admin.php">
					<i class='bx bxs-group' ></i>
					<span class="text">Admin Panel</span>
				</a>
			</li>
			<li>
				<a href="manage-online-order.php">
					<i class='bx bxs-cart'></i>
					<span class="text">Online Orders&nbsp;</span>
						<?php 
					if($row_online_order_notif>0)
					{
						?>
						<span class="num-ei"><?php echo $row_online_order_notif; ?></span>
						<?php
					}
					else
					{
						?>
						<span class=""> </span>
						<?php
					}
					?>
				</a>
			</li>
			<li>
				<a href="manage-ei-order.php">
					<i class='bx bx-qr-scan'></i>
					<span class="text" >Eat In Orders&nbsp;&nbsp;&nbsp;
						
					</span>
					<?php 
					if($row_ei_order_notif>0)
					{
						?>
						<span class="num-ei"><?php echo $row_ei_order_notif; ?></span>
						<?php
					}
					else
					{
						?>
						<span class=""> </span>
						<?php
					}
					?>
					
				</a>
			</li>
			<li>
				<a href="manage-category.php">
					<i class='bx bxs-category'></i>
					<span class="text">Category</span>
				</a>
			</li>
			<li>
				<a href="manage-food.php">
					<i class='bx bxs-food-menu'></i>
					<span class="text">Food Menu</span>
				</a>
			</li>
			<li class="">
				<a href="inventory.php">
					<i class='bx bxs-box'></i>
					<span class="text">Inventory</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<section id="content">
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link"></a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<div class="fetch_message">
				<div class="action_message notfi_message">
					<a href="messages.php"><i class='bx bxs-envelope' ></i></a>
					<?php 

					if($row_message_notif>0)
					{
						?>
						<span class="num"><?php echo $row_message_notif; ?></span>
						<?php
					}
					else
					{
						?>
						<span class=""></span>
						<?php

					}
					?>
					
				</div>
					
</div>
<div class="notification" >
<div class="action notif">
	<i class='bx bxs-bell' onclick= "menuToggle();"></i>
		<div class="notif_menu">
		<ul><?php 
							
		if($row_stock_notif>0 and $row_stock_notif !=1 )
		{
		?>
		<li><a href="inventory.php"><?php echo $row_stock_notif ?>&nbsp;Items are running out of stock</li></a>
		<?php
		}
		else if($row_stock_notif == 1)
		{
		?>
		<li><a href="inventory.php"><?php echo $row_stock_notif ?>&nbsp;Item is running out of stock</li></a>
		<?php
		}
		
		if($row_ei_order_notif>0)
		{
		?>
		<li><a href="manage-online-order.php"><?php echo $row_online_order_notif ?>&nbsp;New Online Order</li></a>
		<?php

		}
		if($row_online_order_notif>0)
		{
		?>
		<li><a href="manage-ei-order.php"><?php echo $row_ei_order_notif ?>&nbsp;New Eat In Order</li></a>
		<?php

		}
		?>
		</ul>
		</div>
		<?php 
		if($row_stock_notif>0 || $row_online_order_notif>0 || $row_ei_order_notif>0)
		{
		  $total_notif = $row_online_order_notif+$row_ei_order_notif+$row_stock_notif;
		?>
		  <span class="num"><?php echo $total_notif; ?></span>
		<?php
		}
		else
		{
		?>
		 <span class=""></span>
		 <?php
		}
		?>
		</a>
		</div>
		</div>
		</nav>
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Add Admin</h1>
					<ul class="breadcrumb">
						<li>
							<a href="index.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="manage-admin.php">Admin Panel</a>
						</li>
						<li>
							<a class="active" href="add-admin.php">Add Admin</a>
						</li>
					</ul>
					 <?php
    
    					if(isset($_SESSION['add']))
						{ 
        					echo $_SESSION['add']; 
        					unset($_SESSION['add']);
    					}
    				?>
				</div>	
			</div>
		<br>
		<div class="table-data">
			<div class="order">
			<div class="head">	 

		<form action="" method="POST">
        <table class="rtable-center">
            <tr>
                <td>Full Name</td>
                <td><input type="text" name="full_name" id="ip2" required></td>

            </tr>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" id="ip2" required></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" id="ip2" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="button-8" role="button">
                </td>
            </tr>

        </table>

    </form>
			</div>
		</div>
	</div>	
		</main>
	</section>
<script src="script-admin.js"></script>
</body>
</html>

<?php 
if(isset($_POST['submit']))
	{
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //md5 encryption

	$check_duplicate = "SELECT username FROM tbl_admin
						WHERE username = '$username'";
	$res_check_duplicate = mysqli_query($conn, $check_duplicate);

	$rows_check_duplicate = mysqli_num_rows($res_check_duplicate);
	if($rows_check_duplicate>0)
	{
		echo "<script>
                alert('Username already exists! Try a different username.'); 
                window.location.href='add-admin.php';
                </script>";
	}
	else
	{
		$sql = "INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
    	";
	}

    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    if($res == true)
	{

        $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
        header("location:".SITEURL.'admin/manage-admin.php');

    }
    else
	{
        $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
        header("location:".SITEURL.'admin/add-admin.php');
    }

}

?>
