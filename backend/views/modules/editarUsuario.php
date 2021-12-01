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
          $editarUsuario = new UsuariosControllers();
          $respuesta = $editarUsuario->editarUsuariosControllers();
          // var_dump($respuesta);
          $actualizar = new ArticulosControllers();
          $actualizar->actualizarArticulosControllers();

          // var_dump($respActualizar);

          if (isset($_GET) && $_GET != "") {
            //obtenemos el enlace si es un mensaje positivo
            $ok = explode("/", $_GET["enlace"]);
            if (isset($ok[2]) && $ok[2] == "ok") {
              echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
              <strong>Actualizado</strong> 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
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

          <input type="hidden" name="idUsuario" value="<?php echo isset($respuesta->id) ? $respuesta->id : ""; ?>">

          <div class="form-group px-2">
            <label for="nickname">Nickname: </label>
            <input type="text" value="<?php echo isset($respuesta->nickname) ? $respuesta->nickname : "";  ?>" class="form-control" name="actualizarNickUser" id="actualizarNickUser" required>
          </div>
          <div class="form-group px-2">
            <label for="nombre">Nombre y apellidos: </label>
            <input type="text" value="<?php echo isset($respuesta->nombre) ? $respuesta->nombre : "";  ?>" class="form-control" name="actualizarNombreUser" id="actualizarNombreUser" required>
          </div>

          <div class="form-group px-2">
            <label for="email">Correo Electronico: </label>
            <input type="email" value="<?php echo isset($respuesta->email) ? $respuesta->email : "";  ?>" class="form-control" name="actualizarEmailUser" id="actualizarEmailUser" required>
          </div>
          <div class="form-group px-2">
            <label for="email">Contraseña: </label>
            <input type="password" value="<?php echo isset($respuesta->password) ? $respuesta->password : "";  ?>" class="form-control" name="actualizarPassUser" id="actualizarPassUser" required>
          </div>

          <div class="form-group px-2">
            <label for="email">Rol de usuario: </label>
            <select class="form-control" name="" id="">
                <?php 
                      $mostrarRol = new UsuariosControllers();
                      $respuestaRol = $mostrarRol->listarRoles();

                      // var_dump($respuestaRol);

                      foreach($respuestaRol as $rol) :
                 ?>
                <option value="<?php echo $rol->id; ?>"><?php echo $rol->permiso; ?></option>
                <?php endforeach; ?>
              </select>
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
             
            </div>
          </div>
          <!-- /.Date-->

          <div class="form-group px-2 text-center">
            
            <img src="<?php echo RUTA_BACKEND . '/' . $respuesta->imagen; ?>" alt="" width="auto" height="200"><br>
            
              <label  for="imagenUsuario" class="form-label">Imagen</label>
              <input type="file" class="form-control-file" name="imagenUsuario" id="imagenUsuario" placeholder="Seleccione una imagen">
          </div>

          <div class="form-group px-2 text-center">
            <button type="submit" name="actualizarUsuario" id="actualizarUsuario" class="btn btn-primary w-100"><i class="fas fa-cog"></i> Actualizar</button>

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