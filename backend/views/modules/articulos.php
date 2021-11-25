<?php

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

      <div class="col-12">

        <div class="card-header">
          <div class="row">
            <div class="col-md-9 mb-4 d-md-flex d-lg-flex justify-content-md-center justify-content-lg-start" >
              <h3 class="card-title">Lista de todos los articulos posteados</h3>
            </div>
            <div class="col-md-3">
              <button type="button" class="btn btn-primary btn-xl pull-right w-100" data-toggle="modal" data-target="#modal-ingresar-horas">
                <i class="fa fa-plus"></i> Ingresar nuevo registro
              </button>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="listaArticulos" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Id</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
             
              <?php                 
                   $articulos = new ArticulosControllers;
                   $articulos->leerArticulosControllers();            
                
                ?>
                        
            </tbody>

            <tfoot>
              <tr>
                <th>Id</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </tfoot>

          </table>
        </div>
        <!-- /.card-body -->

      </div>





    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->


<?php include "views/includes/footer.php" ?>