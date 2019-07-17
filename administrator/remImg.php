<?php
$pid=$_POST['pid'];
$h="localhost";
$u="root";
$p="";
$db="BuildItUp";

$c=new mysqli($h,$u,$p,$db) or die("error");
$q="UPDATE products SET prod_pic2='' WHERE prod_id='$pid'";
$r=mysqli_query($c,$q) or die("err");
if($r)
{
   echo "success";
}
?>
