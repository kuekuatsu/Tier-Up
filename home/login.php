<!doctype html>
<?php
   session_start();
   date_default_timezone_set('Asia/Kolkata');
   if(isset($_SESSION["username"]))
   {#user is logged in
      //echo "logged";
      header("Location: index.php");
   }
   else
   {#user is not logged in
      //echo "not logged in";
      if(isset($_COOKIE['name']) && isset($_COOKIE['pass']))   #user wants to be remembered?
      {#yes
         $IDvalue=$_COOKIE['name'];
         $PDvalue=$_COOKIE['pass'];
      }
      else
      {#no
         $IDvalue=null;#solves undefined variable error
         $PDvalue=null;
      }
   }
?>
<html>
<head>
   <title>Login</title>
   <link rel="stylesheet" href="css/log.css?version=14" type="text/css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css?family=Raleway:600|Indie+Flower|Allura|Berkshire+Swash|Comfortaa|Courgette|Lobster+Two|Merienda|Playball|Satisfy|Sofia|Englebert" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body style="font-size:20px;">
   <?php
   #LOGIN process
   $host="localhost";
   $user="root";
   $password="";
   $db="BuildItUp_customer";

   $con=new mysqli($host,$user,$password,$db) or die("fail");
   if(isset($_POST["lButton"]))
   {
      $user=$_POST["lID"];
      $pswd=$_POST["lPswd"];
      if(!empty($user) && !empty($pswd))
      {
         $query="SELECT * FROM users WHERE Username='$user'";
         $result=mysqli_query($con,$query);
         if(mysqli_num_rows($result)>0)
         {
            while($row=mysqli_fetch_array($result))
            {
               if($pswd==$row[Password])
               {
                  //echo "Logged in successfully";
                  $_SESSION["username"]=$user;
                  $_SESSION["userID"]=$row[Cust_id];
                  header("Location:index.php");
               }
               else
               {
                  echo "<center>Incorrect Password</center>";
                  echo "
                  <style type='text/css'>
                     #secure
                     {
                        border:1px solid red;
                     }
                     #secure:focus
                     {
                        box-shadow:red 0px 0px 3px;
                     }
                     </style>
                  ";
               }
            }
         }
         else
         {#not registered
            echo "<center>This username doesn't exist, you have to register first</center>";
            echo "
            <style type='text/css'>
            #link{
               font-size:22px;
               color:blue;
               text-decoration:underline;
            }
            </style>
            ";
         }
      }
      else
      {
         echo "<center>Enter username & password</center>";
         echo "
         <style type='text/css'>
            #secure
            {
               border:1px solid red;
            }
            #id
            {
               border:1px solid red;
            }
            #secure:focus
            {
               box-shadow:red 0px 0px 3px;
            }
            #id:focus
            {
               box-shadow:red 0px 0px 3px;
            }
         </style>
         ";
      }
   }
   else
   {  }
   $con->close();
   ?>
      <fieldset>
         <form method="post">
            <nav class="nav nav-tabs">
                <li class="nav-item">
                   <a class="myNav nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item" id="login">
                   <a class="myNav nav-link active">Login</a>
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
             </nav><br>
            <div class="container form-group" style="border:1px solid black;border-radius:5px 5px 5px 5px;">
               <br>
                  <label for="id">Username</label>
                  <div class="row justify-content-around">
                     <input type="text" class="form-control col-md-8 inputBox" name="lID" value="<?php echo $IDvalue; ?>" id="id">
                     <div class="col-md-8" id="inpd" style="color:red"></div>
                  </div><br>
               <div class="form-group">
                  <label for="secure">Password</label>
                  <div class="row justify-content-around">
                     <input type="password" class="form-control col-md-8 inputBox" name="lPswd" value="<?php echo $PDvalue; ?>" id="secure">
                  </div>
               </div>
               <div class="form-check">
                  <input type="checkbox" name="check" id="remember" class="form-check-input">
                  <label for="remember" class="form-check-label">Remember Me</label>
               </div><br>
                  <div class="row justify-content-around">
                     <input type="submit" name="lButton" id="lButton" class="btn-primary col-md-8" value="LOGIN">
                  </div><br>
                  <div class="row justify-content-around">
                     <a href="sign.php" id="link">Register here</a>
                  </div><br>
            </div>
   <?php
         if(isset($_POST["check"]))
         {#user wants to be remembered, set cookie on users computer to remember user
            setcookie('name',$_POST["lID"],mktime()+86400);
            setcookie('pass',$_POST["lPswd"],mktime()+86400);
         }
   ?>
         </form>
      </fieldset>
</body>
</html>
