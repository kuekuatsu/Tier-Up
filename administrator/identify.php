<?php

?>
<!DOCTYPE html>
<html>
   <head>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <meta charset="utf-8">
      <title>Login</title>
   </head>
   <body>
      <br><br>
      <form class="">
         <div class="container form-group" style="border:1px solid black;">
            <br><br>
            <div class="row justify-content-center">
               <div class="col-md-3" style="text-align:center">
                  <input type="text" class="form-control" id="user" placeholder="Username">
               </div>
            </div>
            <br><br>
            <div class="row justify-content-center">
               <div class="col-md-3" style="text-align:center">
                  <input type="password" class="form-control" id="pswd" placeholder="Password">
               </div>
            </div>
            <br><br>
            <div class="row justify-content-center">
               <div class="col-md-3" style="text-align:center">
                  <input type="button" class="btn btn-outline-primary btn-block" id="log" value="LOGIN">
               </div>
            </div>
            <br><br>
         </div>
      </form>
      <script type="text/javascript">
         $('#log').click(function(){
            var user=$('#user').val();
            var pswd=$('#pswd').val();
            $.ajax({
               type:'post',
               url:'authenticate.php',
               data:{'user':user,'pswd':pswd},
               success:function(data){
                  if(data!="success")
                  {
                     alert(data);
                  }
                  else
                  {
                     if(user=="Admin")
                     {
                        window.location.href="newsletter.php";
                     }
                     else
                     {
                        window.location.href="baker.php";
                     }
                  }
               }
            });
         });
      </script>
   </body>
</html>
