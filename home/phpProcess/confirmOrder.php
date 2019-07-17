<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$custom=$_SESSION["userID"];
$past=$_SESSION["page"];

   $dis=$_POST["discount"];
   $paymentMethod=$_POST['pay'];
   $offer=$_POST['offer'];
   $ship=$_POST['ship'];
   $loca=$_POST['loca'];
   $amt=$_POST['amtPayable'];

   $fname=$_POST['fname'];
   $lname=$_POST['lname'];
   $adr=$_POST['adr'];
   $city=$_POST['city'];
   $pin=$_POST['pin'];
   $mob=$_POST['mob'];
   $mail=$_POST['mail'];

   $p_name="/^[A-Za-z ]+$/";
   $p_mob="/^(9|8|7)[0-9]{9}$/";
   $p_mail="/^[a-zA-Z0-9._]{4,}@[a-z]{3,}\.(com|net|co)$/";
   if(!preg_match($p_name,$fname) || !preg_match($p_name,$lname))
   {
      echo "Enter a valid name";
   }
   else
   {
      if(strlen($adr)<10)
      {
         echo "Enter a valid address";
      }
      else
      {
         if(!preg_match($p_name,$city))
         {
            echo "Enter a valid city";
         }
         else
         {
            if(!preg_match($p_mob,$mob))
            {
               echo "Invalid Mobile No.";
            }
            else
            {
               if(!preg_match($p_mail,$mail))
               {
                  echo "error";
               }
               else
               {
                  $_SESSION['offer']=$offer;
                  $_SESSION['pay']=$amt;
                  $_SESSION['discount']=$dis;
                  $_SESSION['ship']=$ship;

                  $host="localhost";
                  $user="root";
                  $pswd="";
                  $db="BuildItUp_Customer";
                  $data="BuildItUp";
                  $fullname=$fname." ".$lname;

                  $c=new mysqli($host,$user,$pswd,$db) or die("erro");
                  $con=new mysqli($host,$user,$pswd,$data) or die("errow");
                  $sql="SELECT * FROM $past WHERE CustomerID='$custom'";
                  $run=mysqli_query($c,$sql) or die("sssss");
                  if($run)
                  {
                     while($ro=mysqli_fetch_array($run))
                     {
                        $qry="UPDATE orders SET shipping='$ship',discount='$dis',closest_store='$loca' WHERE customerID='$custom' AND prod_id='$ro[ProductID]'";
                        $res=mysqli_query($con,$qry) or die("uuuuuu");
                        if($res)
                        {
                           echo "suc";
                        }
                     }
                  }
            /*      $qry="UPDATE orders SET shipping='$ship',discount='$dis',closest_store='$loca' WHERE customerID='$custom' AND prod_id='$pid'"; */


                  $q="UPDATE users SET Name='$fullname',Email='$mail',Mobile='$mob',Address='$adr',City='$city',Pincode='$pin' WHERE Cust_id='$custom'";
                  $r=mysqli_query($c,$q) or die("updation fail");
                  if($r)
                  {
                     if($paymentMethod=='credit')
                     {
                        echo "goto:creditPage.php";
                     }
                     else if($paymentMethod=='debit')
                     {
                        echo "goto:debitPage.php";
                     }
                     else if($paymentMethod=='cod')
                     {
                        echo "goto:codPage.php";
                     }
                     else
                     {
                        echo "Fatal Error";
                     }
                  }
               }
            }
         }
      }
   }
?>
