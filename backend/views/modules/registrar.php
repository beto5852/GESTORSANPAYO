<?php 


session_start();
if(isset($_SESSION["validar"]))
{
  header("location:dashboard");  
  exit();
}


?>

<body class="hold-transition register-page">

<div class="row">
    <div class="col-sm-12">

    <?php 


     // instanciamos la clase de login controller
      $registro = new UsuariosControllers();
      $registro->registrarController();

    ?>

    </div>
  </div>
  
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="login" class="h1"><b>SANPAYO</b>TOUR</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Registro de nuevo miembro</p>

      <form  method="POST">
      <div class="input-group mb-3">
          <input type="text" class="form-control" name="registrarNickname" placeholder="Ingrese un Alias">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="registrarNombre" placeholder="Nombre completo">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="registrarEmail" placeholder="Ingrese su Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="registrarPassword" class="form-control" placeholder="Ingrese su Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
       <!--  <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div> -->
        <div class="row">
        <!--   <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" name="registrar">Registrarme</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    <!--   <div class="social-auth-links text-center">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div> -->

      <!-- <a href="login.html" class="text-center">I already have a membership</a> -->
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="<?=RUTA_BACKEND?>views/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=RUTA_BACKEND?>views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=RUTA_BACKEND?>views/dist/js/adminlte.min.js"></script>
</body>


