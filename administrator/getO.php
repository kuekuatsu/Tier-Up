<?php
error_reporting(E_ALL);
session_start();
   $ip=trim(strtolower($_POST['ip']));

   if($ip!='')
   {
      $host="localhost";
      $u="root";
      $p="";
      $db="BuildItUp";

      $con=new mysqli($host,$u,$p,$db) or die("con fail");
      $sql="SELECT * FROM products WHERE LOWER(CONCAT(prod_name,prod_category,subcat)) LIKE '%".$ip."%'";
      $result=mysqli_query($con,$sql) or die("fail");
      if($result)
      {
         if(mysqli_num_rows($result)>0)
         {
            //echo $sql;
            $_SESSION['show']=$sql;
         }
         else
         {
            echo "No product of this name or category";
         }
      }
   }
   else
   {
      //echo "Enter something";
   }
?>
