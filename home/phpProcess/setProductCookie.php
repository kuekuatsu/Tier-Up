<?php
   session_start();
   $_SESSION['proID']=$_POST['prod'];
   $pid=$_SESSION['proID'];
   echo $pid;
?>
