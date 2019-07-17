<?php
   error_reporting(E_ALL);
   $db="BuildItUp_Other";
   $host="localhost";
   $user="root";
   $pswd="";

   $page=$_POST['page'];
   $con=new mysqli($host,$user,$pswd,$db) or die("Error in connecting BuildItUp_Other db");

   $check="SELECT id FROM filter_temp WHERE selected='1'";
   $load=mysqli_query($con,$check) or die("failed to select");
   if($load)
   {
      while($row=mysqli_fetch_assoc($load))
      {
         echo " ".$row["id"];
      }
   }
?>
