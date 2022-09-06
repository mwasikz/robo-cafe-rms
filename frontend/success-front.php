<?php include('config/constants.php'); ?>

<?php

if($_SERVER['REQUEST_METHOD']=="POST"){

    // $paystatus=$_POST['pay_status'];
    // $amount=$_POST['amount'];
    
    //you can get all parameter from post request
   // print_r($_POST);

    //mer_txnid , amount_original, pay_status, pay_time
  

    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="css/eipay.css">
    <link rel="icon" 
      type="image/png" 
      href="img/logo_ntx.png">
    
</head>
<body>
  <?php
    $tran_id = $_POST['mer_txnid'];
    $amount = $_POST['amount_original'];
    $status = $_POST['pay_status'];
    $pay_time = $_POST['pay_time'];
    $cus_name = $_POST['cus_name'];
    $cus_email = $_POST['cus_email'];
    $cus_phone = $_POST['cus_phone'];
    

    ?>

<div class="container">
  <div class="brand-logo"></div>
  <div class="brand-title">Robo Cafe</div>
  
  <form action="" class="inputs" method="POST" name="form1">
    <p>Hello, <?php echo $cus_name; ?>.
    <p>Your Payment of <?php echo $amount; ?> is successful. </p>
    <p>Transaction ID: <?php echo $tran_id; ?> </p>
    <p>Time of Payment: <?php echo $pay_time; ?></p>    

    
  </form>
  <?php 


        $sql = "INSERT INTO tbl_order SET
        total='$amount',
        transaction_id = '$tran_id',
        
        order_date = '$pay_time',
        status = '$status',
        customer_name = '$cus_name',
        customer_contact = '$cus_phone',
        customer_email = '$cus_email'


    
    ";
    $res = mysqli_query($conn, $sql) or die(mysqli_error());
    
    if($res == true)
    { 
      $_SESSION['success'] = "Hello, " .$cus_name. ". Your Payment of BDT " .$amount. " is Successful."."<br/> Transaction ID: ".$tran_id. ". Time of Payment: ".$pay_time;
      header('location:'.SITEURL.'payment-redir-front.php');
    }
    else
    {
      $_SESSION['fail'] = "Your Payment of BDT " .$amount. " is Not Successful."."<br/> Transaction ID: ".$tran_id ."Please Try Again";
      header('location:'.SITEURL); 
    }
    
  
  ?>
  <button class="btn-secondary">Homepage</button>
</div>

</body>
</html>