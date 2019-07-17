<?php
date_default_timezone_set('Asia/Kolkata');
   $delivery=$_POST['d'];
   $product=$_POST['p'];
   $customer=$_POST['c'];

   $h="localhost";
   $u="root";
   $p="";
   $db="BuildItUp";
   $con=new mysqli($h,$u,$p,$db) or die('conError');
   $q="SELECT lease FROM products WHERE prod_id='$product'";
   $result=mysqli_query($con,$q) or die("eurr");
   if($result)
   {
      while($row=mysqli_fetch_array($result))
      {
         $allocated=date("Y-m-d",strtotime("+".$row[0]." day"));
         $set=date("Y-m-d",strtotime($delivery));
         if($set >= $allocated)
         {
            $upd="UPDATE orders SET delivery_date='$delivery' WHERE prod_id='$product' AND customerID='$customer'";
            $r=mysqli_query($con,$upd) or die("not filled");
         }
         else
         {
            echo "We can not deliver before ".date("j F, Y",strtotime($allocated));
         }
      }
   }
?>
