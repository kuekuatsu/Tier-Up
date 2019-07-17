<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Newsletter</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   </head>
   <?php
   date_default_timezone_set('Asia/Kolkata');
   session_start();
   if(isset($_SESSION['uname']) && $_SESSION['uname']=='Admin')
   {
      $host="localhost";
      $u="root";
      $p="";
      $db="BuildItUp";
      $con=new mysqli($host,$u,$p,$db) or die("erri");
      ?>
   <body>
      <form method="post" action="sendNews.php">
         <nav class="nav nav-tabs">
         <li class="nav-item"><a class="nav-link active">Newsletter</a></li>
          <li class="nav-item"><a class="nav-link" href="upload.php">Upload New Products</a></li>
          <li class="nav-item"><a class="nav-link" href="editPro.php">Edit Product</a></li>
          <li class="nav-item"><a class="nav-link" href="removePro.php">Remove Product</a></li>
          <input type="button" style="background-color:transparent;outline:none;border:none;color:blue;" id="logout" value="Logout">
         </nav>
         <br><br>
         <div class="container form-group">
            <div class="row">
               <div class="col">
                  Send Mail to:
               </div>
            </div>
            <div class="row">
               <div class="col">
                  <input type="radio" id="all" value="all" name="to">
                  <label for="all">Everyone</label>
                  &emsp;
                  <input type="radio" id="mem" value="mem" name="to">
                  <label for="mem">Only members</label>
               </div>
            </div>
            <br>
            <div class="row">
               <div class="col-md-1">
                  <label for="sub">Subject: </label>
               </div>
               <div class="col-md-3">
                  <input id="sub" name="sub" class="form-control" type="text">
               </div>
            </div>
            <br>
            <div class="row">
               <div class="col-md-1">
                  <label for="sub">Message: </label>
               </div>
               <div class="col-md-3">
                  <textarea id="body" name="body" class="form-control" rows="8" cols="80"></textarea>
               </div>
            </div>
            <br>
            <div class="row">
               <div class="col-md-2">
                  <input type="submit" value="Proceed" id="send" class="btn btn-outline-primary btn-block">
               </div>
               <div class="col-md-2">
                  <input type="reset" class="btn btn-outline-primary btn-block">
               </div>
            </div>
         </div><br>
<!--      <form method="post" action="sendWish.php">
         <div class="container">
            <div class="row">
            <#?php
            $today_m=date("m");
            $today_d=date("d");
            $s="SELECT * FROM mail_list WHERE MONTH(DOB)='$today_m' AND DAY(DOB)='$today_d'";
            $t=mysqli_query($con,$s) or die("eri");
            $bds="";
            if($t)
            {
               $n=mysqli_num_rows($t);
               if(mysqli_num_rows($t)>0)
               {
                  while($l=mysqli_fetch_array($t))
                  {
                     $bds=$bds.$l[Email];
                     $n--;
                     if($n>0)
                     {
                        $bds=$bds.", ";
                     }
                  }
               }
               echo "<div class='col-md-3'>";
               echo "Birthdays: ";
               echo $bds."</div>";
               ?>
               <div class="col-md-5" style="width:100%">
                  <div class="container-fluid">
                     <div class="row">
                        Subject: Many Many Happy Returns Of The Day,
                     </div>
                     <div class="row">
                        <textarea name="name" placeholder="Body" class="form-control" style="width:100%"></textarea>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <input type="button" id="wishes" value="Send Birthday Wishes" class="btn btn-outline-primary btn-block">
               </div>
               </?php
            }
            ?>
         </div>
         </div>
      </form>
         <br><br> -->
      </form>
   </body>
   <script type="text/javascript">
   $('#logout').click(function(){
      $.ajax({
         type:'post',
         url:'destroy.php',
         success:function()
         {
            window.location.href="identify.php";
         }
      });
   });
   </script>
</html>
<?php
}
else
{
   ?>
   <br><br><br><br>
      <div class="container">
         <div class="row">
            <div class="col">
               <h3>Unauthorized Access<br>
               <a href="identify.php">Login</a> First</h3>
            </div>
         </div>
      </div>
   <?php
}
?>
