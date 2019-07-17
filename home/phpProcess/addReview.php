<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
if(isset($_SESSION["username"]))
{
   $me=$_SESSION['username'];
   $pid=$_SESSION['proID'];
   $rev=$_POST['rev'];
   $dateTime=date("Y-m-d H:i:s");
   if(strlen($rev)>0)
   {
      $host="localhost";
      $user="root";
      $pswd="";
      $db="BuildItUp_Customer";

      //$name=$_SESSION["username"];
      $c=mysqli_connect($host,$user,$pswd,$db) or die("Con error");
      $q="INSERT INTO prod_review(user,prod_id,review,datet) VALUES('$me','$pid','$rev','$dateTime')";
      $result=mysqli_query($c,$q) or die("q error");
      if($result)
      {
         echo "success";
      }
      else
      {
         echo "failed";
      }
   }
   else
   {
      echo "Empty";
   }
}
else
{
   echo "You need to Login to your account first";
}
?>
