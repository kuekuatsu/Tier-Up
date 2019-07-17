<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Pay Through Debit Card</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
      <style>
         body{
            font-size:3vmin;
         }
         input
         {
            border-radius:5px;
         }
         img
         {
            width:50px;
            height:35px;
         }
      </style>
   </head>
   <body>

      <?php
   session_start();
   date_default_timezone_set('Asia/Kolkata');
   $offer=$_SESSION['offer'];
   $custom=$_SESSION["userID"];
   $payable=$_SESSION['pay'];
   $history=$_SESSION["page"];
   if(!isset($payable) || !isset($_SESSION['pinDetails']))
   {
      ?>
      <br><br><br><br>
         <div class="container">
            <div class="row justify-content-center">
               <div class="col">
                  Unauthorized Access<br>
                  Have you calculated your shipping?<br>
                  Check Your internet connection<br>
                  Go to the <a href="index.php">Home</a> page
               </div>
            </div>
         </div>
      <?php
   }
   else
   {
      unset($_SESSION['access']);
      if(strpos($payable,'.'))
      {
         $point=explode('.',$payable);
         if($point[1]>5)
         {
            $amt=ceil($payable);
         }
         else
         {
            $amt=floor($payable);
            //echo $history;
         }
      }
      else
      {
         $amt=$payable;
      }
      $host="localhost";
      $user="root";
      $pswd="";
      $db="BuildItUp_Customer";

      $con=new mysqli($host,$user,$pswd,$db) or die("con error");
      $qry="SELECT * FROM users WHERE Cust_id='$custom'";
      $res=mysqli_query($con,$qry) or die("qry Error");
      if($res)
      {
         while($r=mysqli_fetch_array($res))
         {
?>
<ul class="nav justify-content-end">
   <li class="nav-item">
      <a class="nav-link">Review Order
      </a>
   </li>
   <li class="nav-item" id="opt">
      <a class="nav-link active">Card Details
         <hr style="background-color:blue;height:0.5px;">
      </a>
   </li>
   <li class="nav-item">
      <a class="nav-link">Order Placed</a>
   </li>
</ul>
      <form>
         <br><br>
         <div class="container-fluid">
            <div class="row justify-content-around">
               <div class="col-md-7" style="border:1px solid black;border-radius:5px">
                  <br>
                  <div class="container-fluid">
                     <div class="row justify-content-center">
                        <div class="col-md-5">
                           Card Number:
                        </div>
                        <div class="col-md-5">
                           <input type="text" id="card_no" maxlength="19">
                        </div>
                     </div>
                     <br>
                     <div class="row justify-content-center">
                        <div class="col-md-5">
                           CVV:
                        </div>
                        <div class="col-md-5">
                           <input type="text" id="card_cvv" maxlength="3" style="width:20vmin;">
                           &nbsp;
                           <img src="images/cvv2.jpg">
                        </div>
                     </div>
                     <br>
                     <div class="row justify-content-center">
                        <div class="col-md-5">
                           Cardholder Name:
                        </div>
                        <div class="col-md-5">
                           <input type="text" id="card_name" placeholder=" As Written In the Card">
                        </div>
                     </div>
                     <br>
                     <div class="row justify-content-center">
                        <div class="col-md-5">
                           Postal Code:
                        </div>
                        <div class="col-md-5">
                           <input type="text" readonly id="card_pin" value=" <?php echo $r['Pincode'] ?>">
                        </div>
                     </div>
                     <br>
                     <div class="row justify-content-center">
                        <div class="col-md-5">
                           Mobile Number:
                        </div>
                        <div class="col-md-5">
                           <input type="text" readonly id="card_mob" maxlength="10"value=" <?php echo $r['Mobile'] ?>">
                        </div>
                     </div>
                     <br>
                     <div class="row justify-content-center">
                        <div class="col-md-5">
                           Email ID:
                        </div>
                        <div class="col-md-5">
                           <input type="text" readonly id="card_mail" maxlength="10" value=" <?php echo $r['Email'] ?>">
                        </div>
                     </div>
                     <br>
                     <div class="row justify-content-center">
                        <div class="col-md-5">
                           Card Expiry Date:
                        </div>
                        <div class="col-md-5">
                              <div class="row">
                                 <div class="col">
                                    <input type="text" id="card_mm" maxlength="2" placeholder="MM" style="width:100%">
                                 </div>
                                 /
                                 <div class="col">
                                    <input type="text" id="card_yyyy" maxlength="4" placeholder="YYYY" style="width:100%">
                                 </div>
                              </div>
                        </div>
                     </div>
                     <br>
                  </div>
               </div>
               <div class="col-md-4" style="border:1px solid black;border-radius:5px;background-color:rgb(247,247,247);">
                  <br>
                  <input type="hidden" id="hid" value="<?php echo $amt ?>">
                  <center><h3 class='display-4'>&#x20B9 <?php echo $amt ?></h3 class='display-4'></center>
                     <br>
                  <div class="container-fluid">
                     <div class="row">
                        <div class="col">
                           Delivery Address:
                        </div>
                        <div class="col">
                           <?php echo $r['Address']; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <br>
            <div class="row justify-content-center">
               <div class="col-md-2">
                  <input type="button" id="bill" class="btn-primary" value="&emsp;Pay&emsp;">
               </div>
            </div>
         </div>
         <?php
                  }
               }
            }
         ?>
         <script type="text/javascript">
            $('#card_no').keyup(function(){
               var num=$('#card_no').val();
               var n=num.split(" ").join('');
               var len=n.length%4;
               if(num.length<17)
               {
                  if(len=='0')
                  {
                     $('#card_no').val(num+" ")
                  }
               }
            });

            $("#bill").click(function(){
               var num=$('#card_no').val();
               var cvv=$('#card_cvv').val();
               var name=$('#card_name').val();
               var mm=$('#card_mm').val();
               var yyyy=$('#card_yyyy').val();
               var n=num.split(" ").join('');
               if(num=="" || cvv=="" || name=="" || mm=="" || yyyy=="")
               {
                  alert("Fill Up all the fields");
               }
               else
               {
                  if(num.match(/[a-z]/) || name.match(/[0-9]/) || cvv.match(/[a-z]/) || mm.match(/[a-z]/) || yyyy.match(/[a-z]/))
                  {
                     alert("Enter valid details");
                  }
                  else
                  {
                     var today=new Date();
                     //alert(today);
                     var mah=today.getMonth()+1;
                     //alert(mah);
                     var saal=today.getFullYear();
                     //alert(saal);
                     if(mm>mah && yyyy>=saal)
                     {
                        if(n.length==16 && cvv.length==3 && name.length>=10 && mm.length==2 && yyyy.length==4)
                        {
                           var type="debit";
                           var amt=$('#hid').val();
                           $.ajax({
                              type:'post',
                              url:'phpProcess/paid.php',
                              data:{'type':type,'amt':amt,'no':num,'cvv':cvv,'name':name,'m':mm,'y':yyyy},
                              success:function(data)
                              {
                                 if(!data.includes("succ"))
                                 {
                                    alert(data);
                                 }
                                 else
                                 {
                                    window.location.href="thanks.php";
                                 }
                              }
                           });
                        }
                        else
                        {
                           alert('Enter Valid Details');
                        }
                     }
                     else
                     {
                        alert("Invalid Date");
                     }
                  }
               }
            });
         </script>
      </form>
   </body>
</html>
