<?php include('config/constants.php'); ?> 
<?php

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(isset($_POST['Add_To_Cart']))
    {
        if(isset($_SESSION['cart']))
        {
            $myitems = array_column($_SESSION['cart'],'Item_Name');
            if(in_array($_POST['Item_Name'], $myitems))
            {
                echo "<script>
                alert('Item Already In Cart'); 
                window.location.href='menu.php';
                </script>"; 
                 
            }
            else
            {

            
            $count = count($_SESSION['cart']); 
            $_SESSION['cart'][$count] = array('Item_Name'=>$_POST['Item_Name'],'Price'=>$_POST['Price'],'Id'=>$_POST['Id'],'Quantity'=>1);
            echo "<script>
                alert('Added To Cart'); 
                window.location.href='menu.php';
                </script>";
                
            }
            

        }
        else
        {
            $_SESSION['cart'][0]=array('Item_Name'=>$_POST['Item_Name'],'Price'=>$_POST['Price'],'Id'=>$_POST['Id'],'Quantity'=>1);
            echo "<script>
                alert('Added To Cart'); 
                window.location.href='menu.php';
                </script>";
                
        }

    }
    if(isset($_POST['Remove_Item']))
    {
        foreach($_SESSION['cart'] as $key => $value)
        {
            if($value['Item_Name']==$_POST['Item_Name'])
            {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart']=array_values($_SESSION['cart']);
            echo "<script>
            alert('Item Removed From Cart');
            window.location.href='mycart.php';
            
            </script>";
            
            }
        }
    }
    if(isset($_POST['Mod_Quantity']))
    {
        foreach($_SESSION['cart'] as $key => $value)
        {
            if($value['Item_Name']==$_POST['Item_Name'])
            {
                $_SESSION['cart'][$key]['Quantity']=$_POST['Mod_Quantity'];
           
            echo "<script>
            alert('Cart Updated');
            window.location.href='mycart.php';
            </script>";
           
            }
        } 
    }
    
}


?>