<?php
$host="localhost";
$user="root";
$password="";
$db="BuildItUp_customer";
$custom=$_POST['cust'];
$table=$_POST['page'];

$con=new mysqli($host,$user,$password,$db) or die("unable to connect");
$query="SELECT * FROM $table WHERE CustomerID='$custom'";

$result=mysqli_query($con,$query) or die("query error");
if($result)
{
   if(mysqli_num_rows($result)>0)
   {
      $sum=0;
      while($row=mysqli_fetch_array($result))
      {
         $sum=$sum+$row['FinalPrice'];
      }
      echo $sum;
   }
   else
   {
      echo "nm";
   }
}
?>
