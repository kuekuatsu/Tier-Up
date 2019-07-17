<?php
   session_start();
   $uid=$_SESSION["userID"];

   $host="localhost";
   $user="root";
   $password="";
   $db="BuildItUp_customer";

   $con=new mysqli($host,$user,$password,$db) or die("error in connection");
   $query="SELECT * FROM cart WHERE CustomerID='$uid'";
   $res=mysqli_query($con,$query) or die("query error");
   if($res)
   {
      $row_count=$res->num_rows;
      echo $row_count;
   }
?>
