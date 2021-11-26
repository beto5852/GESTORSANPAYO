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
                <th>Contenido</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                    //Instanciamos la clase para leer los datos
                    $articulos = new ArticulosControllers();
                    $resultados = $articulos->leerArticulosControllers();
              
                    foreach($resultados as $articulo) : 
              ?>
              <tr>
                <td scope="row"> <?php echo $articulo->id_articulo; ?> </td>
                <td> <?php echo $articulo->titulo_articulo;  ?></td>
                <td class="text-center"> <img src=" <?php echo RUTA_FRONTEND.'/'. $articulo->imagen_articulo; ?>" class="img-fluid" width="150" height="auto"></td>
                <td> <?php echo $articulo->contenido_articulo; ?>
                </td>

                <td>
                  <a class="btn btn-primary" href="index.php?enlace=editarArticulo&idEditar=<?php echo $articulo->id_articulo; ?>">Editar <i class="nav-icon far fa-edit"></i></a>
                  <a class="btn btn-danger" href="index.php?enlace=articulos&idBorrar=<?php echo $articulo->id_articulo; ?>">Borrar <i class="nav-icon far fa-trash-alt"></i> </a>
                </td>
              </tr>
              
              <?php  endforeach; ?>

            </tbody>

            <tfoot>
              <tr>
                <th>Id</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Contenido</th>
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

       ` <form method="POST">
          <div class="row">
            <div class="col-12 col-lg-8">
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
            <div class="col-12 col-lg-4">
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
          </div>


          <div class="box-footer">
            <div class="modal-footer">
              <button type="button" class="btn btn-success pull-left" data-dismiss="modal"><i class="far fa-window-close"></i> Cerrar</button>

              <button type="submit" name="registrarArticulo" id="registrarArticulo" class="btn btn-primary"><i class="fas fa-cog"></i> Registrar</button>
            </div>
            <!-- /.input group -->

          </div>
        </form>`
        <div class="clearfix"></div>
      </div>

    </div>

  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<?php include "views/includes/footer.php"; ?>