<?php
   $m=$_POST['mail'];
   $d=$_POST['dob'];
   $dt=new DateTime(trim($d));
   $month=$dt->format('m');
   $day=$dt->format('d');
   $year=$dt->format('Y');
   if(checkdate($month, $day, $year))
   {
      $h="localhost";
      $u="root";
      $p="";
      $db="BuildItUp";
      $date=date("Y-m-d",strtotime($d));
      $c=new mysqli($h,$u,$p,$db) or die("err");
      $q="INSERT INTO mail_list(Email,DOB) VALUES('$m','$date')";
      $r=mysqli_query($c,$q) or die("Already Registered");
      if($r)
      {
         echo "true";
      }
   }
   else
   {
      echo "Invalid Email ID";
   }
?>
