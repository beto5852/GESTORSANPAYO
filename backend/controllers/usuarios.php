<?php

declare(strict_types=0);
// ob_start — Activa el almacenamiento en búfer de la salida
ob_start();

// set_error_handler("var_dump");
class UsuariosControllers
{

    #-------------------------------------------------------------
    #LOGIN USUARIOS
    #-------------------------------------------------------------

    public function registrarController()
    {


        //validamos que se envio algo
        if (isset($_POST["registrarNickname"])) {

                
            #preg_match  realiza una comparacion con una expresion regular
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["registrarNickname"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["registrarPassword"]) && filter_var($_POST["registrarEmail"], FILTER_VALIDATE_EMAIL)) 
            {

                //creamos una variable y la pasamos para encriptar
                $encriptar = password_hash($_POST["registrarPassword"], PASSWORD_DEFAULT, ['cost' => 10]);

                $datosController = array(
                    "alias" => $_POST["registrarNickname"],
                    "nombre" => $_POST["registrarNombre"],
                    "password" => $encriptar,
                    "email" => $_POST["registrarEmail"]
                );

                $repuesta = UsuariosModels::crearUsuarioModel($datosController, "usuario");


                //validar registro exitoso
                if ($repuesta == "exitoso") {

                    // redirigimos a una pagina que diga ok
                    // para actualizar la pagina
                    //quitamos el index.php?action=ok y usamos el htaccess como url amigables
                    header("location:login/exitoso");
                    exit();
                } else {
                    header("location:indexs");
                }
            } else {
                header("location:registrar");
            }
        }
    }

    #-------------------------------------------------------------
    #LOGIN USUARIOS
    #-------------------------------------------------------------

    public function loginController()
    {
        //validamos que se envio algo
        if (isset($_POST["usuarioIngreso"]) && $_POST["usuarioIngreso"] != "") {


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

                $respuesta = UsuariosModels::loginModel($datosController, "usuario");

                //validamos que la consulta exitosa
                if ($respuesta == TRUE) {

                    // obtenemos los intentos
                    $intentos = $respuesta["intentos"];
                    $intentosMaximos = 2;
                    // obtenemos el usuario actual para reiniciar los intentos
                    $usuarioActual =  $_POST["usuarioIngreso"];

                    // repuesta que recibe desde el loginmodel
                    if ($intentos < $intentosMaximos) {                       

                        //validar que los datos enviados existen en la base de datos
                        if ($respuesta["user_name"] == $_POST["usuarioIngreso"] && password_verify($_POST["passwordIngreso"], $respuesta["password_usuario"]) ) {
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
                            $respuesta = UsuariosModels::loginIntentos($datosController, "usuario");

                            // redirigimos la página al dashboard
                            header("location:".RUTA_BACKEND."dashboard");
                        } else {
                            //preincrementamos la variable de intentos
                            ++$intentos;
                            static $contador = 3;
                            // guardamos el usuario actual en un array
                            $datosController = array("usuarioActual" => $usuarioActual, "actualizarIntentos" => $intentos);

                            // actualizamos los intentos
                            $respuesta = UsuariosModels::loginIntentos($datosController, "usuario");

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
                        $respuesta = UsuariosModels::loginIntentos($datosController, "usuario");

                        // mensaje de fallo
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong>has fallado 3 veces, si no eres un bot, ingrese el captchat</strong> 
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>';
                    }
                } else {
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

    #-------------------------------------------------------------
    #LISTAR ROLES
    #-------------------------------------------------------------
    public function listarRoles()
    {

        $respuesta = UsuariosModels::listarRolesModel("permiso");

        return $respuesta;
    }


    #-------------------------------------------------------------
    #LISTAR ARTICULOS
    #-------------------------------------------------------------
    public function listarUsuariososControllers()
    {

        $respuesta = UsuariosModels::listarUsuariosModel("usuario");

        return $respuesta;
    }


    #-------------------------------------------------------------
    #LISTAR ARTICULOS
    #-------------------------------------------------------------
    public function editarUsuariosControllers()
    {
        // obtenemos la url amigable y capturamos el id del articulo
        $idUsuario = explode("/", $_SERVER['REQUEST_URI']);

        // var_dump($idArticulo);
        if (isset($idUsuario[3]) && is_numeric($idUsuario[3])) {
            # code...
            $id = $idUsuario[3];

            $respuesta = UsuariosModels::editarUsuarioModel($id, "usuario");
            if ($respuesta == true) {
                return $respuesta;
            } 
            else 
            {
                echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <strong>No existe este articulo</strong> 
            </div>';
            }
        }
    }
}
