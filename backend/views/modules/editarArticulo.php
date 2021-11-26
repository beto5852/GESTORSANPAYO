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
    <div class="content">      
      <div class="container-fluid">
        <div class="row">

          <!-- left column -->
          <div class="col-md-8">
          
            <div class="card card-outline card-info">

              <div class="form-group px-2">
                <label for="titulo">Título de la publicación: </label>
                <input type="text" class="form-control" name="tituloArticulo" id="tituloArticulo" placeholder="Ingresa aquí el título de la publicación">
              </div>

              <div class="form-group px-2">
                <label for="contenido">Título de la publicación: </label>
                <textarea id="editor" name="contenido">
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
                    <input type="text" class="form-control datetimepicker-input" data-target="#fecha" name="fechaCreacion" value="<?php echo  $fechaActual = date('Y-m-d '); ?>">
                    <div class="input-group-append" data-target="#fecha" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
                <!-- /.Date-->

                <div class="form-group px-2">
                  <label>Categorias</label>
                  <select class="form-control select2" style="width: 100%;">
                    <?php
                    $categoria = new CategoriasControllers();
                    $categoria->listarCatergoriasControllers();

                    // var_dump($categoria);

                    ?>
                  </select>
                </div>
            </div>  
          </div>
          <!--/.col (right) -->

   
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php include "views/includes/footer.php"; ?>

