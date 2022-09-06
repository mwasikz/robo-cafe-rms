<?php 
include('config/constants.php');
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
         if(isset($_SESSION['fail'])){
                echo $_SESSION['fail'];
                unset($_SESSION['fail']);
         }
    ?>
      <form action="<?php echo SITEURL ?>index.php">
          <button>Homepage</button>
      </form>
  
  


</div>


</body>
</html>
