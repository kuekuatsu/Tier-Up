<?php
   session_start();
   date_default_timezone_set('Asia/Kolkata');
   $id=$_POST["id"];

   if(isset($_SESSION["username"]))
   {
      //echo "logged in";
      $uname=$_SESSION["username"];

      $host="localhost";
      $user="root";
      $password="";
      $db="BuildItUp_customer";

      $con=new mysqli($host,$user,$password,$db) or die("Error in db connection");
      $query="SELECT cust_id FROM users WHERE Username='$uname'";
      $result=mysqli_query($con,$query) or die("unsuccessful");
      if($result)
      {
         while($row=mysqli_fetch_array($result))
         {
            $cust=$row[0];
         }
      }

      //Isprod already added to cart?
      $q="SELECT ProductID from cart WHERE CustomerID='$cust'";
      $r=mysqli_query($con,$q) or die("no success");
      $prod=array();
      if($r)
      {
         while($o=mysqli_fetch_array($r))
         {
            $prod[]=$o[0];
         }
      }
      if(in_array($id,$prod)==FALSE)
      {
         $db2="BuildItUp";
         $con2=new mysqli($host,$user,$password,$db2) or die("Error in db2 connection");
         $qry="SELECT * FROM products WHERE prod_id='$id'";
         $res=mysqli_query($con2,$qry) or die("unsuccessful execution");
         if($res)
         {
            while($i=mysqli_fetch_array($res))
            {
               $unitPrice=$i['prod_amt'];
               $total=$unitPrice*'1';
            }
         }

         $query2="INSERT INTO cart(CustomerID,ProductID,ProductPrice,Quantity,FinalPrice)
          VALUES('$cust','$id','$unitPrice','1','$total')";
         $res=mysqli_query($con,$query2);
         if($res)
         {
               echo "success";
         }
         mysqli_close($con);
      }
   }
   else
   {
      echo "Log in first!";
   }
?>
