<?php
   $total=$_POST['total'];
   $discount=$_POST['discount'];
   $shipping=$_POST['shipping'];

   $grandTotal=$total+$shipping-$discount;
   echo $grandTotal;
?>
