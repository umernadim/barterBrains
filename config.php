<?php
   $connect = mysqli_connect("localhost","root","","barter-brains");
   if (!$connect) {
    die("Connection Failed: ". mysqli_connect_error());
   }
?>