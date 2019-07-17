<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Orders</title>
      <link href="https://fonts.googleapis.com/css?family=Dosis:300|Raleway:600|Open+Sans|Raleway:600|Berkshire+Swash|Comfortaa|Courgette|Lobster+Two|Merienda|Playball|Satisfy|Sofia|Englebert" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <style type="text/css">
        body{
           font-family:'Raleway',sans-serif;
           font-weight:bolder;
           font-size:20px;
        }
        #buttonLogout
        {
           border:none;
           background-color:white;
           color:rgb(0,123,255);
           font-family:'Raleway',sans-serif;
           font-weight:bolder;
        }
        a:link
        {
           color:rgb(0,123,255);
           text-decoration:none;
           font-family:'Raleway',sans-serif;
           font-weight:bolder;
        }
        a:visited
        {
           color:rgb(0,123,255);
           text-decoration:none;
           font-family:'Raleway',sans-serif;
           font-weight:bolder;
        }
        a:hover
        {
           color:rgb(0,123,255);
           text-decoration:none;
           font-family:'Raleway',sans-serif;
           font-weight:bolder;
        }
        a:active
        {
           color:rgb(0,123,255);
           text-decoration:none;
           font-family:'Raleway',sans-serif;
           font-weight:bolder;
        }

        </style>
   </head>
   <body>
<?php
date_default_timezone_set('Asia/Kolkata');
   session_start();
   $_SESSION['iAmAt']="orders.php";

   if(isset($_SESSION["username"]))
   {
      #user is logged in
      //echo " Welcome, ".$_SESSION["username"];
      echo "<style>";
      echo "
      #login{
         display:none;
      }";
      echo "</style>";
   }
   else
   {
      #user is not logged in
      echo "<style>";
      echo "
      #logout{
         display:none;
      }";
      echo "</style>";
   }
   if(!isset($_SESSION["userID"]))
   {
      ?>
      <br><br><br><br>
         <div class="container">
            <div class="row justify-content-center">
               <div class="col">
                  Oops Something Went Wrong<br>
                  Have You tried Logging in yet <a href="login.php">Login</a>
               </div>
            </div>
         </div>
      <?php
   }
   else
   {
      ?>
      <form method="post">
      <nav class="nav nav-tabs" style='font-size:20px'>
          <li class="nav-item">
             <a class="myNav nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item" id="login">
             <a class="myNav nav-link" href="login.php">Login</a>
          </li>
       <!--   <li class="nav-item">
             <a class="myNav nav-link" href="#">Build</a>
          </li>-->
          <li class="nav-item">
             <a class="myNav nav-link" href="wishlist.php">Wishlist <sup><span class="badge badge-secondary" id="wishes"></span></sup></a>
          </li>
          <li class="nav-item">
             <a class="myNav nav-link" href="cart.php">Cart <sup><span class="badge badge-secondary" id="buy"></span></sup></a>
          </li>
          <li class="nav-item">
             <a class="myNav nav-link active">Order</a>
          </li>
          <li class="nav-item" id="logout">
             <input class="myNav nav-link" type="submit" name="logout" value="Logout" id="buttonLogout">
          </li>
       </nav>
       <?php
           if(isset($_POST["logout"]))
           {#logout clicked
              unset($_SESSION['username']);
              unset($_SESSION['userID']);
              header("Location:index.php");
           }
           else
           {#logout not clicked
           }
       ?><br>
      <?php
      $custom=$_SESSION["userID"];
      $host="localhost";
      $user="root";
      $pswd="";
      $db="BuildItUp";

      $con=new mysqli($host,$user,$pswd,$db) or die("conE");
      $q="SELECT * FROM orderlist WHERE cid='$custom' AND deliveredYet='0' GROUP BY ord_date";
      $r=mysqli_query($con,$q) or die("qE");
      if($r)
      {
         if(mysqli_num_rows($r)>0)
         {
         while($l=mysqli_fetch_array($r))
         {
            if($l['status']=="paid")
            {
               echo "<div class='container' style='background-color:rgb(245,245,245)'>";
            }
            else
            {
               echo "<div class='container' style='border:1px solid black;'>";
            }
         ?>

            <div class="row justify-content-between">
               <div class="col-md-6">
                  <h5><?php
                   //echo $l[0];
                   echo "Order placed on: ";
                   echo date("d F, y",strtotime($l[ord_date]));
                   echo " at ";
                   echo date("H:i a",strtotime($l[ord_date]));
                   ?></h5>
               </div>
               <?php
               if($l['status']=="paid")
               {
                  ?>
                  <div class="col-md-2" style="text-align:center;border:1px dashed black;">
                     <h2 class="display-4">Paid</h2>
                  </div>
                  <?php
               }
               else
               {}
               ?>
            </div><br>
            <?php
               $m="SELECT * FROM orderlist WHERE ord_date='$l[ord_date]' AND cid='$custom'";
               $n=mysqli_query($con,$m) or die("mE");
               if($n)
               {
                  while($o=mysqli_fetch_array($n))
                  {
                     $x="SELECT * FROM products WHERE prod_id='$o[pid]'";
                     $y=mysqli_query($con,$x) or die("xE");
                     if($y)
                     {
                        while($z=mysqli_fetch_array($y))
                        {
                           ?>
                           <div class="row">
                              <div class="col align-self-center">
                                 <img src="data:image;base64,<?php echo $z['prod_pic']; ?>" style="height:15vmin;width:15vmin;border-radius:7px 7px 7px 7px;">
                              </div>
                              <div class="col align-self-center">
                                 <?php echo $z['prod_name'] ?>
                              </div>
                              <div class="col align-self-center">
                                 <?php echo $o['pqty'] ?>
                              </div>
                              <div class="col align-self-center">
                                 <?php
                                 if($o['pveg']==1)
                                 {
                                    echo "Eggless";
                                 }
                                 else
                                 {
                                    echo "Contains Egg";
                                 }
                                 ?>
                              </div>
                              <div class="col align-self-center">
                                 <b>Delivery on:</b>
                                 <?php echo date("d F, Y",strtotime($o['del_date'])) ?>
                              </div>
                              <div class="col align-self-center">
                                 <?php echo $o['ptot'] ?>
                              </div>
                              <div class="col align-self-center">
                                 <?php
                                 if($o['deliveredYet']==0)
                                 {
                                    echo "Order Placed";
                                 }
                                 else
                                 {
                                    echo "<h4>";
                                    echo "Order Delivered</h4>";
                                 }
                                 ?>
                              </div>
                                 <?php $bid=$o['blendID'] ?>
                           </div><hr>
                           <?php
                        }
                     }
                  }
                  //echo $bid;
                  $t="SELECT * FROM blend WHERE id='$bid'";
                  $u=mysqli_query($con,$t) or die("tE");
                  if($u)
                  {
                     while($v=mysqli_fetch_array($u))
                     {
                        ?>
                        <div class="container">
                           <div class="row justify-content-end">
                              <div class="col-md-2">
                                 Shipping:
                              </div>
                              <div class="col-md-2">
                                 <?php echo $v['ship'] ?>
                              </div>
                           </div>
                           <div class="row justify-content-end">
                              <div class="col-md-2">
                                 Offer:
                              </div>
                              <div class="col-md-2">
                                 <?php echo $v['offer'] ?>
                              </div>
                           </div>
                           <div class="row justify-content-end">
                              <div class="col-md-2">
                                 Total:
                              </div>
                              <div class="col-md-2">
                                 <?php echo $v['cost'] ?>
                              </div>
                           </div>
                           <br>
                        </div>
                        <?php
                     }
                  }
               }
            ?>
         </div>
         <br>
         <?php
         }
      }
      else
      {
         echo "<div class='container' style='font-size:2em;'>";
         echo "<div class='row justify-content-center'>";
         echo "<div class='col-md-5' style='text-align:center'>";
         echo "No pending Orders";
         echo "</div></div></div>";
      }
      }
   }
?>
   </form>
   <script type="text/javascript">
   //NoOfItemsIn
      $(document).ready(function(){
         //WishlistCount
         $.ajax({
            url:"phpProcess/countWish.php",
            type:"post",
            success:function(data){
               if(data>0)
               {
                  $('#wishes').text(data);
               }
            }
         });
         //CartCount
         $.ajax({
            url:"phpProcess/countCart.php",
            type:"post",
            success:function(data){
               if(data>0)
               {
                  $('#buy').text(data);
               }
            }
         });
      });
   </script>
   </body>
</html>
