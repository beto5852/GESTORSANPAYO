<?php 

//Configurar zona horaria
date_default_timezone_set('America/Costa_Rica');

session_start();

if (!isset($_SESSION["validar"])) {
  header("location:login");
  die();
}
include "views/includes/header.php";
include "views/includes/navbar.php";
include "views/includes/siderbar.php";
include "views/includes/content-wrapper.php";

?>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">


    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php include "views/includes/footer.php" ?>


