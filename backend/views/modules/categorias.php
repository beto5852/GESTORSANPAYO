<?php 

session_start();

if (!isset($_SESSION["validar"])) {
    header("location:index.php?enlace=login");
    die();
  }
  


?>