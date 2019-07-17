<?php
session_start();
$cid=$_SESSION['userID'];
$rate=$_POST['rate'];
$pid=$_POST['pid'];
//echo $rate;

$host="localhost";
$user="root";
$pswd="";
$db="BuildItUp_Customer";

$con=new mysqli($host,$user,$pswd,$db) or die("aiiyo");
$qry="SELECT * FROM prod_rating WHERE cid='$cid' AND pid='$pid'";
$res=mysqli_query($con,$qry) or die("ibibo");
if($res)
{
   if(mysqli_num_rows($res)==1)
   {
      $q="UPDATE prod_rating SET star='$rate' WHERE cid='$cid' AND pid='$pid'";
      $r=mysqli_query($con,$q) or die("eeeu");
      if($r)
      {
         echo "success";
      }
   }
   else
   {
      $q="INSERT INTO prod_rating(cid,pid,star) VALUES('$cid','$pid','$rate')";
      $r=mysqli_query($con,$q) or die("eeeu");
      if($r)
      {
         echo "success";
      }
   }
}
?>
