<?php
$pid=$_POST['pid'];
$host="localhost";
$user="root";
$pswd="";
$db="BuildItUp";

$con=new mysqli($host,$user,$pswd,$db) or die("Err");
$q="UPDATE orderlist SET deliveredYet='1' AND status='paid' WHERE pid='$pid'";
$r=mysqli_query($con,$q) or die("qE");
if($r)
{
   echo "Success";
}
?>
