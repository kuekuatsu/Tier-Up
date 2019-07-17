<!doctype html>
<?php
   session_start();
   date_default_timezone_set('Asia/Kolkata');
   if(!isset($_SESSION["username"]))
   {
      //echo "sign up here";
   }
   else
   {
      header("Location: index.php");
   }
?>
<html>
<head>
   <title>Register</title>
   <link rel="stylesheet" href="css/log.css?version=8" type="text/css">
   <!--Bootsrap-->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
 <!--Google fonts-->
<link href="https://fonts.googleapis.com/css?family=Indie+Flower|Allura|Berkshire+Swash|Comfortaa|Courgette|Lobster+Two|Merienda|Playball|Satisfy|Sofia|Englebert" rel="stylesheet">
<!--JQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>
   <br>
   <!---->
   <?php
   #SIGNUP process
   error_reporting(E_ALL);
   $host="localhost";
   $user="root";
   $password="";
   $db="BuildItUp_customer";

   $con=new mysqli($host,$user,$password,$db) or die("fail");
      if(!isset($_POST["sButton"]))
      {}
      else
      {
            $name=$_POST['sFname'].' '.$_POST['sLname'];
            $mail=$_POST['sMail'];
            $pswd=$_POST['sPswd'];
            $username=$_POST['sUsername'];
      /*      if(empty($_POST['sFname'])||empty($_POST['sLname'])||empty($mail)||empty($pswd)||empty($username))
            {
               echo "Fill up all fields";
            }
            else
            {  */
               $query="INSERT INTO users(Name,Email,Username,Password)
                VALUES('$name','$mail','$username','$pswd')";
                $result=mysqli_query($con,$query) or die("You already have an account");
                if($result)
                {
                   $s="SELECT * FROM users WHERE Username='$username'";
                   $t=mysqli_query($con,$s);
                   if(mysqli_num_rows($t)>0)
                   {
                      while($row=mysqli_fetch_array($t))
                      {
                         //echo "Success";
                         $_SESSION["username"]=$username;
                         $_SESSION["userID"]=$row[Cust_id];
                         header("Location:index.php");
                      }
                   }
                }
                else
                {
                   echo "fail";
                }
         /*   }  */
      }
      $con->close();
   ?>

      <div class="container" style="border:1px solid black;border-radius:5px 5px 5px 5px;">
         <form method="post" name="signUp" id="signUp" align="center" onsubmit="return validate(this)">
            <br>
               <div class="form-group">
                  <div class="row justify-content-md-center">
                     <label for="FirstName" class="col-md-4">Your Name</label>
                     <label for="LastName" class="col-md-4">Your Surname</label>
                  </div>
                  <div class="row justify-content-md-center">
                     <input type="text" name="sFname" id="FirstName" class="form-control col-md-4 inputBox">
                     <input type="text" name="sLname" id="LastName" class="form-control col-md-4 inputBox">
                  </div>
                  <div class="row justify-content-md-center">
                     <div class="col-md-4" id="infn" style="color:red"></div>
                     <div class="col-md-4" id="inln" style="color:red"></div>
                  </div>
               </div><br>
               <div class="form-group">
                  <label for="Email">Your Email ID</label>
                  <div class="row justify-content-around">
                     <input type="text" name="sMail" id="Email" class="form-control col-md-8 inputBox">
                     <div class="col-md-8" id="inem" style="color:red"></div>
                  </div>
               </div><br>
               <div class="form-group">
                  <label for="UserName">Username</label>
                  <div class="row justify-content-around">
                     <input type="text" name="sUsername" id="UserName" class="form-control col-md-8 inputBox">
                     <div class="col-md-8" id="inun" style="color:red"></div>
                  </div>
               </div><br>
               <div class="form-group">
                  <label for="Password">Create a Password</label>
                  <div class="row justify-content-around">
                     <input type="password" name="sPswd" id="Password" class="form-control col-md-8 inputBox">
                     <div class="col-md-8" id="inpd" style="color:red"></div>
                  </div>
               </div><br>
               <div class="row justify-content-around">
                  <input type="submit" name="sButton" id="sButton" class="btn-primary col-md-8" value="SIGNUP">
               </div><br>
               <div class="row justify-content-around">
                  <a href="login.php">Already a member?</a>
               </div><br>
         </form>
      </div>
   </body>
   <script type="text/javascript">
   function validate(form)
   {
      var fn=$('#FirstName').val();
      var ln=$('#LastName').val();
      var mail=$('#Email').val();
      var un=$('#UserName').val();
      var pswd=$('#Password').val();

      var reg_nm=/^[A-Za-z]{3,}$/;
      var reg_u=/^[A-Za-z@0-9_]{5,}$/;
      var reg_p=/^[A-Za-z@/_.0-9]{4,}$/;
      var reg_m=/^[a-zA-Z0-9._]{4,}@[a-z]{3,}\.(com|net)+$/;
      if(!fn.match(reg_nm))
      {
         $('#FirstName').css('border','1px solid red');
         $('#FirstName').focus($('#FirstName').css('box-shadow','red 0px 0px 3px'));
         $('#infn').text("Invalid Name");
         return false;
      }
      else
      {
         $('#FirstName').css('border','1px solid lightgray');
         $('#FirstName').focus($('#FirstName').css('box-shadow','black 0px 0px 0px'));
         $('#infn').text("");
      }
      if(!ln.match(reg_nm))
      {
         $('#LastName').css('border','1px solid red');
         $('#LastName').focus($('#LastName').css('box-shadow','red 0px 0px 3px'));
         $('#inln').text("Invalid Surname");
         return false;
      }
      else
      {
         $('#LastName').css('border','1px solid lightgray');
         $('#LastName').focus($('#LastName').css('box-shadow','black 0px 0px 0px'));
         $('#inln').text("");
      }
      if(!mail.match(reg_m))
      {
         $('#Email').css('border','1px solid red');
         $('#Email').focus($('#Email').css('box-shadow','red 0px 0px 3px'));
         $('#inem').text("Invalid Email ID");
         return false;
      }
      else
      {
         $('#Email').css('border','1px solid lightgray');
         $('#Email').focus($('#Email').css('box-shadow','black 0px 0px 0px'));
         $('#inem').text("");
      }
      if(!un.match(reg_u))
      {
         $('#UserName').css('border','1px solid red');
         $('#UserName').focus($('#UserName').css('box-shadow','red 0px 0px 3px'));
         $('#inun').text("Username must be atleast 5 characters long and can include letters, numbers, @ or _");
         return false;
      }
      else
      {
         $('#UserName').css('border','1px solid lightgray');
         $('#UserName').focus($('#UserName').css('box-shadow','black 0px 0px 0px'));
         $('#inun').text("");
      }
      if(!pswd.match(reg_p))
      {
         $('#Password').css('border','1px solid red');
         $('#Password').focus($('#Password').css('box-shadow','red 0px 0px 3px'));
         $('#inpd').text("Password should be 4 characters long & can only have letters, numbers, @, /, _ or .");
         return false;
      }
      else
      {
         $('#Password').css('border','1px solid lightgray');
         $('#Password').focus($('#Password').css('box-shadow','black 0px 0px 0px'));
         $('#inpd').text("");
      }
      return true;
   }
   $('#UserName').blur(function(){
      var ip=$(this).val();
      $.ajax({
         type:'post',
         url:'phpProcess/userExists.php',
         data:{'ip':ip},
         success:function(data)
         {
            if(data.includes("exist"))
            {
               $('#inun').text("This username already exists");
               $('#UserName').css('border','1px solid red');
               $('#sButton').prop('disabled',true);
            }
            else
            {
               $('#inun').text("");
               $('#UserName').css('border','1px solid lightgray');
               $('#sButton').prop('disabled',false);
            }
         }
      });
   });
   </script>
</html>
