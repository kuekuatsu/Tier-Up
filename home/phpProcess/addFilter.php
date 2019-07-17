<?php
date_default_timezone_set('Asia/Kolkata');
   $label=$_POST['label'];
   $id=$_POST['ID'];

   $host="localhost";
   $user="root";
   $pswd="";
   $db="BuildItUp_Other";
   $con=new mysqli($host,$user,$pswd,$db) or die("Error in connecting BuildItUp_Other db");

   if($label=="All")
   {
      if($id=="allCake")
      {
         $q1="UPDATE filter_temp SET selected='0' WHERE cat='cake'";
         $r1=mysqli_query($con,$q1) or die("cant update q1");
         if($r1)
         {
            echo "done";
         }

         $qry1="UPDATE filter_temp SET selected='1' WHERE id='allCake'";
         $res1=mysqli_query($con,$qry1) or die("cant update qry1");
         if($res1)
         {
            echo "success";
         }
      }
      elseif($id=="allCup")
      {
         $q2="UPDATE filter_temp SET selected='0' WHERE cat='cupcake'";
         $r2=mysqli_query($con,$q2) or die("cant update q2");
         if($r2)
         {
            echo "done";
         }

         $qry2="UPDATE filter_temp SET selected='1' WHERE id='allCup'";
         $res2=mysqli_query($con,$qry2) or die("cant update qry2");
         if($res2)
         {
            echo "success";
         }
      }
      elseif($id=="allCookie")
      {
         $q3="UPDATE filter_temp SET selected='0' WHERE cat='cookie'";
         $r3=mysqli_query($con,$q3) or die("cant update q3");
         if($r3)
         {
            echo "done";
         }

         $qry3="UPDATE filter_temp SET selected='1' WHERE id='allCookie'";
         $res3=mysqli_query($con,$qry3) or die("cant update qry3");
         if($res3)
         {
            echo "success";
         }
      }
      elseif($id=="allBread")
      {
         $q4="UPDATE filter_temp SET selected='0' WHERE cat='bread'";
         $r4=mysqli_query($con,$q4) or die("cant update q4");
         if($r4)
         {
            echo "done";
         }

         $qry4="UPDATE filter_temp SET selected='1' WHERE id='allBread'";
         $res4=mysqli_query($con,$qry4) or die("cant update qry4");
         if($res4)
         {
            echo "success";
         }
      }
   }
   else
   {
      if(strpos($id,'Cake')!==FALSE)
      {
         $check1="SELECT * FROM filter_temp WHERE id='$id'";
         $return1=mysqli_query($con,$check1) or die("cant find check1");
         if($return1->num_rows > 0)
         {
            $sql1="UPDATE filter_temp SET selected='1' WHERE id='$id'";
            $result1=mysqli_query($con,$sql1) or die("cant update sql1");
            if($result1)
            {
               echo "finish";
            }
         }
         else
         {
            $sql1="INSERT INTO filter_temp VALUES('$label','cake','$id','1')";
            $result1=mysqli_query($con,$sql1) or die("cant insert sql1");
            if($result1)
            {
               echo "finish";
            }
         }

         $quest1="UPDATE filter_temp SET selected='0' WHERE id='allCake'";
         $ans1=mysqli_query($con,$quest1) or die("cant update quest1");
         if($ans1)
         {
            echo "end";
         }
      }
      elseif(strpos($id,'Cup')!==FALSE)
      {
         $check1="SELECT * FROM filter_temp WHERE id='$id'";
         $return1=mysqli_query($con,$check1) or die("cant find check1");
         if($return1->num_rows > 0)
         {
            $sql1="UPDATE filter_temp SET selected='1' WHERE id='$id'";
            $result1=mysqli_query($con,$sql1) or die("cant update sql1");
            if($result1)
            {
               echo "finish";
            }
         }
         else
         {
            $sql1="INSERT INTO filter_temp VALUES('$label','cupcake','$id','1')";
            $result1=mysqli_query($con,$sql1) or die("cant insert sql1");
            if($result1)
            {
               echo "finish";
            }
         }

         $quest1="UPDATE filter_temp SET selected='0' WHERE id='allCup'";
         $ans1=mysqli_query($con,$quest1) or die("cant update quest1");
         if($ans1)
         {
            echo "end";
         }
      }
      elseif(strpos($id,'Cookie')!==FALSE)
      {
         $check1="SELECT * FROM filter_temp WHERE id='$id'";
         $return1=mysqli_query($con,$check1) or die("cant find check1");
         if($return1->num_rows > 0)
         {
            $sql1="UPDATE filter_temp SET selected='1' WHERE id='$id'";
            $result1=mysqli_query($con,$sql1) or die("cant update sql1");
            if($result1)
            {
               echo "finish";
            }
         }
         else
         {
            $sql1="INSERT INTO filter_temp VALUES('$label','cookie','$id','1')";
            $result1=mysqli_query($con,$sql1) or die("cant insert sql1");
            if($result1)
            {
               echo "finish";
            }
         }

         $quest1="UPDATE filter_temp SET selected='0' WHERE id='allCookie'";
         $ans1=mysqli_query($con,$quest1) or die("cant update quest1");
         if($ans1)
         {
            echo "end";
         }
      }
      elseif(strpos($id,'Bread')!==FALSE)
      {
         $check1="SELECT * FROM filter_temp WHERE id='$id'";
         $return1=mysqli_query($con,$check1) or die("cant find check1");
         if($return1->num_rows > 0)
         {
            $sql1="UPDATE filter_temp SET selected='1' WHERE id='$id'";
            $result1=mysqli_query($con,$sql1) or die("cant update sql1");
            if($result1)
            {
               echo "finish";
            }
         }
         else
         {
            $sql1="INSERT INTO filter_temp VALUES('$label','bread','$id','1')";
            $result1=mysqli_query($con,$sql1) or die("cant insert sql1");
            if($result1)
            {
               echo "finish";
            }
         }

         $quest1="UPDATE filter_temp SET selected='0' WHERE id='allBread'";
         $ans1=mysqli_query($con,$quest1) or die("cant update quest1");
         if($ans1)
         {
            echo "end";
         }
      }
   }
?>
