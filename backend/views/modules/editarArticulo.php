<?php

//Configurar zona horaria
date_default_timezone_set('America/Costa_Rica');

session_start();

if (!isset($_SESSION["validar"])) {
  header("location:".RUTA_BACKEND."login");
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
          $editarArticulo = new ArticulosControllers();
          $respuesta = $editarArticulo->editarArticulosControllers();

          $actualizar = new ArticulosControllers();
          // $actualizar->act
          ?>
        </div>
      </div>


<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">      

      <!-- left column -->
      <div class="col-md-8">

        <div class="card card-outline card-info">

          <div class="form-group px-2">
            <label for="titulo">Título de la publicación: </label>
            <input type="text" value="<?php if(isset( $respuesta->titulo_articulo)) { echo $respuesta->titulo_articulo;} else { echo "";}?>" class="form-control" name="tituloArticulo" id="tituloArticulo">
          </div>

          <div class="form-group px-2">
            <label for="contenido">Contenido de la publicación: </label>
            <textarea id="editor" name="contenido"><?php if(isset( $respuesta->titulo_articulo)) { echo $respuesta->contenido_articulo;} else { echo "";}?>
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
              <input type="text" class="form-control datetimepicker-input" data-target="#fecha" name="fechaCreacion" value="<?php echo $respuesta->date_create_articulo; ?>">
              <div class="input-group-append" data-target="#fecha" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          </div>
          <!-- /.Date-->

          <div class="form-group px-2 text-center">
            <img src="<?php echo RUTA_FRONTEND . '/' . $respuesta->imagen_articulo; ?>" alt="" width="auto" height="200">
          </div>

          <div class="form-group px-2 text-center">
            <button type="submit" name="registrarArticulo" id="actualizarArticulo" class="btn btn-primary w-100"><i class="fas fa-cog"></i> Actualizar</button>

          </div>
        </div>
        <!--/.col (right) -->
      </div>


    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include "views/includes/footer.php"; ?>