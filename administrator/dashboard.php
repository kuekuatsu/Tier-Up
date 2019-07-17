<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Dashboard</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
      <?php
session_start();
if(isset($_SESSION['uname']) && $_SESSION['uname']=='Admin')
{
   ?>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);
        var options = {
          title: 'My Daily Activities'
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

  var data = new google.visualization.DataTable();
  data.addColumn('number', 'X');
  data.addColumn('number', 'Dogs');

  data.addRows([
    [0, 0],   [1, 10],  [2, 23],  [3, 17],  [4, 18],  [5, 9],
    [6, 11],  [7, 27],  [8, 33],  [9, 40],  [10, 32], [11, 35],
    [12, 30], [13, 40], [14, 42], [15, 47], [16, 44], [17, 48],
    [18, 52], [19, 54], [20, 42], [21, 55], [22, 56], [23, 57],
    [24, 60], [25, 50], [26, 52], [27, 51], [28, 49], [29, 53],
    [30, 55], [31, 60], [32, 61], [33, 59], [34, 62], [35, 65],
    [36, 62], [37, 58], [38, 55], [39, 61], [40, 64], [41, 65],
    [42, 63], [43, 66], [44, 67], [45, 69], [46, 69], [47, 70],
    [48, 72], [49, 68], [50, 66], [51, 65], [52, 67], [53, 70],
    [54, 71], [55, 72], [56, 73], [57, 75], [58, 70], [59, 68],
    [60, 64], [61, 60], [62, 65], [63, 67], [64, 68], [65, 69],
    [66, 70], [67, 72], [68, 75], [69, 80]
  ]);

  var options = {
    hAxis: {
      title: 'Time'
    },
    vAxis: {
      title: 'Popularity'
    }
  };

  var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

  chart.draw(data, options);
}
    </script>
      </head>
      <body>
         <form class="" action="index.html" method="post">
            <nav class="nav nav-tabs">
              <li class="nav-item"><a class="nav-link active">Dashboard</a></li>
              <li class="nav-item"><a class="nav-link" href="upload.php">Upload New Products</a></li>
              <li class="nav-item"><a class="nav-link" href="addImages.php">Add Product Images</a></li>
              <li class="nav-item"><a class="nav-link" href="removePro.php">Remove Product</a></li>
              <input type="button" style="background-color:transparent;outline:none;border:none;color:blue;" id="logout" value="Logout">
            </nav>
            <br>
            <div class="container-fluid">
               <div class="row">
                  <div class="col-md-5">
                     <div id="piechart" style="width: 700px; height: 600px;"></div>
                  </div>
                  <div class="col-md-7">
                     <div id="chart_div" style="width: 800px; height: 600px;"></div>
                  </div>
               </div>
            </div>
         </form>
      </body>
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
      </script>
   </html>
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
