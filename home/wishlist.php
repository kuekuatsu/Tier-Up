<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Wishlist</title>
      <link href="https://fonts.googleapis.com/css?family=Dosis:300|Open+Sans|Raleway:600|Berkshire+Swash|Comfortaa|Courgette|Lobster+Two|Merienda|Playball|Satisfy|Sofia|Englebert" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="css/buyDecor.css?version=10">
         <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKGXdBEA0JhXqbtj2JaiufVrdX8p-LVxQ&callback=initMap"
           type="text/javascript"></script>
   </head>
   <body>
<?php
session_start();
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
date_default_timezone_set('Asia/Kolkata');
unset($_SESSION['pinDetails']);
if(!isset($_SESSION["username"]))
{
   //echo "Loggin first <a href='login.php'>Login</a>";
   ?>
   <br><br><br><br>
      <div class="container">
         <div class="row justify-content-center">
            <div class="col">
               Oops Something Went Wrong<br>
               Have You tried Logging in yet <a href="login.php">Login</a>
            </div>
         </div>
      </div>
   <?php
}
else
{
   //echo "Hi ".$_SESSION["username"];
   $custom=$_SESSION["userID"];
   //echo "hey ".$custom;
   $_SESSION["page"]="wish";
   $host="localhost";
   $user="root";
   $password="";
   $db="BuildItUp_customer";

   $con=new mysqli($host,$user,$password,$db) or die("unable to connect");
   $query="SELECT * FROM wish WHERE CustomerID='$custom'";
?>
<form method="post" id='<?php echo $custom ?>'><!--on change of quantity too it acts as link.. thus the dblclick-->
   <nav class="nav nav-tabs">
      <li class="nav-item">
          <a class="myNav nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item" id="login">
          <a class="myNav nav-link" href="login.php">Login</a>
      </li>
   <!--   <li class="nav-item">
          <a class="myNav nav-link" href="#">Build</a>
      </li> -->
      <li class="nav-item">
          <a class="myNav nav-link active">Wishlist <sup><span class="badge badge-secondary" id="wishes"></span></sup></a>
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
    </nav><br>
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
<?php
   $result=mysqli_query($con,$query) or die("query error");
   if($result)
   {
      if(mysqli_num_rows($result)>0)
      {
      while($row=mysqli_fetch_array($result))
      {//foreign_key
         $id=$row["ProductID"];
            $db2="BuildItUp";
            $con2=new mysqli($host,$user,$password,$db2) or die("unable to connect(2) ");
            $qry="SELECT * FROM products WHERE prod_id=$row[ProductID]";
            $res=mysqli_query($con2,$qry) or die("query error(2)");
            if($res->num_rows>0)
            {
               while($row2=mysqli_fetch_array($res))
               {
                  $totalSum=$row['Quantity']*$row2['prod_amt'];
?>
         <input type="hidden" id="whereFrom" value="<?php echo $_SESSION['iAmAt'] ?>">
         <input type="hidden" value="wish" name="pageTable">
         <a class="items" id="<?php echo $row2['prod_id']?>" onclick="return false" ondblclick="location=this.href" href="product.php">

            <div class="container-fluid">
               <div class="row th justify-content-center">
                  <div class="col-md-2">
                     <center>Product</center>
                  </div>
                  <div class="col-md-3">
                     <center>Name</center>
                  </div>
                  <div class="col-md-1">
                     <center>Price</center>
                  </div>
                  <div class="col-md-1">
                     <center>Quantity</center>
                  </div>
                  <div class="col-md-1">
                     <center>Vegan</center>
                  </div>
                  <div class="col-md-1">
                     <center>Total</center>
                  </div>
         <!--         <div class="col-md-1">
                     <center>Delivery</center>
                  </div>   -->
                  <div class="col-md-2">
                     <center></center>
                  </div>
               </div>
               <hr>
               <div class="row td justify-content-center" id="each">
                  <div class="col-md-2">
                     <img src="data:image;base64,<?php echo $row2['prod_pic'] ?>" style="border-radius:7px 7px 7px 7px;height:13vw;width:13vw;">
                  </div>
                  <div class="col-md-3 pos">
                     <center><h3><?php echo $row2['prod_name'] ?></h3></center>
                  </div>
                  <div class="col-md-1 pos">
                     <p>
                        <input type="text" id="amt" readonly class="amt form-control-plaintext" value="<?php echo $row2['prod_amt'] ?>" style="width:100%;text-align:center;">
                     </p>
                  </div>
                  <div class="col-md-1 pos">
                     <center>
                        <input type="hidden" class="pidHide" id="pidHide" value="<?php echo $row['ProductID'] ?>">
                        <input type="number" min="1" max="5" class="quan" id="quan" value="<?php echo $row['Quantity'] ?>" style="text-align:center;width:50;">
                     </center>
                  </div>
                  <div class="col-md-1 pos">
                     <center>
                  <?php
                     if($row['vegan']==0)  //egg//9747
                     {
                        echo "<input type='text' readonly class='veg' id='".$row['ProductID']."' name='egg' value='&#10007' style='text-align:center;width:20px;'>";
                     }
                     else //eggless =1
                     {
                        echo "<input type='text' readonly class='veg' id='".$row['ProductID']."' name='eggless' value='&#10003' style='text-align:center;width:20px;'>";
                     }
                  ?>
                     </center>
                  </div>
                  <div class="col-md-1 pos">
                     <input type="text" id="price" readonly class="price form-control-plaintext" value="<?php echo $row['FinalPrice'] ?>" style="width:100%;text-align:center;">
                  </div>
                  <div class="col-md-2">
                     <button type="button" id="<?php echo $row['ProductID'] ?>" name="cart" class="btn moveToCart pos">Move to Cart</button>
                     <p class="remove" id="<?php echo $row['ProductID'] ?>" style="float:right;cursor:pointer;">x</p>
                  </div>
               </div>
            </br>
            </div>
         </a>
         <?php
         }
         }
         }
         ?>
      </br>
         <div class="container">
            <div class="row justify-content-end">
      <!--         <div class="col-md-4">
                  Store Locations:
                  <div id="map" style="width:100%;height:350px;background:yellow"></div>
               </div>-->
               <div class="col-md-4" style="background-color:rgb(247,247,247);">
                  <br><br>
                  <center><h5>Estimate your Shipping cost now:</h5></center>
                     <br>
            <!--      <select id="Maharashtra" class="state" disabled>
                     <option>Maharashtra</option>
                  </select>   -->
            <!--      &emsp;
                  <select id="city">
                     <option>Mumbai</option>
                     <option>Pune</option>   -->
            <!--         <option>Delhi</option>
                     <option>Pune</option>
                  </select> -->
                  <div class="container-fluid">
                     <div class="row">
                        <div class="col">
                           <center><input type="text" placeholder="ENTER PINCODE" id="pinc" style="border-radius:5px;" class="pinc"></center>
                        </div>
                     </div>
                     <br>
                     <div class="row">
                        <div class="col">
                           <center><input type="button" value="Calculate" id="quote" class="btn btn-md"></center>
                        </div>
                     </div>
                  </div>
                  <p id="area"></p>
               </div>
               <div class="col-md-4" style="border:1px solid black">
                  <br>
                  <table width="100%" cellpadding="5px">
                     <tr>
                        <th id="top">Subtotal:</th>
                        <td id="total"></td>
                     </tr>
                     <tr>
                        <th>Shipping:</th>
                        <td id="ship">0</td>
                     </tr>
                     <tr>
                        <th>Discount:</th>
                        <td id="disc">0</td>
                     </tr>
                     <tr>
                        <th><h3>TOTAL:</h3></th>
                        <td><h3 id="grand"></h3></td>
                     </tr>
                     <tr>
                        <td colspan="2">
                           <center>
                              <input type="button" name="checkout" id="checkout" class="btn btn-primary" value="Direct Checkout">
                           </center>
                        </td>
                     </tr>
                  </table>
                  <input type="hidden" id="pinDetails">
                  <br>
               </div>
            </div>
         </div>
         <?php
      }
      else//page empty
      {
         ?>
         <center>
            <p style="font-size:50px;">There is no product in your Wishlist</p>
            <a style="font-size:30px;text-decoration:none;" href="<?php echo $_SESSION['iAmAt'] ?>">Continue Shopping</a>
         </center>
         <?php
      }
      }
      }
         ?>
      </body>
   </form>
</html>
<script type="text/javascript">
$(document).ready(function(){
   var t=$('form').attr('id');
   var page="wish";
   $.ajax({ //billtotal
      type:'post',
      url:'phpProcess/subtotal.php',
      data:{'cust':t,'page':page},
      success:function(data)
      {
         if(data!="nm")
         {
            //it triggers the change event
            $('#total').html(data);
         }
      },
      complete:function(data)
      {
         calculate();   //for grand total
      }
   });
   function calculate()
   {
      var tot=$('#total').text();
      var disc=$('#disc').text();
      var ship=$('#ship').text();
      $.ajax({
         type:'post',
         url:'phpProcess/grand.php',
         data:{'total':tot,'discount':disc,'shipping':ship},
         success:function(data)
         {
            $('#grand').html(data);
         }
      });
   }

      $('#quote').click(function(){
         var city=$('#city option:selected').val();
         var pincode=$('#pinc').val();
         $.ajax({
            type:'post',
            url:'phpProcess/genArea.php',
            data:{'pin':pincode},
            success:function(data){
               if(data.includes(':'))
               {
                  var r=data.split(":");
                  alert(r[1]);
               }
               else
               {
                  var arr=data.split('/');
                  //arr[0]=distance, arr[1]=pin loaction, $arr[2]=shipping cost, $arr[3]=closest store
                  alert("Our closest store "+arr[3]+" is "+arr[0]+"km away from "+arr[1]);
                  $('#ship').html(arr[2]);
                  $('#pinDetails').val(data);
               }
            },
            complete:function(data)
            {
               calculate();
            }
         });
      });
      //alert(city);
      //total on change of quantity
      $(".td").change(function(){
         var uprice=$(this).find('#amt').val();
         var quantity=$(this).find('.quan').val();
         var pid=$(this).find('.pidHide').val();
         $.ajax({
            url:"phpProcess/calcWish.php",
            type:"post",
            context:this,
            data:{"qty":quantity,"pid":pid,"uprice":uprice},
            success:function(data)
            {
               $(this).find("#price").val(data);
               window.location.reload();
            }
         });
      });
      //veg or not
      $('.veg').click(function(){
         var pid=$(this).attr('id');
         var tableName="wish";
         var val=$(this).attr('name');
         //alert(val);
         $.ajax({
            type:'post',
            url:'phpProcess/setVegan.php',
            data:{'val':val,'page':tableName,'pid':pid},
            success:function(data){
               //alert(data);
               window.location.reload();
            }
         });
      });
      //Move to cart button
      $(".moveToCart").click(function(){
         var pid=$(this).attr('id');
         $.ajax({
            url:"phpProcess/movetocart.php",
            type:"post",
            data:{"pid":pid},
            success:function(data)
            {
               //alert(data);
               window.location.reload();
            }
         });
      });
      //remove from wishlist
      $(".remove").click(function(){
         var pid=$(this).attr('id');
         var tableName="wish";
         $.ajax({
            url:"phpProcess/removeProduct.php",
            type:"post",
            data:{"pid":pid,"table":tableName},
            success:function(data)
            {
               //alert(data);
               window.location.reload();
            }
         });
      });
});
//To create session proID storing product id that can be used in product.php page
$(".items").click(function(){
   var prod=$(this).attr("id");
   $.ajax({
      url:"phpProcess/setProductCookie.php",
      type:"post",
      data:{"prod":prod},
      success:function(data){
      }
   });
});
$('#checkout').click(function(){
   var page="wish";
   var customer=$('form').attr('id');
   var pinDetails=$('#pinDetails').val();
   $.ajax({
      type:'post',
      url:'phpProcess/orderNow.php',
      data:{'page':page,'me':customer,'area':pinDetails},
      success:function(data)
      {
         //alert(data);
         window.location.href="checkout.php";
      }
   });
});
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
</script>
