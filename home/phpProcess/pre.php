<?php
$page=$_POST['page'];
date_default_timezone_set('Asia/Kolkata');

error_reporting(E_ALL);
$db="BuildItUp_Other";
$host="localhost";
$user="root";
$pswd="";

$con=new mysqli($host,$user,$pswd,$db) or die("Error in connecting BuildItUp_Other db");
$q="UPDATE filter_temp SET selected='1' WHERE label='All' AND cat='$page'";
$r=mysqli_query($con,$q) or die("failed to update all");
/*if($r)
{
   echo "yo";
}*/
$qry="SELECT id FROM filter_temp WHERE selected='1' AND label='All'";
$res=mysqli_query($con,$qry) or die("failed to update all");
if($res){
   while($row=mysqli_fetch_array($res))
   {
      echo $row['id'];
   }
}
?>
