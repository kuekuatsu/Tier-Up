<!doctype html>
<?php
date_default_timezone_set('Asia/Kolkata');
   session_start();
   $_SESSION['iAmAt']="index.php";
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
?>
<html lang="en">
  <head>
    <title>Home</title>
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/indexStyle.css?version=21" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Raleway:600|Bubblegum+Sans|Allura|Berkshire+Swash|Comfortaa|Courgette|Raleway|Lobster+Two|Merienda|Playball|Satisfy|Sofia|Englebert" rel="stylesheet">
    <!--_Indie+Flower|Allura|Berkshire+Swash|Comfortaa|Courgette|Lobster+Two|Merienda|Playball|Satisfy-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  </head>
  <body>
     <form method="post">
        <nav class="nav nav-tabs">
            <li class="nav-item">
               <a class="myNav nav-link active">Home</a>
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
               header("Location:index.php");
            }
            else
            {#logout not clicked
            }
        ?>
        <div id="wrap">    <!--GET rid of the selection by mouse thing-->
           <?php
           $h="localhost";
           $u="root";
           $p="";
           $db="BuildItUp";
           $c=new mysqli($h,$u,$p,$db) or die("dead");

           $q="SELECT * FROM products WHERE prod_id=(SELECT MAX(prod_id) FROM products)";
           $r=mysqli_query($c,$q) or die("qdie");
           if($r)
           {
             while($l=mysqli_fetch_array($r))
             {
                echo "<img src='data:image;base64,".$l[prod_pic]."' name='".$l[prod_id]."' class='img-fluid' id='first'>";
             }
           }
           ?>
             <!--<img src="images/lg.jpg" class="img-fluid" id="first">-->
            <!--<div class="center">Shushh.. Our Secret ingredient is Love</div>-->
            <div class="center">Checkout what's new?</div>
           <img src="images/edit.png" class="img-fluid" id="second">
        </div>
     </form>
     <div id="div_filter">
        <p>And They Say You Can't Buy Happiness</p>
        <div class="container">
           <div class="row">
              <div id="cakes" class="col icon_div">
                 <a href="cakePage.php"><img src="images/cakeIt.png" class="filter_category"></a>
                 <br>Cake
              </div>
              <div id="cookies" class="col icon_div">
                 <a href="cookiePage.php"><img src="images/coo.png" class="filter_category"></a>
                 <br>Cookie
               <!--  <div>Cookies</div>      -->
              </div>
              <div id="cupcakes" class="col icon_div">
                 <a href="cupcakePage.php"><img src="images/cup.png" class="filter_category"></a>
                 <br>Cupcake
         <!--        <div>Cupcakes</div>        -->
              </div>
              <div id="bread" class="col icon_div">
                 <a href="breadPage.php"><img src="images/breadIcon1.png" class="filter_category"></a>
                 <br>Bread
         <!--        <div>Bread</div>        -->
              </div>
           </div>
        </div>
     </div>
     <div id="about">
        <!--Add the about as well as the contact details here-->
        <br><br><br><br><br><br>
        <form action="index.html" method="post">
           <div class="container-fluid">
              <div class="row">
                 <div class="col" style="border-right:1px solid black;">
                    <div class="container-fluid">
                       <div class="row justify-content-center">
                          Be upto date with all our latest offers
                       </div>
                     <!--  <div class="row justify-content-center">
                          Get special discounts *Only for members
                       </div> -->
                       <div class="row justify-content-center">
                          Celebrate your birthday with exciting deals
                       </div>
                       <div class="row justify-content-center">
                          Sign up today for our newsletter
                       </div><br>
                       <div class="row justify-content-center">
                          <input type="text" id="dob" placeholder="&#127874; dd-mm-yyyy" style="font-weight:bold;border-radius:10px 10px 10px 10px">
                          <br>
                          <div id="dMsg"></div>
                       </div><br>
                       <div class="row justify-content-center">
                            <input type="text" id="mail" placeholder=" Email ID" style="border-radius:10px 10px 10px 10px;font-weight:bold;">
                            <br>
                            <div id="mMsg"></div>
                       </div><br>
                       <div class="row justify-content-center">
                            <input type="button" class="btn btn-primary" id="news" value="Signup for Newsletter" style="font-weight:bold;border-radius:10px 10px 10px 10px;">
                       </div>
                    </div>
                 </div>
                 <div class="col">
                    <br>
                    About Us:
                    <p style="font-size:smaller;">
                       Tier Up is an online shopping portal where you can place order
                       for baked goods like cakes, cookies, cupcakes and bread. It
                       will be delivered to you at your doorstep. We inform you about the
                       latest date by which we can deliver the product. You can delay the
                       delivery date as per your needs.
                    </p>
                    <br>
                    Contact Us:
                    <p style="font-size:smaller;">
                       Email Id: business@tierup.com<br>
                       Phone: 2102-3030/2102-3032
                    </p>
                 </div>
                 <!--<div class="col">
                    <br><br>

                 </div>-->
              </div>
           </div>
        </form>
        <br>
     </div>
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
   $('#first').dblclick(function(){
      var pid=$(this).attr('name');
      $.ajax({
         url:"phpProcess/setProductCookie.php",
         type:"post",
         data:{"prod":pid},
         success:function(data){
            //alert(data);
            window.location.href="product.php";
         }
      });
   });
   $('.center').dblclick(function(){
      var pid=$('#first').attr('name');
      $.ajax({
         url:"phpProcess/setProductCookie.php",
         type:"post",
         data:{"prod":pid},
         success:function(data){
            //alert(data);
            window.location.href="product.php";
         }
      });
   });
   $('#news').click(function(){
      var dob=$('#dob').val();
      var mail=$('#mail').val();
      var reg_m=/^[a-zA-Z0-9._]{4,}@[a-z]{3,}\.(com|net)+$/;
      if(dob.match(/(0[1-9]|[12][0-9]|3[01])[-](0[1-9]|1[0])[-](19|20)\d\d/))
      {
         $('#dMsg').text(" ");
         if(!mail.match(reg_m))
         {
            $('#mMsg').text("Invalid Email ID");
            $('#mMsg').css("color","red");
         }
         else
         {
            $('#mMsg').text(" ");
            $.ajax({
               type:'post',
               url:'phpProcess/mail.php',
               data:{'dob':dob,'mail':mail},
               success:function(data)
               {
                  if(data!="true")
                  {
                     $('#dMsg').text(data);
                     $('#dMsg').css("color","red");
                  }
                  else
                  {
                     alert("Successfully added");
                  }
               }
            });
         }
      }
      else
      {
         $('#dMsg').text("Invalid Date");
         $('#dMsg').css("color","red");
      }
   });
</script>
<!--FIX: Not compatible with IE (Try on others too!)-->
