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

<div class="row">
    <div class="col-sm-12 px-4">

    <?php 
      // instanciamos la clase de login controller
      $crearArticulo = new ArticulosControllers();
      $crearArticulo->crearArticulosControllers();

     ?>

    </div>
  </div>


<!-- Main content -->
<div class="content">
  <div class="container-fluid">

  <form method="POST" enctype="multipart/form-data">

    <div class="row">      

      <!-- left column -->
      <div class="col-md-8">

        <div class="card card-outline card-info">

          <div class="form-group px-2">
            <label for="tituloArticulo">Título de la publicación: </label>
            <input type="text" class="form-control" name="tituloArticulo" id="tituloArticulo" placeholder="Ingresa aquí el título de la publicación">
          </div>

          <div class="form-group px-2">
            <label for="contenidoArticulo">Título de la publicación: </label>
            <textarea id="editor" name="contenidoArticulo">
              Ingrese <em>algun</em> <u>texto</u> <strong>aqui</strong>
                </textarea>
          </div>

        </div>

      </div>
      <!--/.col (left) -->

      <!-- right column -->
      <div class="col-md-4">
        <div class="card card-outline card-info">
          <!-- Date -->
          <div class="form-group px-2">
            <label>Fecha de publicación:</label>
            <div class="input-group date" id="fecha" data-target-input="nearest">
              <input type="text" class="form-control datetimepicker-input" data-target="#fecha" name="fechaArticulo" value="<?php echo  $fechaActual = date('Y-m-d '); ?>">
              <div class="input-group-append" data-target="#fecha" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          </div>
          <!-- /.Date-->

          <div class="form-group px-2">
              <label  for="imagenArticulo" class="form-label">Imagen</label>
              <input type="file" class="form-control-file" name="imagenArticulo" id="imagenArticulo" placeholder="Seleccione una imagen">
          </div>

          <div class="form-group px-2 text-center">
              <button type="submit" name="crearArticulo"  class="btn btn-primary w-100"><i class="fas fa-cog"></i> Registrar</button>
          </div>

        </div>
        <!--/.col (right) -->
      </div>

    </div>
    <!-- /.row -->
    </form>
  
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->




<?php include "views/includes/footer.php"; ?>

