<?php
session_start();
   include "distancefinder.class.php";

   $pin=$_POST['pin'];
   $city=$_POST['city'];
   if(ctype_digit($pin) && strlen($pin)==6)
   {
      $host="localhost";
      $user="root";
      $pswd="";
      $db="lot";
      $db2="BuildItUp";

      $con=new mysqli($host,$user,$pswd,$db) or die("con error");
      $qry="SELECT taluk FROM research WHERE pincode='$pin'";
      $res=mysqli_query($con,$qry) or die("qryERR");
      if($res)
      {
         if(mysqli_num_rows($res)>0)
         {
            while($row=mysqli_fetch_array($res))
            {
               $ans=$row[0];
               $df = new distanceFinder("Car Drive");
               $r1 = $df->findDistance("maharashtra $pin, india", "Hinjewadi Rajiv Gandhi Infotech Park, Hinjawadi,Pune, Maharashtra,411057");
               $r2 = $df->findDistance("maharashtra $pin, india", "Kharadi, Pune, Maharashtra 411014");
               $r3 = $df->findDistance("maharashtra $pin, india", "Unnamed Road, Rao Colony, Lonavala, Maharashtra 410401");
               $r4 = $df->findDistance("maharashtra $pin, india", "Sector 8, Airoli,Navi Mumbai, Maharashtra 400708");
               $r5 = $df->findDistance("maharashtra $pin, india", "Lokmanya Tilak Rd,Gyan Nagar, Mhatre Wadi, Borivali West,Mumbai, Maharashtra 400092");
               $r6 = $df->findDistance("maharashtra $pin, india", "Kuber Complex,KL Walawalkar Marg,Veera Desai Industrial Estate, Andheri West, Mumbai, Maharashtra 400102");
               $r7 = $df->findDistance("maharashtra $pin, india", "Tetavli, Kausa, Mumbra, Mumbai, Maharashtra 400612");
               if (isset($r1['error']) || isset($r2['error']) || isset($r3['error']) || isset($r4['error']) || isset($r5['error']) || isset($r6['error']) || isset($r7['error']))
               {
                   echo $r1['error']['msg'];
               }
               else
               {
                   $near=min($r1,$r2,$r3,$r4,$r5,$r6,$r7);
                   if($r1==$near)
                   {
                      $store="Hinjawadi";
                   }
                   elseif($r2==$near)
                   {
                      $store="Kharadi";
                   }
                   elseif($r3==$near)
                   {
                      $store="Lonavala";
                   }
                   elseif($r4==$near)
                   {
                      $store="Navi Mumbai";
                   }
                   elseif($r5==$near)
                   {
                      $store="Borivali West";
                   }
                   elseif($r6==$near)
                   {
                      $store="Andheri West";
                   }
                   elseif($r7==$near)
                   {
                      $store="Mumbra";
                   }

                   if($near>110) // nearest store distance more than 100km
                   {
                      $ship="375";
                   }
                   elseif($near>100)
                   {
                      $ship="345";
                   }
                   elseif($near>90)
                   {
                      $ship="325";
                   }
                   elseif($near>80)
                   {
                      $ship="305";
                   }
                   elseif($near>70)
                   {
                      $ship="285";
                   }
                   elseif($near>60)
                   {
                      $ship="265";
                   }
                   elseif($near>55)
                   {
                      $ship="255";
                   }
                   elseif($near>50)
                   {
                      $ship="245";
                   }
                   elseif($near>45)
                   {
                      $ship="225";
                   }
                   elseif($near>40)
                   {
                      $ship="205";
                   }
                   elseif($near>35)
                   {
                      $ship="185";
                   }
                   elseif($near>30)
                   {
                      $ship="165";
                   }
                   elseif($near>25)
                   {
                      $ship="155";
                   }
                   elseif($near>20)
                   {
                      $ship="135";
                   }
                   elseif($near>15)
                   {
                      $ship="115";
                   }
                   elseif($near>10)
                   {
                      $ship="95";
                   }
                   elseif($near>5)
                   {
                      $ship="65";
                   }
                   elseif($near>1)
                   {
                      $ship="35";
                   }
                   else
                   {
                      $ship="0";
                   }
                   $c=new mysqli($host,$user,$pswd,$db2) or die("io");
                   $y="SELECT * FROM orderlist WHERE store='$store' AND deliveredYet='0'";
                   $z=mysqli_query($c,$y) or die("dead");
                   if($z)
                   {
                      if(mysqli_num_rows($z)>=7)
                      {
                        echo "err:Sorry, We are already full today";
                        unset($_SESSION["pinDetails"]);
                      }
                      else
                      {
                        echo $near."/".$ans."/".$ship."/".$store."/";
                        $_SESSION["pinDetails"]=$pin."/".$ans."/".$ship."/".$store;
                      }
                   }
               }
            }
         }
         else
         {
            echo "err:Sorry, we don't deliver here";
         }
      }
   }
   else
   {
      echo "err:Invalid Pincode";
   }
?>
