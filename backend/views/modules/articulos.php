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

      <div class="col-12">

        <div class="card-header">
          <div class="row">
            <div class="col-md-9 mb-4 d-md-flex d-lg-flex justify-content-md-center justify-content-lg-start">
              <h3 class="card-title">Lista de todos los articulos posteados</h3>
            </div>
            <div class="col-md-3">
              <button type="button" class="btn btn-primary btn-xl pull-right w-100" data-toggle="modal" data-target="#modal-ingresar-horas">
                <i class="fa fa-plus"></i> Nuevo Articulo
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

<!--MODALS INSERTAR HORAS-->
<div class="modal fade bd-example-modal-xl" id="modal-ingresar-horas">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"><strong>Nuevo Articulo</strong></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

        <div id="errores" style="color: red;"></div>



        <form role="form" method="POST">

          <div class="row">

            <div class="col-8">
              <div class="form-group">
                <label for="nombre">Tiulo: </label>
                <input type="text" class="form-control" name="nombreArticulo" id="nombreArticulo">
              </div>
            </div>

            <div class="col-4">
                  <!-- Date -->
          <div class="form-group">
            <label>Fecha de publicación:</label>
            <div class="input-group date" id="fecha" data-target-input="nearest">
              <input type="text" class="form-control datetimepicker-input" data-target="#fecha" name="fecha" value="<?php echo  $fechaActual = date('Y-m-d '); ?>">
              <div class="input-group-append" data-target="#fecha" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          </div>
          <!-- /.Date-->

            </div>

            <div class="col-md-12">
              <div class="card card-outline card-info">
                <div class="card-header">
                  <h3 class="card-title">
                    Contenido del Articulo
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <textarea id="editor">
                Ingrese <em>algun</em> <u>texto</u> <strong>aqui</strong>
              </textarea>
                </div>
                <div class="card-footer">
                  
                </div>
              </div>
            </div>
            <!-- /.col-->

          </div>

      

          <div class="clearfix"></div>



      </div>


      <div class="box-footer">
        <div class="modal-footer">
          <button type="button" class="btn btn-success pull-left" data-dismiss="modal"><i class="far fa-window-close"></i> Cerrar</button>

          <button type="submit" name="registrarHoras" id="registrarHoras" class="btn btn-primary"><i class="fas fa-cog"></i> Registrar</button>
        </div>
        </form>
        <!-- /.input group -->

      </div>

    </div>

  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<?php include "views/includes/footer.php" ?>