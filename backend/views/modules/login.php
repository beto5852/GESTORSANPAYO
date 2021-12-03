<?php 


session_start();
if(isset($_SESSION["validar"]))
{
  header("location:dashboard");  
  exit();
}


?>


<body class="hold-transition login-page">

  <div class="row">
    <div class="col-sm-12">

    <?php 
      // instanciamos la clase de login controller
      $login = new UsuariosControllers();
      $login->loginController();
      
      if (isset($_GET['enlace']))
      {
        $mensaje = explode("/",$_GET['enlace']);
        
        if ( isset($mensaje[1]) && $mensaje[1] == "exitoso") {
          echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong>Usuario Registrado</strong> 
        </div>';
        }
      }

    ?>

    </div>
  </div>



  <div class="login-box">
  <div class="login-logo">
    <img src="<?= RUTA_BACKEND?>views/dist/img/login.png" class="img-fluid" width="200">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Ingrese sus datos para iniciar sesión</p>

      <form method="POST" class="needs-validation" novalidate>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="usuarioIngreso" id="usuarioIngreso" placeholder="Ingresa el usuario" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <div class="valid-feedback"></div>
          <div class="invalid-feedback" for="User"><span></span></div>
        </div>
        <div class="input-group mb-4">
          <input type="password" class="form-control" type="password" name="passwordIngreso" id="passwordIngreso" placeholder="Ingresa el password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <div class="valid-feedback"></div>
          <div class="invalid-feedback" for="Pass"><span></span></div>
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-sm-12">

            <button type="submit" class="btn btn-primary d-block w-100" name="login" id="login"><i class="fas fa-user"></i> Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>  
      <div class="social-auth-links text-center">
        <a href="<?= RUTA_BACKEND?>registrar" class="btn btn-block btn-success">
          <i class="fas fa-share-square mr-2"></i>
          Registrate
        </a>
      </div>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<script src="<?=RUTA_BACKEND?>views/js/validarIngreso.js"></script>


