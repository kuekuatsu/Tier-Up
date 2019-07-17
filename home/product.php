<?php
   session_start();
   date_default_timezone_set('Asia/Kolkata');
   if(isset($_SESSION["username"]))
   {
      $cid=$_SESSION["userID"];
      #user is logged in
      #echo "Welcome, ".$_SESSION["username"];
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

   $pid=$_SESSION['proID'];
   $host="localhost";
   $user="root";
   $pswd="";
   $db="BuildItUp";
   $db2="BuildItUp_Customer";
   $con=new mysqli($host,$user,$pswd,$db2) or die("Error in connection");

   $connect=new mysqli($host,$user,$pswd,$db) or die("failed connection");
   $query="SELECT * FROM products WHERE prod_id='$pid'";
   $result=mysqli_query($connect,$query) or die("query err");

   if($result)
   {
      //echo $pid;
      while($row=mysqli_fetch_array($result))
      {
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title><?php echo $row['prod_name']; ?></title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Raleway:600|Indie+Flower|Open+Sans|Allura|Berkshire+Swash|Comfortaa" rel="stylesheet">
      <link rel="stylesheet" href="css/product.css?version=12">
   </head>
   <body style="user-select:none;">
      <center>
         <form method="post" style="width:95%;">
            <br>
           <nav class="nav nav-tabs">
               <li class="nav-item">
                  <a class="myNav nav-link" href="index.php">Home</a>
               </li>
               <li class="nav-item" id="login">
                  <a class="myNav nav-link" href="login.php">Login</a>
               </li>
      <!--         <li class="nav-item">
                  <a class="myNav nav-link" href="#">Build</a>
               </li>-->
               <li class="nav-item">
                  <a class="myNav nav-link" href="wishlist.php">Wishlist <sup><span class="badge badge-secondary" id="wishes"></span></sup></a>
               </li>
               <li class="nav-item">
                  <a class="myNav nav-link" href="cart.php">Cart <sup><span class="badge badge-secondary" id="buy"></span></sup></a>
               </li>
               <li class="nav-item">
                  <a class="myNav nav-link" href="orders.php">Order</a>
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
                  header("Location:product.php");
               }
               else
               {#logout not clicked
               }
           ?>
           <br>
<div class="container-fluid">
   <div class="row no-gutters">
      <div class="col-md-6">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <img src="data:image;base64,<?php echo $row['prod_pic']; ?>" id="img" align="left">
               </div>
            </div>
            <?php
            if($row['prod_pic2']!=null)
            {
               ?>
               <br>
               <div class="row">
                  <div class="col-md-4">
                     <img src="data:image;base64,<?php echo $row['prod_pic2']; ?>" class="small" align="left">
                  </div>
                  <div class="col-md-4">
                     <!--<img src="data:image;base64,</?php echo $row['prod_pic3']; ?>" class="small" align="left">-->
                  </div>
                  <div class="col-md-4">

                  </div>
               </div>
               <?php
            }
            ?>
         </div>
      </div>
         <div class="col-md-6">
         <div class="container-fluid">
            <div id="stars" class="row no-gutters" style="font-size:19px;color:gray;">
               <?php
                  $me=$_SESSION['userID'];
                  $sql1="SELECT * FROM prod_rating WHERE pid='$pid'";
                  $res1=mysqli_query($con,$sql1) or die("sql1Err");
                  $n=mysqli_num_rows($res1);
                  $sum="";
                  if($n>0)
                  {
                     while($l1=mysqli_fetch_array($res1))
                     {
                        $sum=$sum+$l1['star'];
                     }
                     $avg=$sum/$n;
                     $avg=round($avg,1); //limit point to 1 digit
                     ?>
                  <div class="col-md-6">
                     <input type="hidden" id="avgRating" value="<?php echo $avg; ?>">
                     <b>Avg. Rating:</b>
                     <b id="s1">&#9733;</b>
                     <b id="s2">&#9733;</b>
                     <b id="s3">&#9733;</b>
                     <b id="s4">&#9733;</b>
                     <b id="s5">&#9733;</b>
                  </div>
                     <?php
                  }
                  else
                  {
                     ?>
                  <div class="col-md-6">
                     <b>Avg. Rating:</b>
                     <b id="s1">&#9733;</b>
                     <b id="s2">&#9733;</b>
                     <b id="s3">&#9733;</b>
                     <b id="s4">&#9733;</b>
                     <b id="s5">&#9733;</b>
                  </div>
                     <?php
                  }
               if(isset($_SESSION['userID']))
               {
                  $me=$_SESSION['userID'];
                  $sql="SELECT star FROM prod_rating WHERE cid='$me' AND pid='$pid'";
                  $r=mysqli_query($con,$sql) or die("eior");
                  if(mysqli_num_rows($r)==1)
                  {
                     while($l=mysqli_fetch_array($r))
                     {
                        if($l[0]==1)
                        {
                           $op="one";
                        }
                        else if($l[0]==2)
                        {
                           $op="two";
                        }
                        else if($l[0]==3)
                        {
                           $op="three";
                        }
                        else if($l[0]==4)
                        {
                           $op="four";
                        }
                        else if($l[0]==5)
                        {
                           $op="five";
                        }
                     ?>
                     <input type="hidden" class="<?php echo $pid; ?>" id="userRat" value="<?php echo $op ?>">
                     <?php
                     }
                  }
                  else
                  {
                     ?>
                     <input type="hidden" class="<?php echo $pid; ?>" id="userRat" value="<?php echo $op ?>">
                     <?php
                  }
                  ?>
               <div class="col-md-6">
                  <b>Your Rating:</b>
                  <b id="one">&#9733;</b>
                  <b id="two">&#9733;</b>
                  <b id="three">&#9733;</b>
                  <b id="four">&#9733;</b>
                  <b id="five">&#9733;</b>
               </div>
                  <?php
               }
               ?>
            </div>
            <div class="row no-gutters">
               <div class="col">
                  <?php
                  if($n>1)
                  {
                     ?>
                     <p style="color:gray;">(Rated by <?php echo $n ?> people)</p>
                     <?php
                  }
                  else if($n==1)
                  {
                     ?>
                     <p style="text-align:left;color:gray;">(Rated by <?php echo $n ?> person)</p>
                     <?php
                  }
                  else
                  {
                     ?>
                     <p style="text-align:left;color:gray;">(No ratings yet)</p>
                     <?php
                  }
                  ?>
               </div>
               <div class="col">

               </div>
            </div>
         </div>
            <div style="text-align:left">
              <h2 class='display-2'><?php echo $row['prod_name']; ?></h2>
              <h4 class='display-4'>&#x20B9 <?php echo $row['prod_amt']; ?></h4>
              <br>
              <p>
                 &emsp;<?php echo $row['prod_abt']; ?>
              </p>
           <?php
           $add=$row['lease'];
           //F=month,j=date,d(2 dig. date)=01-31,l=Saturday-Sunday,D=Mon/Sun,w(0-7)=Sunday-Saturday,m=01-12,M=Jan-Dec,n=1-12,t=no of days in month,
           //Y=1997,y=97,h=01-12hrs,i=minutes(00-59),s=seconds(00-59),a=am/pm
           $today=date("l, j F Y",strtotime($today.'+'.$add.' day'));
             if($row['prod_weight']!='null')
             {
                if($row['prod_quantity']>1)
                {
                   ?>
                   <!--weight and quantity given .eg.cupcakes-->
                   &emsp;This box of <?php echo $row['prod_quantity']?> <?php echo $row['prod_category'];?> weighs <?php echo $row['prod_weight'];?>
                   <br>
                   &emsp;
                   <h5><b>We can delviver to you fastest by:</b> <?php echo $today ?> </br>(You can change the date on checkout if you want a later date)</h5>
                   <?php
                }
                else
                {
                   ?>
                   <!--only weight is given .eg.cake-->
                   &emsp;This <?php echo $row['prod_category'];?> weighs <?php echo $row['prod_weight'];?>
                   <br>
                   &emsp;<h5><b>Delivery by:</b> <?php echo $today ?> </br>(You can change the date on checkout if you want a later date)</h5>
                   <?php
                }
             }
             else
             {
                if($row['prod_quantity']>1)
                {
                   ?>
                   <!--weight not given and quantity more than 1 .eg.cupcakes-->
                   &emsp;This is a box of <?php echo $row['prod_quantity']?> <?php echo $row['prod_category'];?>s
                   <br>
                   &emsp;<h5><b>Delivery by:</b> <?php echo $today ?> </br>(You can change the date on checkout if you want a later delivery date)</h5>
                   <?php
                }
                else
                {
                   ?>
                   <!--weight not given and quantity is 1-->
                   Quantity: <?php echo $row['prod_quantity']?>
                   <br>
                   &emsp;<h5><b>Delivery by:</b> <?php echo $today ?> </br>(You can change the date on checkout if you want a later delivery date)</h5>
                   <?php
                }
             }
           ?>
        </div>
        <br><br>
       <div class="row">
          <div class="col col-sm-6">
             <?php
                if(isset($cid))
                {
                   $a="SELECT * FROM wish WHERE CustomerID='$cid' AND ProductID='$row[prod_id]'";
                   $b=mysqli_query($con,$a) or die("Aer");
                   if(mysqli_num_rows($b)>0)
                   {
                      ?>
                       <button type="button" id="<?php echo $row['prod_id']?>" class="remwish btn btn-lg" name="Wishlist" style="width:100%"><b>&#10003</b> Wishlist</button>
                      <?php
                   }
                   else
                   {
                      ?>
                      <button type="button" id="<?php echo $row['prod_id']?>" class="addto wish btn btn-primary btn-lg" name="Wishlist" style="width:100%"><b>&#43</b> Wishlist</button>
                      <?php
                   }
                }
                else
                {
             ?>
             <button type="button" id="<?php echo $row['prod_id']?>" class="addto wish btn btn-primary btn-lg" name="Wishlist" style="width:100%"><b>&#43</b> Wishlist</button>
             <?php
                }
             ?>
          </div>
          <div class="col col-sm-6">
             <?php
                if(isset($cid))
                {
                   $a="SELECT * FROM cart WHERE CustomerID='$cid' AND ProductID='$row[prod_id]'";
                   $b=mysqli_query($con,$a) or die("Aer");
                   if(mysqli_num_rows($b)>0)
                   {
                      ?>
                      <button type="button" id="<?php echo $row['prod_id']?>" class="remcart btn btn-lg" name="Cart" style="width:100%"><b>&#10003</b> Cart</button>
                      <?php
                   }
                   else
                   {
                      ?>
                   <button type="button" id="<?php echo $row['prod_id']?>" class="addto cart btn btn-primary btn-lg" name="Cart" style="width:100%"><b>&#43</b> Cart</button>
                   <?php
                }
             }
             else
             {
                ?>
                <button type="button" id="<?php echo $row['prod_id']?>" class="addto cart btn btn-primary btn-lg" name="Cart" style="width:100%"><b>&#43</b> Cart</button>
                <?php
             }
          ?>
          </div>
         </div>
       </div>
       </div>
    </div>
    <?php
          }
       }
       mysqli_close($connect);
    ?>
    <br><br>
    <?php
      $host="localhost";
      $user="root";
      $pswd="";
      $db="BuildItUp_Customer";

      //$name=$_SESSION["username"];
      $c=mysqli_connect($host,$user,$pswd,$db) or die("Con error");
      $q="SELECT * FROM prod_review WHERE prod_id='$pid'";
      $result=mysqli_query($c,$q) or die("q error");
      if($result)
      {
         while($line=mysqli_fetch_array($result))
         {
    ?>
       <div class="row" id="review" style="width:100%;">
          <div class="container-fluid">
             <div class="row">
                <p class="col" style="margin-bottom:0px;text-align:left"><?php echo $line['user'] ?></p>
                <p class="col" style="margin-bottom:0px;text-align:right;"><?php echo $line['datet'] ?></p>
             </div>
             <div class="row" style="border:1px solid gray;border-radius:0px 17px 17px 17px;">
               <p style="text-align:left;margin-left:20px;margin-top:10px;"><?php echo $line['review'] ?></p>
            </div>
          </div>
       </div>
       <?php
          }
      }
      mysqli_close($c);
      ?>
       <br><br>
       <div style="height:10vmin;border-radius:17px 0px 17px 17px;">
          <input type="text" id="r" style="width:100%;height:100%;border-radius:17px 0px 17px 17px;" placeholder="Write a review">
          <p align="right" style="font-size:2em;margin-top:0px;margin-right:2vmin;">
             <input type="button" id="write" value="&#10148">
          </p>
       </div>
    </div>
    <script type="text/javascript">
         $('#write').click(function(){
            var rev=$("#r").val();
            $.ajax({
               type:'post',
               url:'phpProcess/addReview.php',
               data:{'rev':rev},
               success:function(data)
               {
                  if(data=="success")
                  {
                     window.location.reload();
                  }
                  else
                  {
                     alert(data);
                  }
               }
            });
         });
    </script>
    <br><br><br>
         </form>
      </center>
   </body>
</html>
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

   //AddToWishlist
      $('.wish').click(function(){
         var id=$(this).attr("id");
         $.ajax({
            url:"phpProcess/wishProcess.php",
            type:"POST",
            data:{'id':id},
            success:function(data){
               if(data!="success")
               {
                  alert(data);
               }
               window.location.reload();
            }
         });
      });
   //AddToCart
      $('.cart').click(function(){
         var id=$(this).attr("id");
         $.ajax({
            url:"phpProcess/cartProcess.php",
            type:"POST",
            data:{'id':id},
            success:function(data){
               if(data!="success")
               {
                  alert(data);
               }
               window.location.reload();
            }
         });
      });
      //RemoveFromWishlist
         $('.remwish').click(function(){
            var id=$(this).attr("id");
            $.ajax({
               url:"phpProcess/removeWish.php",
               type:"POST",
               data:{'id':id},
               success:function(data){
                  if(data!="success")
                  {
                     alert(data);
                  }
                  window.location.reload();
               }
            });
         });
      //RemoveFromCart
         $('.remcart').click(function(){
            var id=$(this).attr("id");
            $.ajax({
               url:"phpProcess/removeCart.php",
               type:"POST",
               data:{'id':id},
               success:function(data){
                  if(data!="success")
                  {
                     alert(data);
                  }
                  window.location.reload();
               }
            });
         });
         $('.small').mouseover(function(){
            $('.small').css({"height":"35vw","width":"35vw"});
         });
         $('.small').mouseout(function(){
            $('.small').css({"height":"10vw","width":"10vw"});
         });
//star ui

   $('#one').click(function(){
      $('#five').css("font-size","19px");
      $('#two').css("font-size","19px");
      $('#three').css("font-size","19px");
      $('#four').css("font-size","19px");
      $('#one').css("font-size","23px");

      $('#one').css("color","gold");
      $('#two').css("color","gray");
      $('#three').css("color","gray");
      $('#four').css("color","gray");
      $('#five').css("color","gray");

      var pid=$('#userRat').attr('class');
      var rate="1";
      $.ajax({
         type:'post',
         url:'phpProcess/saveStar.php',
         data:{'rate':rate,'pid':pid},
         success:function(data)
         {
            if(data=="success")
            {
               window.location.reload();
            }
            else
            {
               alert(data);
            }
         }
      });
   });
   $('#two').click(function(){
      $('#one').css("font-size","19px");
      $('#five').css("font-size","19px");
      $('#three').css("font-size","19px");
      $('#four').css("font-size","19px");
      $('#two').css("font-size","23px");

      $('#one').css("color","gold");
      $('#two').css("color","gold");
      $('#three').css("color","gray");
      $('#four').css("color","gray");
      $('#five').css("color","gray");

      var pid=$('#userRat').attr('class');
      var rate="2";
      $.ajax({
         type:'post',
         url:'phpProcess/saveStar.php',
         data:{'rate':rate,'pid':pid},
         success:function(data)
         {
            if(data=="success")
            {
               window.location.reload();
            }
            else
            {
               alert(data);
            }
         }
      });
   });
   $('#three').click(function(){
      $('#one').css("font-size","19px");
      $('#two').css("font-size","19px");
      $('#five').css("font-size","19px");
      $('#four').css("font-size","19px");
      $('#three').css("font-size","23px");

      $('#one').css("color","gold");
      $('#two').css("color","gold");
      $('#three').css("color","gold");
      $('#four').css("color","gray");
      $('#five').css("color","gray");

      var pid=$('#userRat').attr('class');
      var rate="3";
      $.ajax({
         type:'post',
         url:'phpProcess/saveStar.php',
         data:{'rate':rate,'pid':pid},
         success:function(data)
         {
            if(data=="success")
            {
               window.location.reload();
            }
            else
            {
               alert(data);
            }
         }
      });
   });
   $('#four').click(function(){
      $('#one').css("font-size","19px");
      $('#two').css("font-size","19px");
      $('#three').css("font-size","19px");
      $('#five').css("font-size","19px");
      $('#four').css("font-size","23px");

      $('#one').css("color","gold");
      $('#two').css("color","gold");
      $('#three').css("color","gold");
      $('#four').css("color","gold");
      $('#five').css("color","gray");

      var pid=$('#userRat').attr('class');
      var rate="4";
      $.ajax({
         type:'post',
         url:'phpProcess/saveStar.php',
         data:{'rate':rate,'pid':pid},
         success:function(data)
         {
            if(data=="success")
            {
               window.location.reload();
            }
            else
            {
               alert(data);
            }
         }
      });
   });
   $('#five').click(function(){
      $('#one').css("font-size","19px");
      $('#two').css("font-size","19px");
      $('#three').css("font-size","19px");
      $('#four').css("font-size","19px");
      $('#five').css("font-size","23px");

      $('#one').css("color","gold");
      $('#two').css("color","gold");
      $('#three').css("color","gold");
      $('#four').css("color","gold");
      $('#five').css("color","gold");

      var pid=$('#userRat').attr('class');
      var rate="5";
      $.ajax({
         type:'post',
         url:'phpProcess/saveStar.php',
         data:{'rate':rate,'pid':pid},
         success:function(data)
         {
            if(data=="success")
            {
               window.location.reload();
            }
            else
            {
               alert(data);
            }
         }
      });
   });
$(document).ready(function(){
   var id=$('#userRat').val();
   $('#'+id).css("color","gold");
   $('#'+id).css("font-size","23px");
   if(id=="two")
   {
      $('#one').css("color","gold");
   }
   else if(id=="three")
   {
      $('#one').css("color","gold");
      $('#two').css("color","gold");
   }
   else if(id=="four")
   {
      $('#one').css("color","gold");
      $('#two').css("color","gold");
      $('#three').css("color","gold");
   }
   else if(id=="five")
   {
      $('#one').css("color","gold");
      $('#two').css("color","gold");
      $('#three').css("color","gold");
      $('#four').css("color","gold");
   }
});
//set Avg Rating
$(document).ready(function(){
   var average=$('#avgRating').val();
   //alert(average);
   if(average.includes("."))
   {
      var avg=average.split('.');
      if(avg[1]>5)
      {
         var average=Math.ceil(average);
      }
      else
      {
         var average=Math.floor(average);
      }
   }
   //alert(average);
   if(average=="1")
   {
      $('#s'+average).css("color","gold");
      $('#s'+average).css("font-size","23px");
   }
   else if(average=="2")
   {
      $('#s'+average).css("color","gold");
      $('#s'+average).css("font-size","23px");

      $('#s1').css("color","gold");
   }
   else if(average=="3")
   {
      $('#s'+average).css("color","gold");
      $('#s'+average).css("font-size","23px");

      $('#s1').css("color","gold");
      $('#s2').css("color","gold");
   }
   else if(average=="4")
   {
      $('#s'+average).css("color","gold");
      $('#s'+average).css("font-size","23px");

      $('#s1').css("color","gold");
      $('#s2').css("color","gold");
      $('#s3').css("color","gold");
   }
   else if(average=="5")
   {
      $('#s'+average).css("color","gold");
      $('#s'+average).css("font-size","23px");

      $('#s1').css("color","gold");
      $('#s2').css("color","gold");
      $('#s3').css("color","gold");
      $('#s4').css("color","gold");
   }
});
</script>
