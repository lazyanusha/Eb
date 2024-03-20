<?php
  $server="localhost";
  $user="root";
  $pass="01,Sumina@101$";
  $database="easybooking";

  $conn = mysqli_connect($server, $user, $pass, $database);

  if(!$conn){
    die("connection success");
  }
  
