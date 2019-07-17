<?php
   $d=$_POST['disc'];
   $sub=$_POST['sub'];
   $add=$_POST['add'];
   $minus=$_POST['minus'];

   if($d!=null)
   {
      $sum=$sub+$add-$minus;
      $ans=$sum*$d/100;
      $final=$sub+$add-$ans;
      echo $ans.'/'.$final;
   }
   else
   {
      $minus='0';
      $sum=$sub+$add-$minus;
      echo $minus.'/'.$sum;
   }
?>
