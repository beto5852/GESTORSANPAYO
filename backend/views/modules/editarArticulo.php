<?php

//Configurar zona horaria
date_default_timezone_set('America/Costa_Rica');

session_start();

if (!isset($_SESSION["validar"])) {
  header("location:" . RUTA_BACKEND . "login");
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
    $actualizar->actualizarArticulosControllers();



    if (isset($_GET) && $_GET != "") {
      //obtenemos el enlace si es un mensaje positivo
      $enlace = explode("/", $_GET["enlace"]);
      // var_dump($ok);
      if (isset($enlace[2]) && $enlace[2] == "ok") {
        echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
              <strong>Articulo </strong> actualizado
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>';
      } elseif (isset($enlace[2]) && $enlace[2] == "error") {
        echo '  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Error</strong> No de pudo actualizar, algunos campos estan vacios
                  </div>';
      }
    }
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

            <input type="hidden" name="idArticulo" value="<?php echo isset($respuesta->idArticulo) ? $respuesta->idArticulo : ""; ?>">

            <div class="form-group px-2">
              <label for="titulo">T??tulo de la publicaci??n: </label>
              <input type="text" value="<?php echo isset($respuesta->titulo) ? $respuesta->titulo : "";  ?>" class="form-control" name="actualizarTituloArticulo" id="tituloArticulo" required>
            </div>

            <div class="form-group px-2">
              <label for="contenido">Contenido de la publicaci??n: </label>
              <textarea id="editor" name="actualizarcontenido" required>
              <?php echo isset($respuesta->contenido) ? $respuesta->contenido : ""; ?>
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
              <label>Fecha de publicaci??n:</label>
              <div class="input-group date" id="fecha" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" data-target="#fecha" name="actualizarfechaCreacion" value="<?php echo isset($respuesta->publicado) ? $respuesta->publicado : ""; ?>">

                <div class="input-group-append" data-target="#fecha" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
            <!-- /.Date-->

            <div class="form-group px-2">
              <label for="categoria">Categorias: </label>
              <select class="form-control" name="actualizarCategoria" required>
                <?php
                $mostrarCategorias = new ArticulosControllers();
                $respuestaCategoria = $mostrarCategorias->listarCategorias();

                // var_dump($respuestaRol);

                foreach ($respuestaCategoria as $categoria) :

                  if ($respuesta->idCategoria == $categoria->id) {
                ?>

                    <option value="<?=$respuesta->idCategoria?>" selected><?php echo $respuesta->categoria; ?></option>
                  <?php } else { ?>
                    <option value="<?= $categoria->id?>"><?php echo $categoria->categoria; ?></option>
                <?php }
                endforeach; ?>
              </select>
            </div>
            <!-- agregar la categoria -->

            <div class="form-group px-2 text-center">

              <img src="<?php echo RUTA_FRONTEND . '/' . $respuesta->imagen; ?>" alt="" width="auto" height="200"><br>

              <label for="imagenArticulo" class="form-label">Imagen</label>
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