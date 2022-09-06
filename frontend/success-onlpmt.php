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


        $sql = "INSERT INTO aamarpay SET
        cus_name='$customer_name',
        amount='$amount',
        status = '$status',
        pay_time = '$pay_time',
        transaction_id = '$tran_id',
        card_type = '$card_type'

    ";
    $res = mysqli_query($conn, $sql) or die(mysqli_error());
    
    if($res == true)
    { 
      $_SESSION['success'] =  "Dear ".$customer_name. ", Your Payment of BDT " .$amount. " is Successful."."<br/> Transaction ID: ".$tran_id;
      header('location:'.SITEURL.'payment-redir.php');
    }
    else
    {
      $_SESSION['fail'] = "Your Payment of BDT " .$amount. " is Not Successful."."<br/> Transaction ID: ".$tran_id ."Please Try Again";
      header('location:'.SITEURL.'index.php'); 
    }
    
  
  ?>
  
  
  
</div>

</body>
</html>
