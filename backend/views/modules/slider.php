<?php 

session_start();

if (!isset($_SESSION["validar"])) {
    header("location:login");
    die();
  }
  

?>