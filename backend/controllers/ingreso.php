<?php

/**
 * CLASE DE TIPO CONTOLADOR PARA ACCEDER A LA APLICACION
 */
class LoginControllers
{

  public function loginController()
  {
    //validamos que se envio algo
    if (isset($_POST["usuarioIngreso"])) {


      // validacion al lado del servidor
      if (
        preg_match('/^[a-zA-Z0-9]+$/', $_POST['usuarioIngreso']) &&
        preg_match('/^[a-zA-Z0-9]+$/', $_POST['passwordIngreso'])
      ) {

        // $blowfish_salt = '$2a$07$usesomesillystringforsalt$';
                 
        // $encriptar = crypt($_POST["passwordIngreso"], $blowfish_salt); 
            
        // $datosController = array("usuario" => $_POST["usuarioIngreso"],"password" => $encriptar);

        //asignamos los datos a una variable de tipo arreglo
        $datosController = array(
          "usuario" => $_POST["usuarioIngreso"],
          "password" =>  $_POST["passwordIngreso"]
        );

        $respuesta = LoginModels::loginModel($datosController, "usuario");

        // var_dump($respuesta);
        //validamos que la consulta exitosa
        if ($respuesta == TRUE) 
        {

          // obtenemos los intentos
          $intentos = $respuesta["intentos"];
          $intentosMaximos = 2;
          // obtenemos el usuario actual para reiniciar los intentos
          $usuarioActual =  $_POST["usuarioIngreso"];

          // repuesta que recibe desde el loginmodel
          if ($intentos < $intentosMaximos) {

            //validar que los datos enviados existen en la base de datos
            if ($respuesta["user_name"] == $_POST["usuarioIngreso"] && $respuesta["password_usuario"] == $_POST["passwordIngreso"]) {
              // inicializamos la variable intentos
              $intentos = 0;
              //creamos variables de sessión
              $_SESSION["validar"] = true;
              $_SESSION["usuarioId"] = $respuesta["id_usuario"];
              $_SESSION["usuarioNombre"] = $respuesta["nombre_usuario"];
              $_SESSION["usuarioImagen"] = $respuesta["imagen_usuario"];


              // guardamos el usuario actual en un array
              $datosController = array("usuarioActual" => $usuarioActual, "actualizarIntentos" => $intentos);

              // actualizamos los intentos
              $respuesta = LoginModels::loginIntentos($datosController, "usuario");

              // redirigimos la página al dashboard
              header("location:dashboard");
              
            } else {
              //preincrementamos la variable de intentos
              ++$intentos;
              static $contador = 3;
              // guardamos el usuario actual en un array
              $datosController = array("usuarioActual" => $usuarioActual, "actualizarIntentos" => $intentos);

              // actualizamos los intentos
              $respuesta = LoginModels::loginIntentos($datosController, "usuario");

              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong>Password incorrecto te quedan: </strong>' . $contador - $intentos . ' Intentos
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>';
            }
          } else //si intentos es > a maximo intentos
          {
            $intentos = 0;

            $datosController = array("usuarioActual" => $usuarioActual, "actualizarIntentos" => $intentos);

            // actualizamos los intentos
            $respuesta = LoginModels::loginIntentos($datosController, "usuario");

            // mensaje de fallo
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong>has fallado 3 veces, si no eres un bot, ingrese el captchat</strong> 
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>';
          }
        }
        else
        {
          // mensaje de fallo
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Usuario no registrado</strong> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>';
        }




      } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Caracteres invalidos!</strong> porfavor, agregar caracteres validos.
                  </div>';
      }
    } else if (isset($_POST["enviar"])) {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Rellene los datos</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
    }
  }
}
