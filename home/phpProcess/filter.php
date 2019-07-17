<?php
error_reporting(E_ALL);
session_start();
   $label=strtolower($_POST["label"]);
   $id=$_POST["ID"];
   $class=$_POST["class"];

   $host="localhost";
   $user="root";
   $pswd="";
   $db="BuildItUp_Other";

   $cn=new mysqli($host,$user,$pswd,$db) or die("Error in connecting BuildItUp_Other db");
   if($label=="all")
   {
      if($id=="allCake")
      {
         $q1="UPDATE filter_temp SET selected='0' WHERE cat='cake'";
         $r1=mysqli_query($cn,$q1) or die("cant update q1");
         if($r1)
         {
            //echo "done";
         }

         $qry1="UPDATE filter_temp SET selected='1' WHERE id='allCake'";
         $res1=mysqli_query($cn,$qry1) or die("cant update qry1");
         if($res1)
         {
            //echo "success";
         }
         /*$qry="SELECT * FROM products WHERE prod_category='cake'";
         echo $qry;*/
         $qry="SELECT * FROM products WHERE prod_category='cake'";
         $c=new mysqli($host,$user,$pswd,$db) or die("conerrr");
         $all="SELECT * FROM filter_temp WHERE selected='1'";
         $rall=mysqli_query($c,$all) or die("rall fail");
         $num_all=mysqli_num_rows($rall);

         $some="SELECT * FROM filter_temp WHERE selected='1' AND label='All'";
         $rsome=mysqli_query($c,$some) or die("rall fail");
         $num_some=mysqli_num_rows($rsome);

         if($num_some>0)
         {
            //echo $num_all." ".$num_some.";
            $qry="SELECT * FROM products WHERE prod_category IN (";
            while($line=mysqli_fetch_array($rsome))
            {
               $new=$line['cat'];
               $qry.="'$new'";
               $num_some --;
               if($num_some>0)
               {
                  $qry.=",";
               }
            }$qry.=")";
         }
         //echo $qry;
         $sub="SELECT * FROM `filter_temp` WHERE `selected`='1' AND label NOT IN ('All')";
         $rsub=mysqli_query($c,$sub) or die("rsub fail");
         $num_sub=mysqli_num_rows($rsub);
         if($num_sub>0)
         {
            $qry.=" OR subcat IN (";
            while($x=mysqli_fetch_array($rsub))
            {
               $add=strtolower($x['label']);
               $qry.="'$add'";
               $num_sub --;
               if($num_sub>0)
               {
                  $qry.=",";
               }
            }$qry.=")";
         }
         $_SESSION['qry']=$qry;
         //echo $qry;
         mysqli_close($c);
      }
      elseif($id=="allCup")
      {
         $q2="UPDATE filter_temp SET selected='0' WHERE cat='cupcake'";
         $r2=mysqli_query($cn,$q2) or die("cant update q2");
         if($r2)
         {
            //echo "done";
         }

         $qry2="UPDATE filter_temp SET selected='1' WHERE id='allCup'";
         $res2=mysqli_query($cn,$qry2) or die("cant update qry2");
         if($res2)
         {
            //echo "success";
         }
         ////
         $qry="SELECT * FROM products WHERE prod_category='cupcake'";
         $c=new mysqli($host,$user,$pswd,$db) or die("conerrr");
         $all="SELECT * FROM filter_temp WHERE selected='1'";
         $rall=mysqli_query($c,$all) or die("rall fail");
         $num_all=mysqli_num_rows($rall);

         $some="SELECT * FROM filter_temp WHERE selected='1' AND label='All'";
         $rsome=mysqli_query($c,$some) or die("rall fail");
         $num_some=mysqli_num_rows($rsome);

         if($num_some>0)
         {
            //echo $num_all." ".$num_some.";
            $qry="SELECT * FROM products WHERE prod_category IN (";
            while($line=mysqli_fetch_array($rsome))
            {
               $new=$line['cat'];
               $qry.="'$new'";
               $num_some --;
               if($num_some>0)
               {
                  $qry.=",";
               }
            }$qry.=")";
         }
         //echo $qry;
         $sub="SELECT * FROM `filter_temp` WHERE `selected`='1' AND label NOT IN ('All')";
         $rsub=mysqli_query($c,$sub) or die("rsub fail");
         $num_sub=mysqli_num_rows($rsub);
         if($num_sub>0)
         {
            $qry.=" OR subcat IN (";
            while($x=mysqli_fetch_array($rsub))
            {
               $add=strtolower($x['label']);
               $qry.="'$add'";
               $num_sub --;
               if($num_sub>0)
               {
                  $qry.=",";
               }
            }$qry.=")";
         }
         $_SESSION['qry']=$qry;
         //echo $qry;
         mysqli_close($c);
      }
      elseif($id=="allCookie")
      {
         $q3="UPDATE filter_temp SET selected='0' WHERE cat='cookie'";
         $r3=mysqli_query($cn,$q3) or die("cant update q3");
         if($r3)
         {
            //echo "done";
         }

         $qry3="UPDATE filter_temp SET selected='1' WHERE id='allCookie'";
         $res3=mysqli_query($cn,$qry3) or die("cant update qry3");
         if($res3)
         {
            //echo "success";
         }
         /////
         $qry="SELECT * FROM products WHERE prod_category='cookie'";
         $c=new mysqli($host,$user,$pswd,$db) or die("conerrr");
         $all="SELECT * FROM filter_temp WHERE selected='1'";
         $rall=mysqli_query($c,$all) or die("rall fail");
         $num_all=mysqli_num_rows($rall);

         $some="SELECT * FROM filter_temp WHERE selected='1' AND label='All'";
         $rsome=mysqli_query($c,$some) or die("rall fail");
         $num_some=mysqli_num_rows($rsome);

         if($num_some>0)
         {
            //echo $num_all." ".$num_some.";
            $qry="SELECT * FROM products WHERE prod_category IN (";
            while($line=mysqli_fetch_array($rsome))
            {
               $new=$line['cat'];
               $qry.="'$new'";
               $num_some --;
               if($num_some>0)
               {
                  $qry.=",";
               }
            }$qry.=")";
         }
         //echo $qry;
         $sub="SELECT * FROM `filter_temp` WHERE `selected`='1' AND label NOT IN ('All')";
         $rsub=mysqli_query($c,$sub) or die("rsub fail");
         $num_sub=mysqli_num_rows($rsub);
         if($num_sub>0)
         {
            $qry.=" OR subcat IN (";
            while($x=mysqli_fetch_array($rsub))
            {
               $add=strtolower($x['label']);
               $qry.="'$add'";
               $num_sub --;
               if($num_sub>0)
               {
                  $qry.=",";
               }
            }$qry.=")";
         }
         $_SESSION['qry']=$qry;
         //echo $qry;
         mysqli_close($c);
      }
      elseif($id=="allBread")
      {
         $q4="UPDATE filter_temp SET selected='0' WHERE cat='bread'";
         $r4=mysqli_query($cn,$q4) or die("cant update q4");
         if($r4)
         {
            //echo "done";
         }

         $qry4="UPDATE filter_temp SET selected='1' WHERE id='allBread'";
         $res4=mysqli_query($cn,$qry4) or die("cant update qry4");
         if($res4)
         {
            //echo "success";
         }
         /////
         $qry="SELECT * FROM products WHERE prod_category='bread'";
         $c=new mysqli($host,$user,$pswd,$db) or die("conerrr");
         $all="SELECT * FROM filter_temp WHERE selected='1'";
         $rall=mysqli_query($c,$all) or die("rall fail");
         $num_all=mysqli_num_rows($rall);

         $some="SELECT * FROM filter_temp WHERE selected='1' AND label='All'";
         $rsome=mysqli_query($c,$some) or die("rall fail");
         $num_some=mysqli_num_rows($rsome);

         if($num_some>0)
         {
            //echo $num_all." ".$num_some.";
            $qry="SELECT * FROM products WHERE prod_category IN (";
            while($line=mysqli_fetch_array($rsome))
            {
               $new=$line['cat'];
               $qry.="'$new'";
               $num_some --;
               if($num_some>0)
               {
                  $qry.=",";
               }
            }$qry.=")";
         }
         //echo $qry;
         $sub="SELECT * FROM `filter_temp` WHERE `selected`='1' AND label NOT IN ('All')";
         $rsub=mysqli_query($c,$sub) or die("rsub fail");
         $num_sub=mysqli_num_rows($rsub);
         if($num_sub>0)
         {
            $qry.=" OR subcat IN (";
            while($x=mysqli_fetch_array($rsub))
            {
               $add=strtolower($x['label']);
               $qry.="'$add'";
               $num_sub --;
               if($num_sub>0)
               {
                  $qry.=",";
               }
            }$qry.=")";
         }
         $_SESSION['qry']=$qry;
         //echo $qry;
         mysqli_close($c);
      }
   }
   //for subCategories
   else
   {
      if(strpos($id,'Cake')!==FALSE)
      {
         $check1="SELECT * FROM filter_temp WHERE id='$id'";
         $return1=mysqli_query($cn,$check1) or die("cant find check1");
         if($return1->num_rows > 0)
         {
            $sql1="UPDATE filter_temp SET selected='1' WHERE id='$id'";
            $result1=mysqli_query($cn,$sql1) or die("cant update sql1");
            if($result1)
            {
               //echo "finish";
            }
         }
         else
         {
            $sql1="INSERT INTO filter_temp VALUES('$label','cake','$id','1')";
            $result1=mysqli_query($cn,$sql1) or die("cant insert sql1");
            if($result1)
            {
               //echo "finish";
            }
         }

         $quest1="UPDATE filter_temp SET selected='0' WHERE id='allCake'";
         $ans1=mysqli_query($cn,$quest1) or die("cant update quest1");
         if($ans1)
         {
            //echo "end";
         }
      }
      elseif(strpos($id,'Cup')!==FALSE)
      {
         $check1="SELECT * FROM filter_temp WHERE id='$id'";
         $return1=mysqli_query($cn,$check1) or die("cant find check1");
         if($return1->num_rows > 0)
         {
            $sql1="UPDATE filter_temp SET selected='1' WHERE id='$id'";
            $result1=mysqli_query($cn,$sql1) or die("cant update sql1");
            if($result1)
            {
               //echo "finish";
            }
         }
         else
         {
            $sql1="INSERT INTO filter_temp VALUES('$label','cupcake','$id','1')";
            $result1=mysqli_query($cn,$sql1) or die("cant insert sql1");
            if($result1)
            {
               //echo "finish";
            }
         }

         $quest1="UPDATE filter_temp SET selected='0' WHERE id='allCup'";
         $ans1=mysqli_query($cn,$quest1) or die("cant update quest1");
         if($ans1)
         {
            //echo "end";
         }
      }
      elseif(strpos($id,'Cookie')!==FALSE)
      {
         $check1="SELECT * FROM filter_temp WHERE id='$id'";
         $return1=mysqli_query($cn,$check1) or die("cant find check1");
         if($return1->num_rows > 0)
         {
            $sql1="UPDATE filter_temp SET selected='1' WHERE id='$id'";
            $result1=mysqli_query($cn,$sql1) or die("cant update sql1");
            if($result1)
            {
               //echo "finish";
            }
         }
         else
         {
            $sql1="INSERT INTO filter_temp VALUES('$label','cookie','$id','1')";
            $result1=mysqli_query($cn,$sql1) or die("cant insert sql1");
            if($result1)
            {
               //echo "finish";
            }
         }

         $quest1="UPDATE filter_temp SET selected='0' WHERE id='allCookie'";
         $ans1=mysqli_query($cn,$quest1) or die("cant update quest1");
         if($ans1)
         {
            //echo "end";
         }
      }
      elseif(strpos($id,'Bread')!==FALSE)
      {
         $check1="SELECT * FROM filter_temp WHERE id='$id'";
         $return1=mysqli_query($cn,$check1) or die("cant find check1");
         if($return1->num_rows > 0)
         {
            $sql1="UPDATE filter_temp SET selected='1' WHERE id='$id'";
            $result1=mysqli_query($cn,$sql1) or die("cant update sql1");
            if($result1)
            {
               //echo "finish";
            }
         }
         else
         {
            $sql1="INSERT INTO filter_temp VALUES('$label','bread','$id','1')";
            $result1=mysqli_query($cn,$sql1) or die("cant insert sql1");
            if($result1)
            {
               //echo "finish";
            }
         }

         $quest1="UPDATE filter_temp SET selected='0' WHERE id='allBread'";
         $ans1=mysqli_query($cn,$quest1) or die("cant update quest1");
         if($ans1)
         {
            //echo "end";
         }
      }
      //////
      //////
      $sql="SELECT * FROM products WHERE subcat IN ('$label')";

      $con=new mysqli($host,$user,$pswd,$db) or die("conerrr");
      $q_sub="SELECT * FROM filter_temp WHERE selected='1' AND label NOT IN ('All')";
      $re_sub=mysqli_query($con,$q_sub) or die("qerrr");
      $num_sub=mysqli_num_rows($re_sub);

      $q_all="SELECT * FROM filter_temp WHERE selected='1' AND label IN ('All')";
      $re_all=mysqli_query($con,$q_all) or die("qerrr");
      $num_all=mysqli_num_rows($re_all);

      if($num_sub>0)
      {
         $sql="SELECT * FROM products WHERE subcat IN (";
         while($y=mysqli_fetch_array($re_sub))
         {
            $more=strtolower($y['label']);
            $sql.="'$more'";
            $num_sub --;
            if($num_sub>0)
            {
               $sql.=",";
            }
         }
      }$sql.=")";
      //echo $sql;
      if($num_all>0)
      {
         $sql.=" OR prod_category IN (";
         while($t=mysqli_fetch_array($re_all))
         {
            $at=$t['cat'];
            $sql.="'$at'";
            $num_all --;
            if($num_all>0)
            {
               $sql.=",";
            }
         }$sql.=")";
      }
      $_SESSION['qry']=$sql;
   }
?>
