<!doctype html>
<html>
<head>
   <title>New Items</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
   <?php
   date_default_timezone_set('Asia/Kolkata');
session_start();
if(isset($_SESSION['uname']) && $_SESSION['uname']=='Admin')
{
   if(!isset($_POST["submit"]) && !isset($_FILES["prod_pic"]))
   { }
   else
   {
      $host="localhost";
      $user="root";
      $pswd="";
      $db="BuildItUp";
      $connect=new mysqli($host,$user,$pswd,$db) or die("Unable to establish connection");

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
          # $imgContent=base64_encode($imgContent);

            $name=$_POST['prod_name'];
            $category=$_POST['prod_cat'];
            $sub=$_POST['sub_cat'];
            $desc=$_POST['prod_describe'];
            //$keyword=$_POST['prod_known'];
            $quantity=$_POST['prod_qty'];
            $weight=$_POST['prod_weight'];
            $unit=$_POST['unit_weight'];
            $cost=$_POST['prod_amt'];
            $del=$_POST['deliver'];
            $dateTime=date("Y-m-d H:i:s");

            if(empty($name)||empty($category)||empty($desc)||empty($cost)||empty($quantity))
            {
               echo "<script type='text/javascript'>alert('Fill up all the field');</script>";
            }
            else
            {
               if(empty($weight))
               {
                  $query="INSERT INTO products(prod_name,prod_category,subcat,prod_pic,prod_abt,prod_quantity,prod_weight,prod_amt,lease,upload_date)
                  VALUES('$name','$category','$sub','$image','$desc','$quantity','null','$cost','$del','$dateTime')";
                  $result=mysqli_query($connect,$query) or die("hey");
                  if($result)
                  {
                     echo "<script type='text/javascript'>alert('Successfully added!');</script>";
                  }
               }
               else
               {
                  $query="INSERT INTO products(prod_name,prod_category,subcat,prod_pic,prod_abt,prod_quantity,prod_weight,prod_amt,lease,upload_date)
                  VALUES('$name','$category','$sub','$image','$desc','$quantity','$weight $unit','$cost','$del','$dateTime')";
                  $result=mysqli_query($connect,$query) or die(mysqli_error($connect));
                  if($result)
                  {
                     echo "<script type='text/javascript'>alert('Successfully added!');</script>";
                  }
               }
            }
            $connect->close();
      }
   }
?>
<!-- issue's to solve: not cross browser(works only on chrome),
If a single quote is used the sql query shows error(since, the query variables are encoded in it) -->
<style type="text/css">
      .sty{
         width:100%;
      }
   </style>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
   <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
      <nav class="nav nav-tabs">
         <li class="nav-item"><a class="nav-link" href="newsletter.php">Newsletter</a></li>
        <li class="nav-item"><a class="nav-link active">Upload New Products</a></li>
        <li class="nav-item"><a class="nav-link" href="editPro.php">Edit Product</a></li>
        <li class="nav-item"><a class="nav-link"  href="removePro.php">Remove Product</a></li>
        <input type="button" style="background-color:transparent;outline:none;border:none;color:blue;" id="logout" value="Logout">
      </nav>
      <br><br>
      <div class="container form-group">
         <div class="row">
            <div class="col-md-3">Product Name: </div>
            <div class="col-md-3"><input type="text" name="prod_name" class="sty form-control"></div>
         </div>
         <br>
         <div class="row">
            <div class="col-md-3">Product Category: </div>
            <div class="col-md-3">
               <select name="prod_cat" id="prod_cat" class="sty form-control">
                  <option value="cake">Cake</option>
                  <option value="cookie">Cookie</option>
                  <option value="bread">Bread</option>
                  <option value="cupcake">Cupcake</option>
               </select>
            </div>
         </div><br>
         <div class="row">
            <div class="col-md-3">Sub Categories: </div>
            <div class="col-md-3">
               <!--Get values from db-->
               <select id="sub_cat" name="sub_cat" class="form-control">

               </select>
            </div>
         </div><br>
         <div class="row">
            <div class="col-md-2">Select Image to Upload: </div>
               <div class="col-md-4">
                  <input type="file" name="prod_pic" id="prod_pic" size="100" class="sty form-control">
               </div>
         </div><br>
         <div class="row">
            <div class="col-md-3">Product Description: </div>
            <div class="col-md-3"><textarea name="prod_describe" cols="50" rows="15" placeholder="Description" class="sty form-control"></textarea></div>
         </div><br>
         <div class="row">
            <div class="col-md-2">Quantity: </div>
               <div class="col-md-2"><input type="number" class="form-control" name="prod_qty"></div>
            <div class="col-md-2">Weight: </div>
               <div class="col-md-1">
                  <input type="number" class="form-control" name="prod_weight">       <!-- fix: cannot add float values-->
               </div>
               <div class="col-md-1">
                  <select class="unit_weight form-control" name="unit_weight">
                     <option value="kg">kg</option>
                     <option value="gm">gm</option>
                  </select>
               </div>
            </div><br>
            <div class="row">
               <div class="col-md-2">Price: </div>
               <div class="col-md-2">
                  <input type="number" class="form-control" name="prod_amt">
               </div>
                  <div class="col-md-2">Days to deliver: </div>
               <div class="col-md-2">
                  <input type="number" class="form-control" name="deliver">
               </div>
            </div><br>
         <div class="row">
            <div class="col-md-2">
               <center><input type="submit" class="btn btn-outline-primary btn-block" name="submit" value="UPLOAD" accept="image/jpeg"></center>
            </div>
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
</html>
<script type="text/javascript">
//sub categories for selected category
$(document).ready(function(){
   var cat=$('#prod_cat option:selected').val();
   $.ajax({
      url:"getSubcat.php",
      type:"POST",
      data:{"cat":cat},
      success:function(data){
         document.getElementById("sub_cat").innerHTML=data;
      }
   });
});

   $("#prod_cat").change(function(){
      var cat=$('#prod_cat option:selected').val();
      $.ajax({
         url:"getSubcat.php",
         type:"POST",
         data:{"cat":cat},
         success:function(data){
            document.getElementById("sub_cat").innerHTML=data;
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
</script>
<!--   .\<SQLEXPRESS   -->
