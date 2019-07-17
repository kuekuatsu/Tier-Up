<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$type=$_POST['type'];
$amt=$_POST['cost'];
$offer=$_SESSION['offer'];
$ship=$_SESSION['ship'];
$from=$_SESSION['page'];
$custom=$_SESSION["userID"];
$discount=$_SESSION["discount"];

$h="localhost";
$u="root";
$p="";
$db="BuildItUp_Customer";
$c=new mysqli($h,$u,$p,$db) or die("fail");

$db2="BuildItUp";
$con=new mysqli($h,$u,$p,$db2) or die("datafail");

$q="SELECT * FROM $from WHERE CustomerID='$custom'";
$r=mysqli_query($c,$q) or die("dead");
if($r)
{
   $count=mysqli_num_rows($r);
   $m="INSERT INTO blend(cid,cost,products,ship,offer,discount) VALUES('$custom','$amt','$count','$ship','$offer','$discount')";
   $n=mysqli_query($con,$m) or die("murder");
   if($n)
   {
      $_SESSION['paymentType']=$type;
      //echo "success";
      $s="SELECT id FROM blend WHERE cost='$amt'";
      $t=mysqli_query($con,$s) or die("murdered");
      if($t)
      {
         while($i=mysqli_fetch_array($t))
         {
            $foreign=$i[0];
         }
      }
      while($row=mysqli_fetch_array($r))
      {
         $proid=$row['ProductID'];
         $qt="SELECT * FROM orders WHERE prod_id='$proid' AND CustomerID='$custom'";
         $result=mysqli_query($con,$qt) or die("death");
         if($result)
         {
            while($l=mysqli_fetch_array($result))
            {
               $qry="INSERT INTO orderlist(blendID,cid, pid, pamt, pqty, pveg, ptot, ord_date, del_date, store, payType, status)
               VALUES ('$foreign','$custom','$proid','$row[ProductPrice]','$row[Quantity]','$row[vegan]',
                     '$row[FinalPrice]','$l[order_date]','$l[delivery_date]',
                  '$l[closest_store]','$type','unpaid')";
               $res=mysqli_query($con,$qry) or die("kill");
               if($res)
               {
                  $_SESSION['paymentType']=$type;
                  echo "succ";
               }
            }
         }
      }
   }
}

?>
