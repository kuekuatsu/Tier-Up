<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
           <li class="nav-item"><a class="nav-link active">Edit Product</a></li>
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
            </div><br>
            <div class="row">
               <div class="col-md-3">
                  <input type="submit" name="select" class="btn btn-outline-primary btn-block" id="edd" value="Edit">
               </div>
            </div>
         </form>
         <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                  <?php
                  if(!isset($_POST["select"]))
                  {}
                  else
                  {
                     $name=$_POST['hid'];
                     if($name=="No Product Selected")
                     {
                        echo $name;
                     }
                     else
                     {
                        $sql="SELECT * FROM products WHERE prod_name='$name'";
                        $r=mysqli_query($con,$sql) or die("sqlD");
                        if($r)
                        {
                           while($line=mysqli_fetch_array($r))
                           {
                              ?>
                              <br>
                              <div class="row">
                                 <div class="col">
                                    <input type="hidden" name="pid" id="pid" class="form-control" value="<?php echo $line['prod_id'] ?>">
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-3">
                                    Product Name:
                                 </div>
                                 <div class="col-md-3">
                                    <input type="text" name="pname" class="form-control" value="<?php echo $line['prod_name'] ?>">
                                 </div>
                              </div>
                              <br>
                              <div class="row">
                                 <div class="col-md-2">
                                    Change Image 1:
                                 </div>
                                 <div class="col-md-4">
                                    <input type="file" class="form-control" name="img1" value="">
                                 </div>
                                 <div class="col-md-2">
                                    <img src="data:image;base64,<?php echo $line['prod_pic'] ?>" style="height:10vw;width:10vw">
                                 </div>
                              </div>
                              <?php
                              if($line['prod_pic2']!=null)
                              {
                                 ?>
                                 <div class="row">
                                    <div class="col-md-2">
                                       Change Image 2:
                                    </div>
                                    <div class="col-md-4">
                                       <input type="file" class="form-control" name="img2" value="">
                                    </div>
                                    <div class="col-md-2">
                                       <img src="data:image;base64,<?php echo $line['prod_pic2'] ?>" style="height:10vw;width:10vw">
                                    </div>
                                    <div class="col-md-1" id="cross" style="font-size:25px;user-select:none;">
                                       &#9747;
                                    </div>
                                 </div>
                                 <?php
                              }
                              else
                              {
                                 ?>
                                 <div class="row">
                                    <div class="col-md-2">
                                       Upload Image 2:
                                    </div>
                                    <div class="col-md-4">
                                       <input type="file" class="form-control" name="img2" value="">
                                    </div>
                                    <div class="col-md-2">
                                       <img src="data:image;base64,<?php echo $line['prod_pic2'] ?>" style="height:3vw;width:3vw">
                                    </div>
                                 </div>
                                 <?php
                              }
                              ?>
                              <br>
                              <div class="row">
                                 <div class="col-md-3">
                                    Product Category:
                                 </div>
                                 <div class="col-md-3">
                                    <select name="prod_cat" id="prod_cat" class="sty form-control">
                                       <option disabled selected value=""><?php echo $line['prod_category']; ?></option>
                                       <option value="cake">Cake</option>
                                       <option value="cookie">Cookie</option>
                                       <option value="bread">Bread</option>
                                       <option value="cupcake">Cupcake</option>
                                    </select>
                                    <input type="hidden" name="category" value="<?php echo $line['prod_category']; ?>">
                                 </div>
                              </div><br>
                              <div class="row">
                                 <div class="col-md-3">Sub Categories: </div>
                                 <div class="col-md-3">
                                    <!--Get values from db-->
                                    <select id="sub_cat" name="sub_cat" class="form-control">
                                       <option disabled selected value=""><?php echo $line['subcat']; ?></option>
                                    </select>
                                    <input type="hidden" name="subcategory" value="<?php echo $line['subcat']; ?>">
                                 </div>
                              </div><br>
                              <div class="row">
                                 <div class="col-md-3">Product Description: </div>
                                 <div class="col-md-3"><textarea name="prod_describe" cols="50" rows="15" placeholder="Description" class="sty form-control"><?php echo $line['prod_abt']; ?></textarea></div>
                              </div><br>
                              <div class="row">
                                 <div class="col-md-2">Quantity: </div>
                                    <div class="col-md-2"><input type="number" class="form-control" name="prod_qty" value="<?php echo $line['prod_quantity']; ?>"></div>
                                    <?php
                                     $weight=$line['prod_weight'];
                                     $w=explode(" ",$weight);
                                    ?>
                                 <div class="col-md-2">Weight: </div>
                                    <div class="col-md-1">
                                       <input type="number" class="form-control" name="prod_weight" value="<?php echo $w[0] ?>">       <!-- fix: cannot add float values-->
                                    </div>
                                    <div class="col-md-1">
                                       <select class="unit_weight form-control" name="unit_weight">
                                          <option selected disabled value="sel"><?php echo $w[1]; ?></option>
                                          <option value="kg">kg</option>
                                          <option value="gm">gm</option>
                                       </select>
                                       <input type="hidden" name="wt" value="<?php echo $w[0] ?>">
                                       <input type="hidden" name="unit" value="<?php echo $w[1]; ?>">
                                    </div>
                                 </div><br>
                                 <div class="row">
                                    <div class="col-md-2">Price: </div>
                                    <div class="col-md-2">
                                       <input type="number" class="form-control" name="prod_amt" value="<?php echo $line['prod_amt']; ?>">
                                    </div>
                                       <div class="col-md-2">Days to deliver: </div>
                                    <div class="col-md-2">
                                       <input type="number" class="form-control" name="deliver" value="<?php echo $line['lease']; ?>">
                                    </div>
                                 </div><br>
                              <div class="row">
                                 <div class="col-md-2">
                                    <center><input type="submit" class="btn btn-outline-primary btn-block" name="update" value="Update"></center>
                                 </div>
                              </div>
                              <?php
                           }
                        }
                     }
                  }
                  ?>
         </div>
         <?php
         if(!isset($_POST['update']))
         {}
         else
         {
            $pid=$_POST['pid'];
            $pname=$_POST['pname'];
            if(!isset($_POST['prod_cat']))
            {
               $cat=$_POST['category'];
               //echo $cat;
            }
            else
            {
               $cat=$_POST['prod_cat'];
               //echo $cat;
            }
            if(!isset($_POST['sub_cat']))
            {
               $sub=$_POST['subcategory'];
               //echo $sub;
            }
            else
            {
               $sub=$_POST['sub_cat'];
               //echo $sub;
            }
            $des=$_POST['prod_describe'];
            $qty=$_POST['prod_qty'];
            $amt=$_POST['prod_amt'];
            $lea=$_POST['deliver'];
            if(!isset($_POST['prod_weight']))
            {
               $w=$_POST['wt'];
               //echo $w;
            }
            else
            {
               $w=$_POST['prod_weight'];
               //echo $w;
            }
            if(!isset($_POST['unit_weight']))
            {
               $ut=$_POST['unit'];
               //echo $ut;
            }
            else
            {
               $ut=$_POST['unit_weight'];
               //echo $ut;
            }
            $weight=$w." ".$ut;
            //echo $weight;

            $check1=getimagesize($_FILES["img1"]["tmp_name"]);
            $check2=getimagesize($_FILES["img2"]["tmp_name"]);
            if($check1==false && $check2==false)
            {
               if($w!=null && $ut==null)
               {
                     echo "Unit weight not selected";
               }
               else if($ut!=null && $w==null)
               {
                     echo "Product weight not selected";
               }
               else
               {
                  $cat=strtolower($cat);
                  $sub=strtolower($sub);
                  $date=date("Y-m-d H:i:s");
                  if($weight==" ")
                  {
                     $weight="null";
                  }
                  $qry="UPDATE products SET prod_name='$pname',prod_category='$cat',
                  subcat='$sub',prod_abt='$des',prod_quantity='$qty',
                  prod_weight='$weight',prod_amt='$amt',lease='$lea',
                  upload_date='$date' WHERE prod_id='$pid'";
                  $result=mysqli_query($con,$qry) or die("errro");
                  if($result)
                  {
                     echo "Updated Successfully";
                  }
               }
            }
            else
            {
               $image1=addslashes($_FILES["img1"]["tmp_name"]);
               $imgName1=addslashes($_FILES["img1"]["name"]);
               //echo $image1." "; //temporary filename for img
               //echo $imgName1; //name.jpg as uploaded
               $image1=file_get_contents($image1);
               $image1=base64_encode($image1);

               $image2=addslashes($_FILES["img2"]["tmp_name"]);
               $imgName2=addslashes($_FILES["img2"]["name"]);
               $image2=file_get_contents($image2);
               $image2=base64_encode($image2);

               if($check1==true && $check2==true)
               {
                  if($w!=null && $ut==null)
                  {
                        echo "Unit weight not selected";
                  }
                  else if($ut!=null && $w==null)
                  {
                        echo "Product weight not selected";
                  }
                  else
                  {
                     $cat=strtolower($cat);
                     $sub=strtolower($sub);
                     $date=date("Y-m-d H:i:s");
                     if($weight==" ")
                     {
                        $weight="null";
                     }
                     $qry="UPDATE products SET prod_name='$pname',prod_category='$cat',
                     subcat='$sub',prod_pic='$image1',prod_pic2='$image2',prod_abt='$des',
                     prod_quantity='$qty',prod_weight='$weight',prod_amt='$amt',lease='$lea',
                     upload_date='$date' WHERE prod_id='$pid'";
                     $result=mysqli_query($con,$qry) or die("errro");
                     if($result)
                     {
                        echo "Updated Successfully";
                     }
                  }
               }
               else if($check1==true && $check2==false)
               {
                  if($w!=null && $ut==null)
                  {
                        echo "Unit weight not selected";
                  }
                  else if($ut!=null && $w==null)
                  {
                        echo "Product weight not selected";
                  }
                  else
                  {
                     $cat=strtolower($cat);
                     $sub=strtolower($sub);
                     $date=date("Y-m-d H:i:s");
                     if($weight==" ")
                     {
                        $weight="null";
                     }
                     $qry="UPDATE products SET prod_name='$pname',prod_category='$cat',
                     subcat='$sub',prod_pic='$image1',prod_abt='$des',
                     prod_quantity='$qty',prod_weight='$weight',prod_amt='$amt',lease='$lea',
                     upload_date='$date' WHERE prod_id='$pid'";
                     $result=mysqli_query($con,$qry) or die("errro");
                     if($result)
                     {
                        echo "Updated Successfully";
                     }
                  }
               }
               else if($check1==false && $check2==true)
               {
                  if($w!=null && $ut==null)
                  {
                        echo "Unit weight not selected";
                  }
                  else if($ut!=null && $w==null)
                  {
                        echo "Product weight not selected";
                  }
                  else
                  {
                     $cat=strtolower($cat);
                     $sub=strtolower($sub);
                     $date=date("Y-m-d H:i:s");
                     if($weight==" ")
                     {
                        $weight="null";
                     }
                     $qry="UPDATE products SET prod_name='$pname',prod_category='$cat',
                     subcat='$sub',prod_pic2='$image2',prod_abt='$des',
                     prod_quantity='$qty',prod_weight='$weight',prod_amt='$amt',lease='$lea',
                     upload_date='$date' WHERE prod_id='$pid'";
                     $result=mysqli_query($con,$qry) or die("errro");
                     if($result)
                     {
                        echo "Updated Successfully";
                     }
                  }
               }
            }
         }
         ?>
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
         var product=$(this).attr('id');
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
      //sub categories for selected category

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
      $('#cross').click(function(){
         var pid=$('#pid').val();
         $.ajax({
            type:'post',
            url:'remImg.php',
            data:{'pid':pid},
            success:function(data)
            {
               //alert(data);
               window.location.reload();
            }
         });
      });
   </script>
</html>
