<?php
session_start();
   $user=$_POST['user'];
   $pswd=$_POST['pswd'];
   //echo $user." ".$pswd;
   if($user=="")
   {
      echo "Enter a username";
   }
   else
   {
      if($pswd=="")
      {
         echo "Enter a password";
      }
      else
      {
         $h="localhost";
         $u="root";
         $p="";
         $db="BuildItUp";
         $c=new mysqli($h,$u,$p,$db) or die("c err");
         $q="SELECT pswd FROM managers WHERE user='$user'";
         $r=mysqli_query($c,$q) or die("r err");
         if($q)
         {
            if(mysqli_num_rows($r)>0)
            {
               while($i=mysqli_fetch_array($r))
               {
                  if($i[0]==$pswd)
                  {
                     echo "success";
                     $_SESSION['uname']=$user;
                  }
                  else
                  {
                     echo "Not a user";
                  }
               }
            }
            else
            {
               echo "Invalid Username";
            }
         }
      }
   }
?>
