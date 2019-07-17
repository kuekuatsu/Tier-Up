<?php
   $uid=$_POST['id'];
   $h="localhost";
   $u="root";
   $p="";
   $db="BuildItUp_Customer";

   $con=new mysqli($h,$u,$p,$db) or die('conError');
   $q="SELECT Name,Email,Mobile,Address,City,Pincode FROM users WHERE Cust_id='$uid'";
   $res=mysqli_query($con,$q) or die('qError');
   if($res)
   {
      $op="";
      while($row=mysqli_fetch_array($res))
      {
         for($i=0; $i<6; $i++)
         {
            $op.=$row[$i];
            $op.="/";
         }
      }
      echo $op;
   }
?>
