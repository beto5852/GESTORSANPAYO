<?php

//Configurar zona horaria
date_default_timezone_set('America/Costa_Rica');

session_start();
// var_dump(explode("/",$_SERVER['REQUEST_URI']));

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
    // instanciamos la clase de login controller
    $borrarArticulo = new ArticulosControllers();
    $borrarArticulo->borrarArticulosControllers();

    ?>

  </div>
</div>
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
                <th>Nombre</th>
                <th>Email</th>
                <th>Imagen</th>
                <th>Rol</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              //Instanciamos la clase para leer los datos
              $usuarios = new UsuariosControllers();
              $resultados = $usuarios->listarUsuariososControllers();
            //   var_dump($resultados);
              foreach ($resultados as $usuario) :
              ?>
                <tr>
                  <td scope="row"> <?php echo $usuario->id; ?> </td>
                  <td> <?php echo $usuario->nombre;  ?></td>
                  <td> <?php echo $usuario->email; ?>
                  <td class="text-center"> <img src=" <?php echo RUTA_BACKEND. '/' . $usuario->imagen; ?>" class="img-fluid" width="150" height="auto"></td>
                  <td> <?php echo $usuario->permiso; ?>
                  </td>

                  <td>
                    <a class="btn btn-primary" href="<?= RUTA_BACKEND?>editarUsuario/<?php echo $usuario->id; ?>">Editar <i class="nav-icon far fa-edit"></i></a>

                    <a class="btn btn-danger" href="<?= RUTA_BACKEND?>borrarUsuario/<?php echo $usuario->id; ?>"">Borrar <i class="nav-icon far fa-trash-alt"></i> </a>
                  </td>
                </tr>

              <?php endforeach; ?>

            </tbody>

            <tfoot>
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Imagen</th>
                <th>Rol</th>
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