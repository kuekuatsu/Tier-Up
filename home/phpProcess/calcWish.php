<?php
   session_start();
   $qty=$_POST["qty"];
   $pid=$_POST["pid"];
   $uprice=$_POST["uprice"];
   //echo $qty." ".$pid;
   if(isset($_SESSION["username"]))
   {
      //echo "logged in";
      $uid=$_SESSION["userID"];
      $host="localhost";
      $user="root";
      $pswd="";
      $db="BuildItUp_customer";

      $total=$uprice*$qty;

      $con=new mysqli($host,$user,$pswd,$db) or die("no connection");
      $query="UPDATE wish SET Quantity='$qty', FinalPrice='$total' WHERE ProductID='$pid'";
      $result=mysqli_query($con,$query) or die("query error");
      if($result)
      {
         echo $total;
      }
   }
   else
   {
      echo "Log in first";
   }
?>
