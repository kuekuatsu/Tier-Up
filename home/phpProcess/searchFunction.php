<?php
session_start();
   $ip=trim(strtolower($_POST['input']));

   if($ip!='')
   {
      $host="localhost";
      $user="root";
      $pswd="";
      $db="BuildItUp";

      $con=new mysqli($host,$user,$pswd,$db) or die("con fail");
      $sql="SELECT * FROM products WHERE LOWER(CONCAT(prod_name,prod_abt,prod_category)) LIKE '%".$ip."%'";
      $result=mysqli_query($con,$sql) or die("fail");
      if($result)
      {
         if(mysqli_num_rows($result)>0)
         {
            //echo $sql;
            $_SESSION['qry']=$sql;
         }
         else
         {
            echo "No results found";
         }
      }
   }
   else
   {
      echo "Enter something";
   }
?>
