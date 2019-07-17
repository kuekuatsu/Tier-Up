<?php
   $ip=$_POST['val'];
   $page=$_POST['page'];
   $pid=$_POST['pid'];

   $host="localhost";
   $user="root";
   $pswd="";
   $db="BuildItUp_Customer";

   $conn=new mysqli($host,$user,$pswd,$db) or die("connFail");
   if($ip=="egg") //=0
   {
      //echo "not vegan";
      $q="UPDATE $page SET vegan='1' WHERE ProductID='$pid'";
      $r=mysqli_query($conn,$q) or die("qFail");
      if($r)
      {
         echo "success";
      }
   }
   else  //=1
   {
      //echo "vegan";
      $qry="UPDATE $page SET vegan='0' WHERE ProductID='$pid'";
      $res=mysqli_query($conn,$qry) or die("qFail");
      if($res)
      {
         echo "success";
      }
   }
?>
