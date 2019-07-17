<!doctype html>
<html lang="en">
  <head>
    <title>Home</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- If you’re using our compiled JavaScript, don’t forget to include CDN versions of jQuery and Popper.js before it.
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    -->
    <!-- Bootstrap CSS & JS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css?version=4" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Indie+Flower|Allura|Berkshire+Swash|Comfortaa|Courgette|Lobster+Two|Merienda|Playball|Satisfy|Sofia|Englebert" rel="stylesheet">
    <!--_Indie+Flower|Allura|Berkshire+Swash|Comfortaa|Courgette|Lobster+Two|Merienda|Playball|Satisfy-->
  </head>
  <body>
     <div id="back_div">
          <div id="first_div">
          <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="searchBox">
             <img src="images/dis.jpg" id="main_pic">
       <!-- Optional JavaScript -->
       <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <div class="vcenter">
               <center><input type="text" name="searchbox" placeholder="Search" id="search"></center>
            </div>
            </form>
            <div id="div_filter">
               <table cellspacing="9vmin" id="icon_table">
                  <tr></tr>
                  <tr><td>
                     <div id="cakes" class="icon_div">
                        <a href=""><img src="images/cak.png" class="filter_category"></a>
                        <div><b>Cakes</b></div>
                     </div>
                  </td><td>
                     <div id="cookies" class="icon_div">
                        <a href=""><img src="images/ginger.png" class="filter_category"></a>
                        <div><b>Cookies</b></div>
                     </div>
                  </td><td>
                     <div id="bread" class="icon_div">
                        <a href=""><img src="images/brd.png" class="filter_category"></a>
                        <div><b>Bread</b></div>
                     </div>
                  </td><td>
                 <div id="cupcakes" class="icon_div">
                        <a href=""><img src="images/cup.png" class="filter_category"></a>
                          <div><b>Cupcakes</b></div>
                     </div>
                  </td>
      <!--            <td>
                     <div id="others" class="icon_div">
                        <a href=""><img src="images/others.jpg" class="filter_category"></a>
                        <div><b>Others</b></div>
                     </div>
                  </td>    -->
               </tr>
               </table>
            </div>

         </div>
   <!--      <script src="bootstrap/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>   -->

      <!--Where shopping items come from
      <div class="container" style="border:2px solid pink">
         <div class="row" style="border:2px dotted red">
            <div class="col-lg-4" style="border:2px dashed blue"></div>
         </div>
      </div>
   -->
      <?php
      error_reporting(E_ALL);
         $db="BuildItUp";
         $host="localhost";
         $user="root";
         $pswd="";

         $connect=new mysqli($host,$user,$pswd,$db) or die("Error in connection");

         $qry="SELECT * FROM products";
         $result=$connect->query($qry);

         echo "<div class='container-fluid' style='width:100%;'>";
         echo "<div class='row no-gutters justify-content-between'>";
         while($row=mysqli_fetch_array($result))
         {
            ?>
                  <div class='col-6 col-md-4 col-lg-4 img-thumbnail'>
                     <a href="#">
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
                                 <div class="col col-sm-*"><?php echo $row["prod_name"]?></div>
                              </div>
                              <div class="row">
                                 <div class="col col-sm-4"><b>Price:</b></div>
                                 <div class="col col-sm-*">Rs. <?php echo $row["prod_amt"]?></div>
                              </div>
                           </br>
                           </div>
                        </div>
                     </center>
                  </a>
                  </div>
         <?php
         #   echo "<img height='300' width='300' src='data:image;base64,".$row['prod_pic']." '>";
         }
         echo "</div>";
         echo "</div>";
         mysqli_close($connect);
      ?>
   <!--   echo "<div class='container' style='border:2px solid pink'>";
         echo "<div class='row' style='border:2px dotted red'>";
      while($row=$result->fetch_assoc())
      {
                echo "<div class='col-md-4' style='border:2px dashed blue'><img src=data:image/jpeg;base64".base64_encode($row["prod_pic"])."></div>";
      }
      echo "</div>";
      echo "</div>"; -->
                     <!--
                     #   if($qry->num_rows > 0)
                     #   {
                     #      $imgData=$qry->fetch_assoc();
                     #      echo base64_encode($imgData['prod_pic']);
                     #   }
                     #   else
                     #   {
                     #      echo "no";
                     #   }
                  -->
   </div>
   </body>
</html>
