<?php include('config/constants.php'); ?>

<?php

if($_SERVER['REQUEST_METHOD']=="POST"){

    // $paystatus=$_POST['pay_status'];
    // $amount=$_POST['amount'];
    
    //you can get all parameter from post request
    //print_r($_POST);

    //mer_txnid , amount_original, pay_status, pay_time
    
    $tran_id = $_POST['mer_txnid'];
    $amount = $_POST['amount_original'];
    $status = $_POST['pay_status'];
    $pay_time = $_POST['pay_time'];
    $customer_name = $_POST['cus_name'];
    $card_type = $_POST['card_type'];

    
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

<div class="container">
  <div class="brand-logo"></div>
  <div class="brand-title">Robo Cafe</div>


  
  <?php 


 
    
      $_SESSION['fail'] = "Your Payment of BDT " .$amount. " failed"."<br>Please Try Again";
      header('location:'.SITEURL.'payment-fail-redir.php'); 

  
  ?>
  
  
  
</div>

</body>
</html>
