<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Thank You</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
      <script type="text/javascript">
         function printPage(){
            window.print();
         }
      </script>
      <style>
         body{
            font-size:3vmin;
         }
      .loader {
        	position: fixed;
        	left: 0px;
        	top: 0px;
        	width: 100%;
        	height: 100%;
        	z-index: 9;
        	background: url('images/pie.gif') 50% 50% no-repeat rgb(249,249,249);
        }
      </style>
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript">
  $(window).load(function() {
  	$(".loader").fadeOut("slow");
  })
  </script>
   </head>
   <body>
      <div class="loader"></div>
<?php
error_reporting(E_ALL);
   session_start();
date_default_timezone_set('Asia/Kolkata');

   $cid=$_SESSION["userID"];
   $offer=$_SESSION["offer"];
   $type=$_SESSION["paymentType"];
   $total="";
   if(!isset($type))
   {
      ?>
      <br><br><br><br>
         <div class="container">
            <div class="row justify-content-center">
               <div class="col">
                  Unauthorized Access<br>
                  Go to the <a href="index.php">Home</a> page
               </div>
            </div>
         </div>
      <?php
   }
   else
   {
?>
<ul class="nav justify-content-end">
   <li class="nav-item">
      <a class="nav-link">Review Order
      </a>
   </li>
   <li class="nav-item" id="opt">
      <a class="nav-link">Card Details
      </a>
   </li>
   <li class="nav-item active">
      <a class="nav-link">Order Placed
         <hr style="background-color:blue;height:0.5px;">
      </a>
   </li>
</ul>
      <form>
         <br><br>
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-md-10" style="border:1px solid black;text-align:center;border-radius:5px;">
                  <br>
                  <?php
                     $host="localhost";
                     $user="root";
                     $pswd="";
                     $db="BuildItUp";

                     $c=new mysqli($host,$user,$pswd,$db) or die("aghh");
                     $q1="SELECT * FROM blend WHERE cid='$cid'";
                     $r1=mysqli_query($c,$q1) or die("q1 dead");
                     if($r1)
                     {
                        while($row=mysqli_fetch_array($r1))
                        {
                           $amt=$row['cost'];
                           $ship=$row['ship'];
                        }
                     }
                  ?>
                  <h5>
                     &#x20B9 <?php echo $amt ?> has been successfully deducted from your <?php echo $type ?> card
                  </h5>
                  <h1 class="display-1">THANK YOU!</h1>
                  <h3 class="display-4">Your order is placed</h3>
                  <br><br>
                  <div class="row" style="font-weight:bold;border-bottom:1px solid black;">
                     <div class="col">Pic</div>
                     <div class="col">Name</div>
                     <div class="col">Price</div>
                     <div class="col">Quantity</div>
                     <div class="col">Vegan</div>
                     <div class="col">Delivery</div>
                     <div class="col">Total</div>
                  </div>
                  <?php
                     $q2="SELECT * FROM orderlist WHERE cid='$cid' AND deliveredYet='0'";
                     $r2=mysqli_query($c,$q2) or die("q2 dead");
                     if($r2)
                     {
                        while($line=mysqli_fetch_array($r2))//orderlist
                        {
                           $pro=$line['pid'];
                           $q3="SELECT * FROM products WHERE prod_id='$pro'";
                           $r3=mysqli_query($c,$q3) or die("q3 dead");
                           if($r3)
                           {
                              while($p=mysqli_fetch_array($r3))//products
                              {
                  ?><br>
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col"><img src="data:image;base64,<?php echo $p['prod_pic']; ?>" height="80px" width="80px"></div>
                           <div class="col"><?php echo $p['prod_name']; ?></div>
                           <div class="col"><?php echo $p['prod_amt']; ?></div>
                           <div class="col"><?php echo $line['pqty']; ?></div>
                           <div class="col">
                           <?php
                              if($line['pveg']==0)
                              {
                                 echo "&#10007";
                              }
                              else
                              {
                                 echo "&#10003";
                              }
                           ?>
                           </div>
                           <div class="col">
                              <?php $got=$line['del_date'];
                                 echo date("j M, Y",strtotime($got));
                              ?>
                           </div>
                           <div class="col">
                              <?php echo $line['ptot'] ?>
                           </div>
                        </div>
                     </div>
                  <?php
                  $total=$total+$line['ptot'];
                              }
                           }
                        }
                     }
                  ?>
                  <div class="container-fluid">
                     <div class="row justify-content-end">
                        <div class="col-md-6" style="background-color:rgb(245,245,245);">
                           <div class="container-fluid">
                              <br>
                              <div class="row">
                                 <div class="col-md-6">
                                    Total Amount Spent:
                                 </div>
                                 <div class="col-md-6">
                                    <?php echo $total; ?>
                                 </div>
                              </div>
                              <hr><br>
                              <div class="row">
                                 <div class="col-md-6">
                                    Current Order Charges:
                                 </div>
                                 <div class="col-md-6">
                                    <h4>&#x20B9 <?php echo $amt; ?></h4>
                                 </div>
                              </div>
                              <br>
                              <div class="row">
                                 <div class="col-md-6">
                                    Includes Shipping Charges:
                                 </div>
                                 <div class="col-md-6">
                                    <?php echo $ship; ?>
                                 </div>
                              </div>
                              <br>
                              <div class="row">
                                 <div class="col-md-6">
                                    And Offer Availed:
                                 </div>
                                 <div class="col-md-6">
                                    <?php echo $offer; ?>
                                 </div>
                              </div>
                              <br>
                           </div>
                        </div>
                     </div>
                  </div>
                  <br><br>
                  <input type="button" class="btn-primary" value="Print this page" onclick="printPage()">
                  <br><br>
                  <a href="<?php echo $_SESSION['iAmAt'] ?>">Continue Browsing</a>
                  <?php
                     unset($_SESSION["paymentType"]);
                     unset($_SESSION['pay']);
                     unset($_SESSION['type']);
                  }
                  ?>
                  <br>
               </div>
            </div>
         </div>
      </form>
   </body>
</html>
