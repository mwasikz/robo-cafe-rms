<?php include('config/constants.php');?>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eat in Payment</title>
    <link rel="stylesheet" href="css/eipay.css">
    <link rel="icon" 
      type="image/png" 
      href="img/logo_ntx.png">
    
</head>
<body>

<div class="container">
  <div class="brand-logo"></div>
  <div class="brand-title">ROBO CAFE</div>
  
  <form action="https://sandbox.aamarpay.com/index.php" class="inputs" method="POST" name="form1">
     <input type="hidden" name="store_id" value="aamarpay">
     <input type="hidden" name="signature_key" value="28c78bb1f45112f5d40b956fe104645a">
    
<tr>
    <td>Transaction ID:<br> </td>
    <td><input type="hidden" name="tran_id" value="EI-PAY-<?php echo "$cur_random_value"; ?>">EI-PAY-<?php echo "$cur_random_value"; ?></td>
</tr>
<br/><br/>

    <label>Enter Amount</label>
    <input type="number" placeholder="" name="amount" value="amount" required>
    <input type="hidden" name="currency" value="BDT">
    <label>Select Table ID<label>
    <select class="select-css" name="cus_name" required>
        <option value="Table 1">Table 1</option>
        <option value="Table 2">Table 2</option>
        <option value="Table 3">Table 3</option>
        <option value="Table 4">Table 4</option>
        <option value="Table 5">Table 5</option>
        <option value="Table 6">Table 6</option>
    </select>
    <input type="hidden" name="cus_fax" value="pending">
    <input type="hidden" name="cus_email" value="test@test.com">
    <input type="hidden" name="cus_add1" value="pending">
    <input type="hidden" name="cus_add2" value="Dhaka">
    <input type="hidden" name="cus_city" value="Dhaka">
    <input type="hidden" name="cus_state" value="Dhaka">
    <input type="hidden" name="cus_postcode" value="1206">
    <input type="hidden" name="cus_country" value="Bangladesh">
    <input type="hidden" name="cus_phone" value="Pending">
    <input type="hidden" name="desc" value="Products Name Payment">
    <input type="hidden" name="success_url" value="<?php echo SITEURL; ?>success.php">
    <input type="hidden" name="fail_url" value = "<?php echo SITEURL; ?>fail.php">
    <input type="hidden" name="cancel_url" value = "<?php echo SITEURL; ?>/cancel.php">
    
    <button type="submit" name="submit" value="Pay Now">Pay</button>
    
  </form>
  
</div>

</body>
</html>
