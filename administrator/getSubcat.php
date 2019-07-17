<?php
   $cate=$_POST["cat"];

   $host="localhost";
   $user="root";
   $pswd="";
   $db="BuildItUp_Other";
   $con=new mysqli($host,$user,$pswd,$db) or die("Unable to connect");

   $q="SELECT Sub FROM sub_cat WHERE Category='$cate'";
   $result=mysqli_query($con,$q) or die("Query fail");
   while($row=mysqli_fetch_array($result))
   {
    echo "<option>".$row[0]."</option>";
   }
?>
