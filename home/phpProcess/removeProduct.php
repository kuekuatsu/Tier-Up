<?php
   session_start();
   $uid=$_SESSION["userID"];
   $pid=$_POST["pid"];
   $table=$_POST["table"];

   $host="localhost";
   $user="root";
   $pswd="";
   $db="BuildItUp_customer";
   $con=new mysqli($host,$user,$pswd,$db) or die("error in connection");
   //query to delete this product from the table
   $query="DELETE FROM $table WHERE CustomerID='$uid' AND ProductID='$pid'";
   $result=mysqli_query($con,$query) or die("error in query");
   if($result)
   {
      echo "deleted";
   }
?>
