<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php
session_start();
if(isset($_SESSION['uname']) && $_SESSION['uname']=='Admin')
{
      $host="localhost";
      $u="root";
      $p="";
      $db="BuildItUp";
      $con=new mysqli($host,$u,$p,$db) or die("erri");
?>
<style>
         .values{

         }
         .values:hover{
            box-shadow:0px 0px 10px blue;
            z-index:2;
         }
      </style>
   </head>
   <body>
      <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
         <nav class="nav nav-tabs">
           <!--<li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>-->
           <li class="nav-item"><a class="nav-link" href="newsletter.php">Newsletter</a></li>
           <li class="nav-item"><a class="nav-link" href="upload.php">Upload New Products</a></li>
           <li class="nav-item"><a class="nav-link active">Add Product Images</a></li>
           <li class="nav-item"><a class="nav-link"  href="removePro.php">Remove Product</a></li>
           <input type="button" style="background-color:transparent;outline:none;border:none;color:blue;" id="logout" value="Logout">
         </nav>
<br><br>
         <div class="container form-group">
            <div class="row">
               <div class="col-md-2">
                  Search Product:
               </div>
               <div class="col-md-2">
                  <input type="text" class="form-control" id="name" value="" placeholder="And Enter">
               </div>
               <div class="col-md-1">
                  <img src="images/ic.png" id="btn" height="25px" width="25px">
               </div>
            </div><br>
            <div class="row">
               <div class="col-md-5">
                  <input type="text" readonly id="hid" name="hid" class="form-control" value="No Product Selected">
               </div>
            </div>
            <br>
            <div class="row">
               <div class="col-md-5">
                  <input type="file" class="form-control" name="prod_pic" id="prod_pic">
               </div>
            </div>
            <br>
            <div class="row">
               <div class="col-md-2">
                  <input type="submit" name="submit" accept="image/jpeg" class="btn btn-outline-primary btn-block" id="upd" value="Update">
                  <?php
                  if(!isset($_POST["submit"]) && !isset($_FILES["prod_pic"]))
                  {}
                  else
                  {
                     $check=getimagesize($_FILES["prod_pic"]["tmp_name"]);
                     if($check==false)
                     {
                        echo "<script type='text/javascript'>alert('Upload an image!');</script>";
                     }
                     else
                     {
                        $image=addslashes($_FILES["prod_pic"]["tmp_name"]);
                        $imgName=addslashes($_FILES["prod_pic"]["name"]);
                        $image=file_get_contents($image);
                        $image=base64_encode($image);
                        if($_POST['hid']=='No Product Selected')
                        {
                           echo "<h4>Select a product to update</h4>";
                        }
                        else
                        {
                           //echo $_POST['hid'];
                           $nm=$_POST['hid'];
                           $find="SELECT prod_pic2 FROM products WHERE prod_name='$nm'";
                           $izac=mysqli_query($con,$find) or die("findDie");
                           if($izac)
                           {
                              while($b=mysqli_fetch_array($izac))
                              {
                                 if($b[0]!="")
                                 {
                                    echo "No more Images can be added for this product";
                                 }
                                 else
                                 {
                                    $upd="UPDATE products SET prod_pic2='$image' WHERE prod_name='$nm'";
                                    $try=mysqli_query($con,$upd) or die("upd killed");
                                    if($try)
                                    {
                                       echo "Image Successfully Added";
                                    }
                                 }
                              }
                           }
                        }
                     }
                  }
                  ?>
               </div>
            </div>
         </div>
<br>
         <div class="container">
            <div class="row justify-content-left">
         <?php
            $q="SELECT * FROM products";
            if(isset($_SESSION['show']))
            {$q=$_SESSION['show'];}
            $res=mysqli_query($con,$q) or die("qdead");
            if($res)
            {
               while($row=mysqli_fetch_array($res))
               {
                  ?>
                  <div class="col values" id="<?php echo $row['prod_id'] ?>" name="<?php echo $row['prod_name'] ?>">
                     <br>
                     <div class="col">
                        <img src="data:image;base64,<?php echo $row['prod_pic'] ?>" style="height:100px;width:100px">
                     </div>
                     <?php
                     if($row['prod_pic2']!=null)
                     {?>
                     <div class="col">
                        <img src="data:image;base64,<?php echo $row['prod_pic2'] ?>" style="height:100px;width:100px">
                     </div>
                     <?php
                     }
                     ?>
                     <div class="col">
                        <?php echo $row['prod_name'] ?>
                     </div>
                  <!--   <div class="col">
                        </?php echo $row['prod_category'] ?>
                     </div>-->
                  </div>
                  <?php
               }
            }
         ?>
      </div>
      </div>
      </form>
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
   </body>
   <script type="text/javascript">
   $('#btn').click(function(){
      //alert($('#name').val());
      var ip=$('#name').val();
      $.ajax({
         type:'post',
         url:'getO.php',
         data:{'ip':ip},
         success:function(data){
            if(data!="")
            {
               alert(data);
            }
            else
            {
               window.location.reload();
            }
         }
      });
   });
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
      $('.values').click(function(){
         //alert($(this).attr('id'));
         $('#hid').val($(this).attr('name'));
      });

      //prevent form submit on enter -- solves search enter error loop
      $(document).ready(function() {
        $(window).keydown(function(e){
          if(event.keyCode == 13) {
            e.preventDefault();
            return false;
          }
        });
      });
   </script>
</html>
