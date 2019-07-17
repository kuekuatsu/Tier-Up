<?php
   session_start();
//echo $_SESSION['qry'];
   date_default_timezone_set('Asia/Kolkata');
   $_SESSION['iAmAt']="breadPage.php";
   if(isset($_SESSION["username"]))
   {
      $cid=$_SESSION["userID"];
      #user is logged in
      #echo "Welcome, ".$_SESSION["username"];
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
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Breads</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" charset="utf-8">

    <!-- If you’re using our compiled JavaScript, don’t forget to include CDN versions of jQuery and Popper.js before it.
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    -->
    <!-- Bootstrap CSS & JS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
   <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>-->

    <link rel="stylesheet" href="css/category.css?version=26" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Indie+Flower|Raleway:600|Allura|Berkshire+Swash|Comfortaa|Courgette|Lobster+Two|Merienda|Playball|Satisfy|Sofia|Englebert|Open+Sans" rel="stylesheet">
    <!--_Indie+Flower|Allura|Berkshire+Swash|Comfortaa|Courgette|Lobster+Two|Merienda|Playball|Satisfy-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style type="text/css">
    .loader {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9;
	background: url('images/pie.gif') 50% 50% no-repeat rgb(249,249,249);
}
    </style>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
	$(".loader").fadeOut("slow");
})
</script>
  </head>
  <body>
     <div class="loader"></div>
     <!--Menu code-->
     <div id="filterMenu" style="overflow-y:scroll;">
        <div style="margin-left:2px;">
         <div class="accordion" id="accordion">
            <div class="card">
               <div class="card-header" id="headingOne">
                     <button class="btn btn-secondary" data-toggle="collapse" data-target="#cakeOpts" aria-expanded="true" aria-controls="cakeOpts">
                        Cake
                     </button>
               </div>
               <div id="cakeOpts" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body">
                     <input type="checkbox" name="allCake" id="allCake" value="allCake">
                     <label for="allCake">All</label>
                     <br>
                     <input class="cakeWorld" type="checkbox" name="chsCake" id="chsCake" value="chsCake">
                     <label for="chsCake">Cheesecake</label>
                     <br>
                     <input class="cakeWorld" type="checkbox" name="frtCake" id="frtCake" value="frtCake">
                     <label for="frtCake">Fruit Cake</label>
                     <br>
                     <input class="cakeWorld" type="checkbox" name="gtCake" id="gtCake" value="gtCake">
                     <label for="gtCake">Gateau</label>
                     <br>
                     <input class="cakeWorld" type="checkbox" name="srCake" id="srCake" value="srCake">
                     <label for="srCake">Swiss Roll</label>
                     <br>
                     <input class="cakeWorld" type="checkbox" name="cpCake" id="cpCake" value="cpCake">
                     <label for="cpCake">Cake Popsicles</label>
                     <br>
                     <input class="cakeWorld" type="checkbox" name="pndCake" id="pndCake" value="pndCake">
                     <label for="pndCake">Pound Cake</label>
                     <br>
                     <input class="cakeWorld" type="checkbox" name="spngCake" id="spngCake" value="spngCake">
                     <label for="spngCake">Sponge Cake</label>
                     <br>
                     <input class="cakeWorld" type="checkbox" name="afCake" id="afCake" value="afCake">
                     <label for="afCake">Angel Food Cake</label>
                     <br>
                     <input class="cakeWorld" type="checkbox" name="chifCake" id="chifCake" value="chifCake">
                     <label for="chifCake">Chiffon Cake</label>
                     <br>
                     <input class="cakeWorld" type="checkbox" name="bdtCake" id="bdtCake" value="bdtCake">
                     <label for="bdtCake">Bundt Cake</label>
                     <br>
                     <input class="cakeWorld" type="checkbox" name="iceCake" id="iceCake" value="iceCake">
                     <label for="iceCake">Ice-Cream Cake</label>
                     <br>
                     <input class="cakeWorld" type="checkbox" name="broCake" id="broCake" value="broCake">
                     <label for="broCake">Brownie</label>
                     <br>
                     <input class="cakeWorld" type="checkbox" name="fanCake" id="fanCake" value="fanCake">
                     <label for="fanCake">Fancy Cake</label><!--.eg. Tiramisu, Opera-->
                     <br>
                     <input class="cakeWorld" type="checkbox" name="hltCake" id="hltCake" value="hltCake">
                     <label for="hltCake">Healthy Cake</label>
                  </div>
               </div>
            </div>

            <div class="card">
               <div class="card-header" id="headingTwo">
                     <button class="btn btn-secondary collapsed" data-toggle="collapse" data-target="#cookieOpts" aria-expanded="false" aria-controls="cookieOpts">
                        Cookie
                     </button>
               </div>
               <div class="collapse" id="cookieOpts" aria-labelledby="headingTwo" data-parent="#accordion">
                  <div class="card-body">
                     <input type="checkbox" name="allCookie" id="allCookie" value="allCookie">
                     <label for="allCookie">All</label>
                     <br>
                     <input type="checkbox" class="cookieWorld" name="mrgCookie" id="mrgCookie" value="mrgCookie">
                     <label for="mrgCookie">Meringue</label>
                     <br>
                     <input type="checkbox" class="cookieWorld" name="sgrCookie" id="sgrCookie" value="sgrCookie">
                     <label for="sgrCookie">Sugar Cookie</label>
                     <br>
                     <input type="checkbox" class="cookieWorld" name="ginCookie" id="ginCookie" value="ginCookie">
                     <label for="ginCookie">Ginger Cookie</label>
                     <br>
                     <input type="checkbox" class="cookieWorld" name="macCookie" id="macCookie" value="macCookie">
                     <label for="macCookie">Macaron</label>
                     <br>
                     <input type="checkbox" class="cookieWorld" name="flvCookie" id="flvCookie" value="flvCookie">
                     <label for="flvCookie">Flavored</label>
                     <br>
                     <input type="checkbox" class="cookieWorld" name="ckCookie" id="ckCookie" value="ckCookie">
                     <label for="ckCookie">Cake Cookie</label>
                     <br>
                     <input type="checkbox" class="cookieWorld" name="hltCookie" id="hltCookie" value="hltCookie">
                     <label for="hltCookie">Healthy Cookie</label>
                  </div>
               </div>
            </div>

            <div class="card">
               <div class="card-header" id="headingThree">
                     <button class="btn btn-secondary collapsed" data-toggle="collapse" data-target="#cupcakeOpts" aria-expanded="false" aria-controls="cupcakeOpts">
                        Cupcake
                     </button>
               </div>
               <div class="collapse" id="cupcakeOpts" aria-labelledby="headingThree" data-parent="#accordion">
                  <div class="card-body">
                     <input type="checkbox" name="allCup" id="allCup" value="allCup">
                     <label for="allCup">All</label>
                     <br>
                     <input type="checkbox" class="cupWorld" name="clrCup" id="clrCup" value="clrCup">
                     <label for="clrCup">Colorful Cupcake</label>
                     <br>
                     <input type="checkbox" class="cupWorld" name="broCup" id="broCup" value="broCup">
                     <label for="broCup">Brownie Cupcake</label>
                     <br>
                     <input type="checkbox" class="cupWorld" name="flvCup" id="flvCup" value="flvCup">
                     <label for="flvCup">Flavour Infused</label>
                     <br>
                     <input type="checkbox" class="cupWorld" name="mufCup" id="mufCup" value="mufCup">
                     <label for="mufCup">Muffin</label>
                     <br>
                     <input type="checkbox" class="cupWorld" name="lavaCup" id="lavaCup" value="lavaCup">
                     <label for="lavaCup">Lava Cupcake</label>
                     <br>
                     <input type="checkbox" class="cupWorld" name="hltCup" id="hltCup" value="hltCup">
                     <label for="hltCup">Healthy Cupcake</label>
                  </div>
               </div>
            </div>

            <div class="card">
               <div class="card-header" id="headingFour">
                     <button class="btn btn-secondary collapsed" data-toggle="collapse" data-target="#breadOpts" aria-expanded="false" aria-controls="breadOpts">
                        Bread
                     </button>
               </div>
               <div class="collapse show" id="breadOpts" aria-labelledby="headingFour" data-parent="#accordion">
                  <div class="card-body">
                     <input type="checkbox" name="allBread" id="allBread" value="allBread">
                     <label for="allBread">All</label>
                     <br>
                     <input type="checkbox" class="breadWorld" name="wBread" id="wBread" value="wBread">
                     <label for="wBread">White Bread</label>
                     <br>
                     <input type="checkbox" class="breadWorld" name="bBread" id="bBread" value="bBread">
                     <label for="bBread">Brown Bread</label>
                     <br>
                     <input type="checkbox" class="breadWorld" name="pitBread" id="pitBread" value="pitBread">
                     <label for="pitBread">Pita Bread</label>
                     <br>
                     <input type="checkbox" class="breadWorld" name="broBread" id="broBread" value="broBread">
                     <label for="broBread">Brioche</label>
                     <br>
                     <input type="checkbox" class="breadWorld" name="bagBread" id="bagBread" value="bagBread">
                     <label for="bagBread">Baguette</label>
                     <br>
                     <input type="checkbox" class="breadWorld" name="bnBread" id="bnBread" value="bnBread">
                     <label for="bnBread">Bun</label>
                     <br>
                     <input type="checkbox" class="breadWorld" name="bglBread" id="bglBread" value="bglBread">
                     <label for="bglBread">Bagel</label>
                     <br>
                     <input type="checkbox" class="breadWorld" name="flvBread" id="flvBread" value="flvBread">
                     <label for="flvBread">Flavoured Bread</label>
                  </div>
               </div>
            </div>
         </div>
        </div>
     </div>
<script type="text/javascript">

   //Script for menu
   $('#headingOne').click(function(){  //cake\
      if($('#cakeOpts').hasClass("show"))
      {
         $('#cakeOpts').removeClass("show");
      }
      else
      {
         $('#cakeOpts').addClass("show");
         $('#cupcakeOpts').removeClass("show");
         $('#cookieOpts').removeClass("show");
         $('#breadOpts').removeClass("show");
      }
   });

   $('#headingTwo').click(function(){  //cookie
      if($('#cookieOpts').hasClass("show"))
      {
         $('#cookieOpts').removeClass("show");
      }
      else
      {
         $('#cookieOpts').addClass("show");
         $('#cupcakeOpts').removeClass("show");
         $('#cakeOpts').removeClass("show");
         $('#breadOpts').removeClass("show");
      }
   });

   $('#headingThree').click(function(){  //cupcake
      if($('#cupcakeOpts').hasClass("show"))
      {
         $('#cupcakeOpts').removeClass("show");
      }
      else
      {
         $('#cupcakeOpts').addClass("show");
         $('#cookieOpts').removeClass("show");
         $('#cakeOpts').removeClass("show");
         $('#breadOpts').removeClass("show");
      }
   });

   $('#headingFour').click(function(){  //bread
      if($('#breadOpts').hasClass("show"))
      {
         $('#breadOpts').removeClass("show");
      }
      else
      {
         $('#breadOpts').addClass("show");
         $('#cookieOpts').removeClass("show");
         $('#cakeOpts').removeClass("show");
         $('#cupcakeOpts').removeClass("show");
      }
   });
</script>
<!--End of Menu code-->
     <div id="page">
        <form method="get" id="hiddenForm">
           <input type="hidden" name="qa" id="query" value="$_SESSION['qry']">
        </form>
        <form method="post" id="menuForm">
           <div style="float:right;">
             <table cellpadding="5px">
                <tr>
                   <td>
                      <input type="text" id="find" value="  ">
                      <input type="button" id="findBtn" class="btn-primary btn-md" value="&emsp;Search&emsp;">
                   </td>
                   <td>
                      <input type="checkbox" name="check" id="fil" style="display:none;">
                     <label for="fil"><a id="filter" style="font-size:35px;font-weight:bold;transition:0.3s;">&#x21C5</a><a id="close" style="font-size:0px;font-weight:bold;transition:0.3s;">&#x2715</a></label>
                   </td>
                </tr>
             </table>
           </div>
           <nav class="nav nav-tabs">
               <li class="nav-item">
                  <a class="myNav nav-link" href="index.php">Home</a>
               </li>
               <li class="nav-item" id="login">
                  <a class="myNav nav-link" href="login.php">Login</a>
               </li>
         <!--      <li class="nav-item">
                  <a class="myNav nav-link" href="#">Build</a>
               </li>-->
               <li class="nav-item">
                  <a class="myNav nav-link" href="wishlist.php">Wishlist <sup><span class="badge badge-secondary" id="wishes"></span></sup></a>
               </li>
               <li class="nav-item">
                  <a class="myNav nav-link" href="cart.php">Cart <sup><span class="badge badge-secondary" id="buy"></span></sup></a>
               </li>
               <li class="nav-item">
                  <a class="myNav nav-link" href="orders.php">Order</a>
               </li>
               <li class="nav-item" id="logout">
                  <input class="myNav nav-link" type="button" name="logout" value="Logout" id="buttonLogout">
               </li>
            </nav>
            <script type="text/javascript">
            $('#buttonLogout').click(function(){
               $.ajax({
                 type:'post',
                 url:'phpProcess/logout.php',
                 success:function(){
                    window.location.reload();
                 }
              });
            });
            </script>
           </br>
            <div class="output">
               <?php
               error_reporting(E_ALL);
               $db="BuildItUp";
               $host="localhost";
               $user="root";
               $pswd="";
               $db2="BuildItUp_Customer";
               $con=new mysqli($host,$user,$pswd,$db2) or die("Error in connection");

               $connect=new mysqli($host,$user,$pswd,$db) or die("Error in connection");
               $qry="SELECT * FROM products WHERE prod_category='bread'";
               if(isset($_SESSION['qry']))
               {
                  $qry=$_SESSION['qry'];
               }

               //$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
            /*   $url=basename($_SERVER['REQUEST_URI']);
               //echo $url;
               if(strpos($url,'qa')!==false)
               {
                  $qry=$_GET['qa'];
               }  */
               $result=mysqli_query($connect,$qry) or die("errorr");

               echo "<div class='container-fluid' style='width:100%;'>
               <div class='row no-gutters'>";
               while($row=mysqli_fetch_array($result))
               {
                  ?>
                  <div class='products col-6 col-md-4 col-lg-4 img-thumbnail' id="prod_box">
                     <a class="items" id="<?php echo $row['prod_id']?>" onclick="return false" ondblclick="location=this.href" href="product.php">
                     <center>
                        <div>
                           <img id='displaySize' src='data:image;base64,<?php echo $row["prod_pic"]?>' class='rounded'>
                        <!--      <div class='caption'>
                                 <p><#?php echo $row["prod_name"]?></p>
                              </div>   -->
                           </br></br>
                           <div class="container" style="align:center;font-size:22px;">
                              <div class="row">
                                 <div class="col col-sm-4"><b>Name:</b></div>
                                 <div class="col col-sm-*" name="P_name"><?php echo $row["prod_name"]?></div>
                              </div>
                              <div class="row">
                                 <div class="col col-sm-4"><b>Price:</b></div>
                                 <div class="col col-sm-*" name="P_amt">&#x20B9 <?php echo $row["prod_amt"]?></div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col col-sm-6">
                                    <?php
                                       if(isset($cid))
                                       {
                                          $a="SELECT * FROM wish WHERE CustomerID='$cid' AND ProductID='$row[prod_id]'";
                                          $b=mysqli_query($con,$a) or die("Aer");
                                          if(mysqli_num_rows($b)>0)
                                          {
                                             ?>
                                              <button type="button" id="<?php echo $row['prod_id']?>" class="remwish btn btn-lg" name="Wishlist" style="width:100%"><b>&#10003</b> Wishlist</button>
                                             <?php
                                          }
                                          else
                                          {
                                             ?>
                                             <button type="button" id="<?php echo $row['prod_id']?>" class="addto wish btn btn-primary btn-lg" name="Wishlist" style="width:100%"><b>&#43</b> Wishlist</button>
                                             <?php
                                          }
                                       }
                                       else
                                       {
                                    ?>
                                    <button type="button" id="<?php echo $row['prod_id']?>" class="addto wish btn btn-primary btn-lg" name="Wishlist" style="width:100%"><b>&#43</b> Wishlist</button>
                                    <?php
                                       }
                                    ?>
                                 </div>
                                 <div class="col col-sm-6">
                                    <?php
                                       if(isset($cid))
                                       {
                                          $a="SELECT * FROM cart WHERE CustomerID='$cid' AND ProductID='$row[prod_id]'";
                                          $b=mysqli_query($con,$a) or die("Aer");
                                          if(mysqli_num_rows($b)>0)
                                          {
                                             ?>
                                             <button type="button" id="<?php echo $row['prod_id']?>" class="remcart btn btn-lg" name="Cart" style="width:100%"><b>&#10003</b> Cart</button>
                                             <?php
                                          }
                                          else
                                          {
                                             ?>
                                          <button type="button" id="<?php echo $row['prod_id']?>" class="addto cart btn btn-primary btn-lg" name="Cart" style="width:100%"><b>&#43</b> Cart</button>
                                          <?php
                                       }
                                    }
                                    else
                                    {
                                       ?>
                                       <button type="button" id="<?php echo $row['prod_id']?>" class="addto cart btn btn-primary btn-lg" name="Cart" style="width:100%"><b>&#43</b> Cart</button>
                                       <?php
                                    }
                                 ?>
                                 </div>
                              </div>
                              <hr>
                           </div>
                        </div>
                     </center>
                  </a>
                  </div>
                     <?php
                  }
                  echo "</div>";
                  echo "</div>";
                  mysqli_close($connect);
                     ?>

            </div>
            </br>
               </form>
            </div>
         </body>
</html>
<script type="text/javascript">
//AddToWishlist
   $('.wish').click(function(){
      var id=$(this).attr("id");
      $.ajax({
         url:"phpProcess/wishProcess.php",
         type:"POST",
         data:{'id':id},
         success:function(data){
            if(data!="success")
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
//AddToCart
   $('.cart').click(function(){
      var id=$(this).attr("id");
      $.ajax({
         url:"phpProcess/cartProcess.php",
         type:"POST",
         data:{'id':id},
         success:function(data){
            if(data!="success")
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
   //RemoveFromWishlist
      $('.remwish').click(function(){
         var id=$(this).attr("id");
         $.ajax({
            url:"phpProcess/removeWish.php",
            type:"POST",
            data:{'id':id},
            success:function(data){
               if(data!="success")
               {
                  alert(data);
               }
               window.location.reload();
            }
         });
      });
   //RemoveFromCart
      $('.remcart').click(function(){
         var id=$(this).attr("id");
         $.ajax({
            url:"phpProcess/removeCart.php",
            type:"POST",
            data:{'id':id},
            success:function(data){
               if(data!="success")
               {
                  alert(data);
               }
               window.location.reload();
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

   //To create session proID storing product id that can be used in product.php page
   $(".items").click(function(){
      var prod=$(this).attr("id");
      $.ajax({
         url:"phpProcess/setProductCookie.php",
         type:"post",
         data:{"prod":prod},
         success:function(data){
            //alert(data);
         }
      });
   });
   $('#fil').click(function(){
      if($('#fil').is(":checked"))
      {
         $("#filterMenu").css("width","25vw");
         $("#page").css("margin-right","25vw");
         $('#filter').css("font-size","0px");
         $('#close').css("font-size","35px");
      }
      else
      {
         $("#filterMenu").css("width","0vw");
         $("#page").css("margin-right","0vw");
         $('#filter').css("font-size","35px");
         $('#close').css("font-size","0px");
      }
   });
//filtering
        $('.cakeWorld').change(function(){
        if($('.cakeWorld').is(':checked'))
        {
           $('#allCake').attr('checked',false);
        }
        if($(this).is(':checked'))
        {
           //alert($('label[for='+this.id+']').html());
        }
     });
     $(document).ready(function(){
        if (window.performance) {
           //alert("on every window load");
         }
           if (performance.navigation.type == 1) {
             //alert( "on page reload" );
             callThis();
           }
           else {
             <?php $_SESSION['qry']="SELECT * FROM products WHERE prod_category='bread'";?>
             //alert( "when u visit the page first");
             window.location.reload();
             $('input:checkbox').prop('checked',false);
             $('#allBread').prop('checked',true);
             var page="bread";
             $.ajax({
                type:'post',
                url:'phpProcess/firstPageLoad.php',
                data:{'cat':page},
                success:function(data){
                   //alert(data);
                }
             });
             callThis();
          }
          function callThis()
          {


        //all checkboxes except the filter icon
        $('input:checkbox:not("#fil")').click(function(){
           if($(this).is(':checked'))
           {
             var labName=$('label[for='+this.id+']').html();
             var labId=$(this).attr("id");
             var labClass=$(this).attr("class");
             $.ajax({
                 url:"phpProcess/filter.php",
                 type:"POST",
                 data:{'label':labName,'ID':labId,'class':labClass},
                 success:function(data){
                  /*  $('#query').val(data);
                    $('#hiddenForm').submit(); */
                    window.location.reload();
                    //alert(data);
                 }
             });
           }
           else
           {
             var labName=$('label[for='+this.id+']').html();
             var labId=$(this).attr("id");
             var labClass=$(this).attr("class");
             var page="bread";
             //remove unselected checkboxes
             $.ajax({
                url:"phpProcess/removeFilter.php",
                type:"POST",
                data:{'label':labName,'ID':labId,'page':page},
                success:function(data){
               /*    $('#query').val(data);
                   $('#hiddenForm').submit();   */
                   window.location.reload();
                   //alert(data);
                }
             });
          }
        });
     }
     });

      $('#menuForm').ready(function(){
         var page="bread";

         $.ajax({
            url:"phpProcess/checked.php",
            type:"POST",
            data:{'page':page},
            success:function(data){
               //alert(data);      //u stopped here
               var result=data.split(" ");
               $.each(result,function(i)
               {
                  if(result[i]!='')
                  {
                     var hash="#";
                     var final=hash.concat(result[i]);
                     $(final).attr("checked","checked");
                  }
               });
            }
         });
      });
      //search
      $('#findBtn').click(function(){
         var entered=$('#find').val();
         $.ajax({
            type:"post",
            url:"phpProcess/searchFunction.php",
            data:{"input":entered},
            success:function(data)
            {
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
