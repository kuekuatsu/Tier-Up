<?php
   session_start();
   $pid=$_POST["id"];
   date_default_timezone_set('Asia/Kolkata');

   if(isset($_SESSION["username"]))
   {
      $uid=$_SESSION['userID'];
      $h="localhost";
      $u="root";
      $p="";
      $db="BuildItUp_Customer";
      $c=new mysqli($h,$u,$p,$db) or die("aiyo");
      $q="DELETE FROM cart WHERE CustomerID='$uid' AND ProductID='$pid'";
      $r=mysqli_query($c,$q) or die("qErr");
      if($r)
      {
         echo "success";
      }
   }
   else
   {
      echo "impossible";
   }
?>
