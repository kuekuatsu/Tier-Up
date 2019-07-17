<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$forward=$_SESSION["pinDetails"];
unset($_SESSION['offer']);
unset($_SESSION['pay']);

if(!isset($_SESSION["username"]))
{
   ?>
   <br><br><br><br>
      <div class="container">
         <div class="row justify-content-center">
            <div class="col" style="font-family:'Raleway',sans-serif;font-size:3vmin;">
               Unauthorized Access<br>
               Go to the <a href="index.php">Home</a> page
            </div>
         </div>
      </div>
   <?php
}
else
{
   if(!isset($_SESSION['access']))
   {
      ?>
      <br><br><br><br>
         <div class="container">
            <div class="row justify-content-center">
               <div class="col" style="font-family:'Raleway',sans-serif;font-size:3vmin;">
                  Unauthorized Access<br>
                  Go to the <a href="index.php">Home</a> page
               </div>
            </div>
         </div>
      <?php
   }
   else
   {
   echo "Hi ".$_SESSION["username"];
   $custom=$_SESSION["userID"];
   $past=$_SESSION["page"];

   if(empty($forward))
   {
      //echo "empty";
   }
   else
   {
      $values=explode("/",$forward);
      //echo $forward;
      $pincode=$values[0];
      $city=$values[1];
      $shipCost=$values[2];
      $store=$values[3];
   }
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Checkout page</title>
      <link href="css/final.css?version=6" style="text/css" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Dosis:300|Open+Sans|Raleway:600|Berkshire+Swash|Comfortaa|Courgette|Lobster+Two|Merienda|Playball|Satisfy|Sofia|Englebert" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
      <!--<style>
      body{
         /*font-family:'Open Sans',sans-serif;*/
         font-family:'Raleway',sans-serif;
         font-weight:bolder;
         font-size:20px;
      }
   </style>-->
   </head>
   <body>
      <ul class="nav justify-content-end">
         <li class="nav-item">
            <a class="nav-link active">Review Order
               <hr style="background-color:blue;height:0.5px;">
            </a>
         </li>
         <li class="nav-item" id="opt" style="display:none;">
            <a class="nav-link">Card Details</a>
         </li>
         <li class="nav-item">
            <a class="nav-link">Order Placed</a>
         </li>
      </ul>
      <form>
         <div class="whole container-fluid">
            <div class="row justify-content-center"><!--4 in-->
               <div class="col-md-4 bord"><!--1 in-->
                  <div class="set_title">
                     &#9312; Billing Address
                  </div>
                  <hr>
                  <div id="billForm" class="form">
                     <div class="container">
                        <div class="row">
                           <input type="hidden" id="hidC" value="<?php echo $custom ?>">
                           <div class="col-lg-6">
                              First Name:<br>
                              <input type="text" id="fname">
                           </div>
                           <div class="col-lg-6">
                              Last Name:<br>
                              <input type="text" id="lname">
                           </div>
                        </div>
                        <br>
                        <div class="row">
                           <div class="col-lg-12">
                              Address:<br>
                              <textarea id="adr">
                              </textarea>
                           </div>
                        </div>
                        <br>
                        <div class="row">
                           <div class="col-lg-6">
                              City:<br>
                              <input type="text" id="city" value="<?php echo $city?>">
                           </div>
                           <div class="col-lg-6">
                              Pincode:<br>
                              <input type="text" id="pin" value="<?php echo $pincode?>">
                           </div>
                        </div>
                        <br>
                        <div class="row">
                           <div class="col-lg-6">
                              Mobile Number:<br>
                              <input type="text" id="mob">
                           </div>
                           <div class="col-lg-6">
                              Email Address:<br>
                              <input type="text" id="mail">
                           </div>
                        </div>
                        <br>
                  <!--      <div class="row">
                           <div class="col">
                              <center>
                                 <input type="hidden" id="ver">
                                 <input type="button" id="verMail" class="btn-primary" value="Verify email">
                              </center>
                           </div>
                        </div>   -->
                     </div>
                     <br>
                  </div>
               </div>
               <div class="col-md-7"><!--3 in-->
                  <div class="container-fluid">
                     <div class="row justify-content-around"><!--2in-->
                        <div class="col-md-6 bord"><!--1-->
                           <div class="set_title">
                              &#9313; Taxes and Offers
                           </div>
                           <hr>
                           <div class="form">
                              Shipping Cost:
                              <input type="text" id="ship" value="<?php echo $shipCost ?>" style="border:none;">
                              <br>
                              Avail Offers:
                              <select id="offer">
                                 <option>A box of 6 cake pops</option>
                                 <option>12% discount</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-5 bord"><!--1-->
                           <div class="set_title">
                              &#9314; Payment Method
                           </div>
                           <hr>
                           <div class="form">
                              &emsp;
                              <input type="radio" name="anyone" id="cre" value="credit">
                              <label for="cre">Credit Card Payment</label>
                              <br>
                              &emsp;
                              <input type="radio" name="anyone" id="deb" value="debit">
                              <label for="deb">Debit Card Payment</label>
                              <br>
                              &emsp;
                              <input type="radio" name="anyone" id="cod" value="cod">
                              <label for="cod">Cash On Delivery</label>
                              <br>
                           </div>
                        </div>
                     </div>
                     <br>
                     <div class="row justify-content-center">
                        <div class="col-md-12 bord">
                           <div class="set_title">
                              &#9315; Review your Order
                           </div>
                           <hr>
                           <div class="container-fluid">
                              <div class="row no-gutters" style="font-weight:bold;border-bottom:1px solid black;">
                                 <div class="col-md-2">Pic</div>
                                 <div class="col-md-2">Name</div>
                                 <div class="col">Cost</div>
                                 <div class="col">Qty.</div>
                                 <div class="col">Vegan</div>
                                 <div class="col">Delivery</div>
                                 <div class="col" style="text-align:center;">Total</div>
                              </div>
         <?php
            $h="localhost";
            $u="root";
            $p="";
            $db="BuildItUp";
            $db2="BuildItUp_Customer";
            $sum="";

            $con=new mysqli($h,$u,$p,$db) or die('conError');
            $c=new mysqli($h,$u,$p,$db2) or die('conError');
            $sql="SELECT * FROM orders WHERE customerID='$custom'";
            $res=mysqli_query($con,$sql) or die('sqlError');
            if($res)
            {
               while($ro=mysqli_fetch_array($res))
               {
                  $pid=$ro['prod_id'];
                  $q="SELECT * FROM $past WHERE ProductID='$pid'";
                  $r=mysqli_query($c,$q) or die("Qerr");

                  $m="SELECT * FROM products WHERE prod_id='$pid'";
                  $n=mysqli_query($con,$m) or die("merr");
                  if($r && $n)
                  {
                     while($i=mysqli_fetch_array($r))
                     {
                        if($n)
                        {
                           while($o=mysqli_fetch_array($n))
                           {
                              $total=$i['Quantity']*$o['prod_amt'];
         ?>
                              <div class="row no-gutters">
                                 <div class="col-md-2"><img src="data:image;base64,<?php echo $o['prod_pic']; ?>" height="70px" width="70px"></div>
                                 <div class="col-md-2"><?php echo $o['prod_name']; ?></div>
                                 <div class="col"><?php echo $o['prod_amt']; ?></div>
                                 <div class="col"><?php echo $i['Quantity']; ?></div>
                                 <div class="col">
                                 <?php
                                    if($i['vegan']==0)
                                    {
                                       echo "<input type='text' readonly class='veg' id='".$row['ProductID']."' name='egg' value='&#10007' style='text-align:center;width:50;'>";
                                    }
                                    else
                                    {
                                       echo "<input type='text' readonly class='veg' id='".$row['ProductID']."' name='egg' value='&#10003' style='text-align:center;width:50;'>";
                                    }
                                 ?>
                                 </div>
                                 <?php
                                    //$d=$o['lease'];
                                    $dat=date("y-n-j",strtotime($ro['delivery_date']));
                                 ?>
                                 <div class="col" style="width:100%">
                                    <input type="text" class="day" id="<?php echo $pid?>" value="<?php echo $dat ?>" style="width:100%">
                                 </div>
                                 <div class="col" style="text-align:center;"><?php echo $total; ?></div>
                              </div>

         <?php
            $sum=$sum+$total;
                           }
                        }
                     }
                  }
               }
            }
         ?>
         <div class="row justify-content-end">
            <div class="col-md-2">
               Sub Total:
            </div>
            <div class="col-md-2">
               <input type="text" id="sub" readonly value="<?php echo $sum ?>" style="border:none;background-color:transparent;">
            </div>
         </div>
         <div class="row justify-content-end">
            <div class="col-md-2">
               +Shipping:
            </div>
            <div class="col-md-2">
               <input id="addto" type="text" readonly value="<?php echo $shipCost ?>" style="border:none;background-color:transparent;">
            </div>
         </div>
         <div class="row justify-content-end">
            <div class="col-md-2">
               -&nbsp;Discount:
            </div>
            <div class="col-md-2">
               <input id="minus" type="text" readonly value="0" style="border:none;background-color:transparent;">
            </div>
         </div>
         <div class="row justify-content-end">
            <div class="col-md-2">
               <h3>TOTAL:</h3>
               <input type="hidden" id="hideIt" value="<?php echo $store ?>">
            </div>
            <div class="col-md-2">
               <?php
                  $final=$sum+$shipCost;
               ?>
               <input type="text" id="score" value="<?php echo $final ?>" readonly style="font-size:25px;border:none;background-color:transparent;">
            </div>
         </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <br>
            <div class="container">
               <div class="row justify-content-end">
                  <div class="col-md-2">
                     <input type="button" id="orderPlaced" class="btn-primary btn-lg" value="Confirm Order">
                  </div>
               </div>
            </div>
         </div>
         <?php }
         }?>
      </form>
      <script type="text/javascript">
         $(document).ready(function(){
            var id=$('#hidC').val();
            $.ajax({
               type:'post',
               url:'phpProcess/autofill.php',
               data:{'id':id},
               success:function(data)
               {
                  var op=data.split("/");
                  var name=op[0].split(" ");
                  $('#fname').val(name[0]);
                  $('#lname').val(name[1]);
                  $('#mail').val(op[1]);
                  if($('#city').val()=="")
                  {
                     $('#city').val(op[4]);
                  }
                  $('#adr').val(op[3]);
                  if(op[2]!=0)
                  {
                     $('#mob').val(op[2]);
                  }
                  if($('#pin').val()=="")
                  {
                     if(op[5]!=0)
                     {
                        $('#pin').val(op[5]);
                        var pincode=$('#pin').val();
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
                                 //alert("Our closest store "+arr[3]+" is "+arr[0]+"km away from "+arr[1]);
                                 $('#ship').val(arr[2]);
                                 $('#addto').val(arr[2]);
                                 $('#hideIt').val(arr[3]);
                                 //window.location.reload();
                              }
                           },
                           complete:function(){
                              calculate();
                           }
                        });
                     }
                  }
               }
            });
         });

         $('#pin').change(function(){
            var pincode=$('#pin').val();
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
                     //alert("Our closest store "+arr[3]+" is "+arr[0]+"km away from "+arr[1]);
                     $('#ship').val(arr[2]);
                     $('#addto').val(arr[2]);
                     $('#hideIt').val(arr[3]);
                     //window.location.reload();
                  }
               },
               complete:function(){
                  calculate();
               }
            });
         });

         $('.day').change(function(){
            var d=$(this).val();
            var cus=$('#hidC').val();
            var pro=$(this).attr('id');
            $.ajax({
               type:'post',
               url:'phpProcess/validDate.php',
               data:{'d':d,'p':pro,'c':cus},
               success:function(data){
                  if(data!='')
                  {
                     alert(data);
                     $('#orderPlaced').attr("disabled","disabled");
                  }
                  else
                  {
                     $('#orderPlaced').attr("disabled",false);
                  }
               }
            });
         });

$('input[type="radio"]').click(function(){
   var pay=$('input[name="anyone"]:checked').val();
   if(pay=="credit" || pay=="debit")
   {
      $('#opt').css('display','block');
   }
   else
   {
      $('#opt').css('display','none');
   }
});
         $('#orderPlaced').click(function(){
            var offer=$('#offer option:checked').val();
            var pay=$('input[name="anyone"]:checked').val();
            var fname=$('#fname').val();
            var lname=$('#lname').val();
            var adr=$('#adr').val();
            var city=$('#city').val();
            var pin=$('#pin').val();
            var ship=$('#addto').val();
            var loca=$('#hideIt').val();
            var mob=$('#mob').val();
            var mail=$('#mail').val();
            var amtPayable=$('#score').val();
            var disc=$('#minus').val();

            if(!$('input[name="anyone"]').is(':checked'))
            {
               alert('Select a Payment Method');
            }
            else
            {
               if(fname=='' || lname=='' || adr==''|| city=='' || pin=='' || mob=='' || mail=='')
               {
                  alert("Please enter all your details");
               }
               else
               {
               //var cus=$('#hidC').val();
                  $.ajax({
                     type:'post',
                     url:'phpProcess/confirmOrder.php',
                     data:{'pay':pay,'amtPayable':amtPayable,'loca':loca,'ship':ship,'discount':disc,'offer':offer,'fname':fname,'lname':lname,'mob':mob,'mail':mail,'city':city,'pin':pin,'adr':adr},
                     success:function(got){
                        if(got.includes('goto:'))
                        {
                           var redirect=got.split(':')
                           //alert(redirect[1]);
                           window.location.href=redirect[1];
                        }
                        else
                        {
                           alert(got);
                        }
                     }
                  });
               }
            }
         });
         function calculate()
         {
            var offer=$('#offer option:checked').val();
            var sub=$('#sub').val();
            var addto=$('#addto').val();
            var minus=$('#minus').val();
            if(offer.includes('%'))
            {
               var discount=offer.split("%");
               $.ajax({
                  type:'post',
                  url:'phpProcess/calcTotal.php',
                  data:{'disc':discount[0],'sub':sub,'add':addto,'minus':minus},
                  success:function(data)
                  {
                     var values=data.split('/');
                     $('#minus').val(values[0]);
                     $('#score').val(values[1]);
                  }
               });
            }
            else
            {
               //alert("nothing");
               $.ajax({
                  type:'post',
                  url:'phpProcess/calcTotal.php',
                  data:{'sub':sub,'add':addto,'minus':minus},
                  success:function(data)
                  {
                     var values=data.split('/');
                     $('#minus').val(values[0]);
                     $('#score').val(values[1]);
                  }
               });
            }
         }
         $('#offer').change(function(){
            var offer=$('#offer option:checked').val();
            var sub=$('#sub').val();
            var addto=$('#addto').val();
            var minus=$('#minus').val();
            if(offer.includes('%'))
            {
               var discount=offer.split("%");
               $.ajax({
                  type:'post',
                  url:'phpProcess/calcTotal.php',
                  data:{'disc':discount[0],'sub':sub,'add':addto,'minus':minus},
                  success:function(data)
                  {
                     var values=data.split('/');
                     $('#minus').val(values[0]);
                     $('#score').val(values[1]);
                  }
               });
            }
            else
            {
               //alert("nothing");
               $.ajax({
                  type:'post',
                  url:'phpProcess/calcTotal.php',
                  data:{'sub':sub,'add':addto,'minus':minus},
                  success:function(data)
                  {
                     var values=data.split('/');
                     $('#minus').val(values[0]);
                     $('#score').val(values[1]);
                  }
               });
            }
         });
      </script>
   </body>
</html>
