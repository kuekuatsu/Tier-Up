<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$ship=$_POST['ship'];
   $page=$_POST['page'];
   $me=$_POST['me'];
   $area=trim($_POST['area']);
   $din=date("Y-m-d H:i:s");
   $_SESSION['access']='checkout';

   $host="localhost";
   $u="root";
   $p="";
   $db1="BuildItUp_Customer";
   $db2="BuildItUp";

   if($area=='')
   {
      //echo "empty";

      $c=new mysqli($host,$u,$p,$db1) or die('c Failed');
      $q1="SELECT * FROM $page WHERE CustomerID='$me'";
      $r1=mysqli_query($c,$q1) or die("q1Fail");
      if($r1)
      {
         while($ro=mysqli_fetch_array($r1))
         {
            $id=$ro['ProductID'];
            $cut=new mysqli($host,$u,$p,$db2) or die('cut Failed');
            $s="SELECT lease FROM products WHERE prod_id='$id'";
            $src=mysqli_query($cut,$s) or die("sFail");
            if($src)
            {
               while($op=mysqli_fetch_array($src))
               {
                  $days=$op[0];
                  $future_din=date("Y-m-d H:i:s",strtotime($future_din."+".$days." day"));

                  $con=new mysqli($host,$u,$p,$db2) or die('con Failed');
                  //
                  $x="SELECT * FROM orders WHERE prod_id='$id' AND CustomerID='$me'";
                  $y=mysqli_query($con,$x) or die("xDead");
                  if(mysqli_num_rows($y)>0)
                  {
                     $d="DELETE FROM orders WHERE prod_id='$id' AND CustomerID='$me'";
                     $e=mysqli_query($con,$d) or die("dDead");
                     if($e)
                     {
                        $qry="INSERT INTO orders(order_date,prod_id,CustomerID,delivery_date,closest_store,shipping,discount)
                        VALUES('$din','$id','$me','$future_din','$a[3]','$a[2]',0)";
                        $result=mysqli_query($con,$qry) or die("main qry die");
                        if($result)
                        {
                           //echo "success";
                           $future_din=date("Y-m-d H:i:s");//reseting current date else other rows lease gets added to new date
                        }
                     }
                  }
                  else
                  {
                     $qry="INSERT INTO orders(order_date,prod_id,CustomerID,delivery_date,closest_store,shipping,discount)
                     VALUES('$din','$id','$me','$future_din','null',0,0)";
                     $result=mysqli_query($con,$qry) or die("main qry die");
                     if($result)
                     {
                        //echo "success";
                        $future_din=date("Y-m-d H:i:s");//reseting current date else other rows lease gets added to new date
                     }
                  }
               }
            }
            else
            {
               echo "rrrr";
            }
         }
      }
   }
   else
   {
      //echo "not";
      $a=explode('/',$area);
      //a[0]=distance km,a[1]=pin loaction,$a[2]=shipping cost, $a[3]=closest store

      $c=new mysqli($host,$u,$p,$db1) or die('c Failed');
      $q1="SELECT * FROM $page WHERE CustomerID='$me'";
      $r1=mysqli_query($c,$q1) or die("q1Fail");
      if($r1)
      {
         while($ro=mysqli_fetch_array($r1))
         {
            $id=$ro['ProductID'];
            $cut=new mysqli($host,$u,$p,$db2) or die('cut Failed');
            $s="SELECT lease FROM products WHERE prod_id='$id'";
            $src=mysqli_query($cut,$s) or die("sFail");
            if($src)
            {
               while($op=mysqli_fetch_array($src))
               {
                  $days=$op[0];
                  $future_din=date("Y-m-d H:i:s",strtotime($future_din."+".$days." day"));
                  //
                  $con=new mysqli($host,$u,$p,$db2) or die('con Failed');
                  $x="SELECT * FROM orders WHERE prod_id='$id' AND CustomerID='$me'";
                  $y=mysqli_query($con,$x) or die("xDead");
                  if(mysqli_num_rows($y)>0)
                  {
                     $d="DELETE FROM orders WHERE prod_id='$id' AND CustomerID='$me'";
                     $e=mysqli_query($con,$d) or die("dDead");
                     if($e)
                     {
                        $qry="INSERT INTO orders(order_date,prod_id,CustomerID,delivery_date,closest_store,shipping,discount)
                        VALUES('$din','$id','$me','$future_din','$a[3]','$a[2]',0)";
                        $result=mysqli_query($con,$qry) or die("main qry die");
                        if($result)
                        {
                           //echo "success";
                           $future_din=date("Y-m-d H:i:s");//reseting current date else other rows lease gets added to new date
                        }
                     }
                  }
                  else
                  {
                     $qry="INSERT INTO orders(order_date,prod_id,CustomerID,delivery_date,closest_store,shipping,discount)
                     VALUES('$din','$id','$me','$future_din','$a[3]','$a[2]',0)";
                     $result=mysqli_query($con,$qry) or die("main qry die");
                     if($result)
                     {
                        //echo "success";
                        $future_din=date("Y-m-d H:i:s");//reseting current date else other rows lease gets added to new date
                     }
                  }
               }
            }
            else
            {
               echo "rrrr";
            }
         }
      }
   }
?>
