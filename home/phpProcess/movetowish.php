<?php
   session_start();
   $pid=$_POST["pid"];
   if(isset($_SESSION["username"]))
   {
      $cust_id=$_SESSION["userID"];
      $host="localhost";
      $user="root";
      $password="";
      $db="BuildItUp_customer";

      $con=new mysqli($host,$user,$password,$db) or die("error in connection");
      $q1="SELECT * FROM cart WHERE CustomerID='$cust_id' AND ProductID='$pid'";
      $res1=mysqli_query($con,$q1) or die("q1 error");
      if($res1)
      {
         while($row1=mysqli_fetch_array($res1))
         {
            //qry to check whether product already in wishlist
            $qry="SELECT * FROM wish WHERE CustomerID='$cust_id' AND ProductID='$pid'";
            $result=mysqli_query($con,$qry) or die("qry error");
            if($result)
            {
               $row_cnt=$result->num_rows;
               if($row_cnt>0)
               {//product already exists in wishlist
                     //echo "already in wishlist";
                     //query to update wishlist; since, user can change quantity and add to cart
                     $query="UPDATE wish SET ProductPrice=$row1[ProductPrice],Quantity=$row1[Quantity],
                      vegan=$row1[vegan],FinalPrice=$row1[FinalPrice] WHERE CustomerID='$cust_id' AND ProductID='$pid'";
                      $r=mysqli_query($con,$query) or die("query error");
                      if($r)
                      {
                         echo "updated";
                      }
               }
               else
               {//product is not already in wishlist
                  $q2="INSERT INTO wish(CustomerID,ProductID,ProductPrice,Quantity,vegan,FinalPrice)
                  VALUES($row1[CustomerID],$row1[ProductID],$row1[ProductPrice],$row1[Quantity],$row1[vegan],$row1[FinalPrice])";
                  $res2=mysqli_query($con,$q2) or die("q2 error");
                  if($res2)
                  {
                     echo "success";
                  }
               }
            }
            //query to add product to wishlist
         }
      }
      //query to delete product from cart
      $q3="DELETE FROM cart WHERE CustomerID='$cust_id' AND ProductID='$pid'";
      $res3=mysqli_query($con,$q3) or die("q3 error");
      if($res3)
      {
         echo "deleted";
      }
   }
?>
