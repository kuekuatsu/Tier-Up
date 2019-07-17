<?php
session_start();
$cat=$_POST['cat'];
//echo $cat;
$h="localhost";
$u="root";
$p="";
$db="BuildItUp_Other";

$con=new mysqli($h,$u,$p,$db) or die("conErr");
$del="UPDATE filter_temp SET selected='0'";
$deleted=mysqli_query($con,$del) or die("delFail");
if($deleted)
{
   if($cat=="cake")
   {
      $qry="UPDATE filter_temp SET selected='1' WHERE cat='$cat' AND id='allCake'";
      $res=mysqli_query($con,$qry) or die("qryFail1");
      if($res)
      {
         echo "success1";
      }
   }
   else if($cat=="cookie")
   {
      $qry="UPDATE filter_temp SET selected='1' WHERE cat='$cat' AND id='allCookie'";
      $res=mysqli_query($con,$qry) or die("qryFail2");
      if($res)
      {
         echo "success2";
      }
   }
   else if($cat=="cupcake")
   {
      $qry="UPDATE filter_temp SET selected='1' WHERE cat='$cat' AND id='allCup'";
      $res=mysqli_query($con,$qry) or die("qryFail3");
      if($res)
      {
         echo "success3";
      }
   }
   else if($cat=="bread")
   {
      $qry="UPDATE filter_temp SET selected='1' WHERE cat='$cat' AND id='allBread'";
      $res=mysqli_query($con,$qry) or die("qryFail4");
      if($res)
      {
         echo "success4";
      }
   }
}
?>
