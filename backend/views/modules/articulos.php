<?php

//Configurar zona horaria
date_default_timezone_set('America/Costa_Rica');

session_start();
// var_dump(explode("/",$_SERVER['REQUEST_URI']));

if (!isset($_SESSION["validar"])) {
  header("location:".RUTA_BACKEND."login");
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
              <a href="<?= RUTA_BACKEND ?>crearArticulo" class="btn btn-primary btn-xl pull-right w-100">
                <i class="fa fa-plus"></i> Nuevo Articulo
              </a>
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
                  <a class="btn btn-primary" href="<?= RUTA_BACKEND; ?>editarArticulo/<?php echo $articulo->id_articulo; ?>">Editar <i class="nav-icon far fa-edit"></i></a>

                  <a class="btn btn-danger" href="<?= RUTA_BACKEND; ?>borrarArticulo/<?php echo $articulo->id_articulo; ?>">Borrar <i class="nav-icon far fa-trash-alt"></i> </a>
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




<?php include "views/includes/footer.php"; ?>