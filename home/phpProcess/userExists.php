<?php
$ip=$_POST['ip'];
$h="localhost";
$u="root";
$p="";
$db="BuildItUp_Customer";

$con=new mysqli($h,$u,$p,$db) or die("Errr");
$q="SELECT * FROM users WHERE Username='$ip'";
$r=mysqli_query($con,$q) or die("qerr");
if(mysqli_num_rows($r)>0)
{
   echo "exist";
}
else
{
   echo "allow";
}
?>
