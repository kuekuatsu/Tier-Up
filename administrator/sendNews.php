<?php
$body=$_POST['body'];
$title=$_POST['sub'];
$to=$_POST['to'];

echo "Subject: ".$title;
echo "<br>";
echo "Body: ".$body;
$sub=explode(" ",$title);
$subject=implode("%20",$sub);

$ex1=explode(PHP_EOL,$body);
$imp=implode("%0D%0A",$ex1);
$ex2=explode(" ",$imp);
$msg=implode("%20",$ex2);
echo "<br><br>";
//echo "To: ".$to;
//echo "Final Msg: ".$msg;
//echo "Subject: ".$subject;
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>
         Send Email
      </title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   </head>
   <body>
      <?php
      $h="localhost";
      $u="root";
      $p="";
      $db="BuildItUp";
      $db2="BuildItUp_Customer";
      $c=new mysqli($h,$u,$p,$db) or die("err");
      $c2=new mysqli($h,$u,$p,$db2) or die("err");
      $q="SELECT Email FROM mail_list";
      $r=mysqli_query($c,$q) or die("ded");
      if($r)
      {
         $n=mysqli_num_rows($r);
         if($to==all)
         {
            while($l=mysqli_fetch_array($r))
            {
               $a=$a.$l[0];
               $n--;
               if($n>0)
               {
                  $a=$a.',';
               }
            }
            echo $a;
            ?>
            <form action="mailto:<?php echo $a.'?subject='.$subject.'&body='.$msg; ?>" method="post" enctype="text/plain">
               <input type="submit" value="Send">
            </form>
            <?php
         }
         else
         {
            $b="";
            while($l=mysqli_fetch_array($r))
            {
               $s="SELECT Email FROM users WHERE Email='$l[0]'";
               $t=mysqli_query($c2,$s) or die("det");
               if($t)
               {
                  if(mysqli_num_rows($t)==1)
                  {
                     $k=$k.$l[0].' ';
                  }
               }
            }
            $k=trim($k);
            $i=explode(" ",$k);
            $b=implode(",",$i);
            echo $b;
            ?>
            <form action="mailto:<?php echo $b.'?subject='.$subject.'&body='.$msg; ?>" method="post" enctype="text/plain">
               <input type="submit" value="Send">
            </form>
            <?php
         }
      }
      ?>
   </body>
</html>
