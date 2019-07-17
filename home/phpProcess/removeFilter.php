<?php
session_start();
   $label=$_POST['label'];
   $id=$_POST['ID'];
   $page=$_POST['page'];

   $host="localhost";
   $user="root";
   $pswd="";
   $db="BuildItUp_Other";
   $con=new mysqli($host,$user,$pswd,$db) or die("Error in connecting BuildItUp_Other db");

   $q="UPDATE filter_temp SET selected='0' WHERE id='$id'";
   $r=mysqli_query($con,$q) or die("update to 0 failed");

   if($r)
   {
      $qry="SELECT * FROM products";

      $sql1="SELECT * FROM filter_temp WHERE selected='1'";
      $res1=mysqli_query($con,$sql1);
      $num=mysqli_num_rows($res1);//4

         $q1="SELECT * FROM filter_temp WHERE selected='1' AND label IN ('ALL')";
         $r1=mysqli_query($con,$q1);
         $num_all=mysqli_num_rows($r1);//2
         if($num_all>0)
         {
            $qry="SELECT * FROM products WHERE prod_category IN (";
            while($row1=mysqli_fetch_array($r1))
            {
               $j=$row1['cat'];
               $qry.="'$j'";
               $num_all --;
               if($num_all>0)
               {
                  $qry.=",";
               }
            }
            $qry.=")";

            $q2="SELECT * FROM filter_temp WHERE selected='1' AND label NOT IN ('ALL')";
            $r2=mysqli_query($con,$q2);
            $num_notall=mysqli_num_rows($r2);//2
            if($num_notall>0)
            {
               $qry.=" OR subcat IN (";
               while($row2=mysqli_fetch_array($r2))
               {
                  $k=strtolower($row2['label']);
                  $qry.="'$k'";
                  $num_notall --;
                  if($num_notall>0)
                  {
                     $qry.=",";
                  }
               }$qry.=")";
            }
            $_SESSION['qry']=$qry;
            //echo $qry;
         }
         else
         {
            $q3="SELECT * FROM filter_temp WHERE selected='1' AND label NOT IN ('ALL')";
            $r3=mysqli_query($con,$q3);
            $num_not=mysqli_num_rows($r3);//2
            if($num_not>0)
            {
               $qry="SELECT * FROM products WHERE subcat IN (";
               while($row3=mysqli_fetch_array($r3))
               {
                  $k=strtolower($row3['label']);
                  $qry.="'$k'";
                  $num_not --;
                  if($num_not>0)
                  {
                     $qry.=",";
                  }
               }$qry.=")";
            }
            $_SESSION['qry']=$qry;
         }
   }
?>
