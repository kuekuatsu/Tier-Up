<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   </head>
   <body><br>
<?php
session_start();
if(isset($_SESSION['uname']) && $_SESSION['uname']!=='Admin')
{
   $store=$_SESSION['uname'];
   ?>
         <div class="container-fluid">
            <div class="row justify-content-end">
               <div class="col-md-2" style="text-align:center;">
                  <input type="button" style="background-color:transparent;outline:none;border:none;color:blue;font-size:22px;" id="logout" value="Logout">
               </div>
            </div>
         </div><br>
         <div class="container-fluid">
            <div class="row">
               <div class="col" style="text-align:center;">
                  <b>Product</b>
               </div>
               <div class="col-md-2" style="text-align:center;">
                  <b>Name</b>
               </div>
               <div class="col" style="text-align:center;">
                  <b>Vegan</b>
               </div>
               <div class="col" style="text-align:center;">
                  <b>Quantity</b>
               </div>
               <div class="col" style="text-align:center;">
                  <b>Customer</b>
               </div>
               <div class="col" style="text-align:center;">
                  <b>Address</b>
               </div>
               <div class="col" style="text-align:center;">
                  <b>Contact</b>
               </div>
               <div class="col" style="text-align:center;">
                  <b>Deliver On</b>
               </div>
               <div class="col" style="text-align:center;">
                  <b>Payment</b>
               </div>
               <div class="col" style="text-align:center;">
                  <b>Status</b>
               </div>
            </div>
         </div><hr>
         <div class="container-fluid">
         <?php
         $host="localhost";
         $user="root";
         $pswd="";
         $db="BuildItUp";

         $con=new mysqli($host,$user,$pswd,$db) or die("die");
         $q="SELECT * FROM orderlist WHERE store='$store' AND deliveredYet='0'";
         $res=mysqli_query($con,$q) or die("err");
         if($res)
         {
            while($row=mysqli_fetch_array($res))
            {
               $pid=$row['pid'];
               $cid=$row['cid'];
               $bid=$row['blendID'];
               $sql="SELECT * FROM products WHERE prod_id='$pid'";
               $r=mysqli_query($con,$sql) or die("err");
               if($r)
               {
                  while($pr=mysqli_fetch_array($r))
                  {
               ?>
               <div class="row item">
                  <div class="col align-self-center" style="text-align:center;">
                     <img src="data:image;base64,<?php echo $pr['prod_pic'];?>" style="height:8vw;width:8vw;">
                  </div>
                  <div class="col-md-2 align-self-center" style="text-align:center;">
                     <h3><?php echo $pr['prod_name'] ?></h3>
                     <?php
                     $a="SELECT * FROM blend WHERE id='$bid'";
                     $b=mysqli_query($con,$a) or die("aerr");
                     if($b)
                     {
                        while($l=mysqli_fetch_array($b))
                        {
                           echo "NO.: ".$l[0].'<br>';
                           if(strpos($l[offer],'%'))
                           {
                              //discount availed
                           }
                           else
                           {
                              echo "(".$l[offer].")";
                           }
                        }
                     }
                     ?>
                  </div>
                  <div class="col align-self-center" style="text-align:center;">
                     <?php
                        if($row['pveg']==1)
                        {
                           echo "
                           <h3 style='color:green;'>Eggless</h3>
                           ";
                        }
                        else
                        {
                           echo "
                           <h3 style='color:red;'>Egg</h3>
                           ";
                        }
                     ?>
                  </div>
                  <div class="col align-self-center" style="text-align:center;">
                     <?php echo $row['pqty'] ?>
                  </div>
                  <div class="col align-self-center" style="text-align:center;">
                     <?php
                     $c=new mysqli($host,$user,$pswd,"BuildItUp_Customer") or die("died");
                        $i="SELECT * FROM users WHERE Cust_id='$cid'";
                        $j=mysqli_query($c,$i) or die("ierr");
                        if($j)
                        {
                           while($k=mysqli_fetch_array($j))
                           {
                              echo $k['Name'];
                     ?>
                  </div>
                  <div class="col align-self-center" style="text-align:center;">
                     <?php echo $k['Address'];?>
                  </div>
                  <div class="col align-self-center" style="text-align:center;">
                     <?php
                     echo $k['Mobile'];
                  }
               }
            ?>
                  </div>
                  <div class="col align-self-center dt" style="text-align:center;">
                     <?php
                     echo date("d M, Y",strtotime($row['del_date']));
                     ?>
                  </div>
                  <div class="col align-self-center" style="text-align:center;">
                     <?php echo $row['status'];
                     if($row['status']=='unpaid')
                     {
                        echo "<br><h4>Take: &#x20B9 ";
                        $a="SELECT * FROM blend WHERE id='$bid'";
                        $b=mysqli_query($con,$a) or die("aerr");
                        if($b)
                        {
                           while($d=mysqli_fetch_array($b))
                           {
                              $take=($d['cost']/$d['products']);
                              if(strpos($take,'.'))
                              {
                                 $point=explode('.',$take);
                                 $f=$point[1]{1};
                                 if($f>5)
                                 {
                                    $take=ceil($take);
                                    echo $take;
                                 }
                                 else
                                 {
                                    $take=floor($take);
                                    echo $take;
                                 }
                              }
                              else
                              {
                                 echo $take;
                              }
                              /*$take=($d['cost']/$d['products']);
                              echo $take;*/
                           }
                        }
                        echo "</h4>";
                     }
                     ?>
                  </div>
                  <div class="col align-self-center" style="text-align:center;">
                     <input type="button" name="<?php echo $pr['prod_id'] ?>" value="Delivered" id="<?php echo date('d-m-y',strtotime($row['del_date'])) ?>" class="del">
                     <input type="hidden" id="hid" value="<?php echo date('d-m-y') ?>">
                  </div>
               </div>
               <hr>
               <br>
               <?php
                  }
               }
            }
         }?>
      </div>
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

$('.del').click(function(){
   //alert($(this).attr('id'));
   //alert($('#hid').val()); --Today's date
   var delivery=$(this).attr('id');
   var pid=$(this).attr('name');
   var today=$('#hid').val();
   if(delivery==today)
   {
      var a=confirm("Have you delivered the product?");
      if(a==true)
      {
         //alert(pid);
         $.ajax({
            type:'post',
            url:'delivered.php',
            data:{'pid':pid},
            success:function(data){
               //alert(data);
               window.location.reload();
            }
         });
      }
      else
      {
         alert("Only update once delivery is done");
      }
   }
   else
   {
      alert("The delivery is scheduled for "+delivery);
   }
});
</script>
