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

          // var_dump($respuesta);
          $actualizar->actualizarArticulosControllers();
          // $actualizar->act
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

          <input type="hidden" name="idArticulo" value="<?php echo isset($respuesta->id_articulo) ? $respuesta->id_articulo : ""; ?>">

          <div class="form-group px-2">
            <label for="titulo">Título de la publicación: </label>
            <input type="text" value="<?php echo isset($respuesta->titulo_articulo) ? $respuesta->titulo_articulo : "";  ?>" class="form-control" name="actualizarTituloArticulo" id="tituloArticulo" required>
          </div>

          <div class="form-group px-2">
            <label for="contenido">Contenido de la publicación: </label>
            <textarea id="editor" name="actualizarcontenido" required>
              <?php echo isset($respuesta->contenido_articulo) ? $respuesta->contenido_articulo : "";?>
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
              <input type="datetime" class="form-control datetimepicker-input" data-target="#fecha" name="actualizarfechaCreacion" value="<?php echo isset($respuesta->date_create_articulo) ? $respuesta->date_create_articulo : "";?>">
              
              <div class="input-group-append" data-target="#fecha" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          </div>
          <!-- /.Date-->

          <div class="form-group px-2 text-center">
            
            <img src="<?php echo RUTA_FRONTEND . '/' . $respuesta->imagen_articulo; ?>" alt="" width="auto" height="200"><br>
            
              <label  for="imagenArticulo" class="form-label">Imagen</label>
              <input type="file" class="form-control-file" name="imagenArticulo" id="imagenArticulo" placeholder="Seleccione una imagen">
          </div>

          <div class="form-group px-2 text-center">
            <button type="submit" name="actualizarArticulo" id="actualizarArticulo" class="btn btn-primary w-100"><i class="fas fa-cog"></i> Actualizar</button>

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