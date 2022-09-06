<?php include('../config/constants.php');
	  include('login-check.php');

?>
<?php 

//Stats

$sales_by_hour = "SELECT HOUR(pay_time) as hname,
					sum(amount) as total_sales
					FROM aamarpay
					GROUP BY HOUR(pay_time)";
					 

$res_sales_by_hour = mysqli_query($conn, $sales_by_hour);

$most_sold_items = "SELECT sum(Quantity) as total_qty,
							Item_Name as item_name
							FROM online_orders_new
							GROUP BY Item_Name
							";
$res_most_sold_items = mysqli_query($conn, $most_sold_items);

//Orders

$ei_order_notif = "SELECT order_status from tbl_eipay
					WHERE order_status='Pending' OR order_status='Processing'";

$res_ei_order_notif = mysqli_query($conn, $ei_order_notif);

$row_ei_order_notif = mysqli_num_rows($res_ei_order_notif);

$online_order_notif = "SELECT order_status from order_manager
					WHERE order_status='Pending'OR order_status='Processing' ";

$res_online_order_notif = mysqli_query($conn, $online_order_notif);

$row_online_order_notif = mysqli_num_rows($res_online_order_notif);

// Stock Notification
$stock_notif = "SELECT stock FROM tbl_food
				WHERE stock<50";

$res_stock_notif = mysqli_query($conn, $stock_notif);
$row_stock_notif = mysqli_num_rows($res_stock_notif);

// Revenue Generated
$revenue = "SELECT SUM(total_amount) AS total_amount FROM order_manager
			WHERE order_status='Delivered' ";
$res_revenue = mysqli_query($conn, $revenue);
$total_revenue = mysqli_fetch_array($res_revenue);

//Total Orders Delivered

$orders_delivered = "SELECT order_status FROM order_manager
					 WHERE order_status='Delivered'";
$res_orders_delivered = mysqli_query($conn, $orders_delivered);
$total_orders_delivered = mysqli_num_rows($res_orders_delivered);

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

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="style-admin.css">
	<link rel="icon" 
      type="image/png" 
      href="img/logo_ntx.png">

	<!-- Chart ---> 
		
	
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
	
        var data = google.visualization.arrayToDataTable([
          ['Item Name', 'Sales'], 
          <?php
		  //while($row_sales=mysqli_fetch_array($res_sales_by_month))
		  while($row_sales=mysqli_fetch_array($res_most_sold_items))
		  {
			  echo "['".$row_sales["item_name"]."', ".$row_sales["total_qty"]."],";
		  }

		  ?>
		
          ]);
		   
		  
        var options = {
          title: 'Most Sold Items',
          pieHole: 0.4,
		  fontName: 'Poppins',
		  fontSize: 12,
		  //is3D:true,
		  titleTextStyle: { color: "Grey",
  							fontName: "Poppins",
  							fontSize: 16,
  							bold: false,
  							italic: false },
		 

        };

		 


        var chart = new google.visualization.PieChart(document.getElementById('donutchart_msi'));
        chart.draw(data, options);

		
      }
	  
	
	 
    </script>

	<!-- Chart End --> 

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Time' , 'Sales'],
		   <?php
		  //while($row_sales=mysqli_fetch_array($res_sales_by_month))
		  while($row_sales_by_hour=mysqli_fetch_array($res_sales_by_hour))
		  {
			  echo "['".$row_sales_by_hour["hname"]."', ".$row_sales_by_hour["total_sales"]."],";
		  }

		  ?>
		
          
        ]);

        var options = {
			hAxis: {title: 'Time', titleTextStyle: {color: 'Black'}},
      		colors: ['#eb2f06','green'],
			
          chart: {
            title: 'Sales By Hour',
			
			

            
          } 
		  
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
	

	<title>Robo Cafe Admin</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="index.php" class="brand">
			<img src="img/logo.png" width="190px" alt="">
		</a>
		<ul class="side-menu top">
			<li class="">
				<a href="index.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="manage-admin.php">
					<i class='bx bxs-group' ></i>
					<span class="text">Admin Panel</span>
				</a>
			</li>
			<li>
				<a href="manage-online-order.php">
					<i class='bx bxs-cart'></i>
					<span class="text">Online Orders &nbsp;</span>
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
					<span class="text" >Eat In Orders &nbsp;&nbsp;&nbsp;
						
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
	<!-- SIDEBAR -->

	


	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
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
			
			<div class="notification" onclick= "menuToggle();">
				<div class="action notif" onclick= "menuToggle();">
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
							else
							{
								
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
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
		

			<div class="table-data-message">
				<div class="order">
					<div class="">
						
						
					</div>
					<table>
					
						<?php
                    
                    $sql = "SELECT * FROM message ORDER BY date DESC";
					$res = mysqli_query($conn, $sql);

                    if($res == TRUE)
					{
					 $count = mysqli_num_rows($res); 

                        if($count>0)
						{
                           while($rows = mysqli_fetch_assoc($res))
						   {
							$id = $rows['id'];
                            $name = $rows['name'];
                            $phone = $rows['phone'];
                            $subject = $rows['subject'];
                            $message = $rows['message'];
                            $date = $rows['date'];
                            $message_status = $rows['message_status'];
                            ?> 
						<tbody>
                            <?php

                            if($message_status == 'read')
                            { ?>
                                <tr>
								<td><a href="<?php echo SITEURL; ?>admin/read-message.php?id=<?php echo $id; ?>" > <?php echo "$name"; ?></a></td>
								<td><a href="<?php echo SITEURL; ?>admin/read-message.php?id=<?php echo $id; ?>" > <?php echo "$subject"; ?></a></td>
                                <td><a href="<?php echo SITEURL; ?>admin/read-message.php?id=<?php echo $id; ?>" > <?php echo "$date"; ?></a></td>
								<td>
                        			<a href="<?php echo SITEURL; ?>admin/delete-message.php?id=<?php echo $id; ?>" class="button-7" role="button" >Delete</a>
									
                    			</td>
							</tr>
                            	<?php 
                            }
                            else
                            {
                                 ?>
                               <tr>
                                   <div class="unread_message">
								<td><a href="<?php echo SITEURL; ?>admin/read-message.php?id=<?php echo $id; ?>" > <?php echo "<span class='unread'>$name</span>"; ?></a></td>
								<td><a href="<?php echo SITEURL; ?>admin/read-message.php?id=<?php echo $id; ?>" > <?php echo "<span class='unread'>$subject</span>"; ?></a></td>
                                <td><a href="<?php echo SITEURL; ?>admin/read-message.php?id=<?php echo $id; ?>" > <?php echo "<span class='unread'>$date</span>"; ?></a></td>
								<td>
                        			<a href="<?php echo SITEURL; ?>admin/delete-message.php?id=<?php echo $id; ?>" class="button-7" role="button" >Delete</a>
                            </div>
                    			</td>
							</tr>
                            <?php
                            }
                        

						

						   }
						}
					}

					?>
						
						</tbody>
					</table>
				</div>
				
			</div>
		

	
		</main>
		
		
	
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
		

	<script src="script-admin.js"></script>

	
</body>
</html>