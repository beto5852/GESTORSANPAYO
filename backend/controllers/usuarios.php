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

                // var_dump($respuesta);
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
                            $respuesta = UsuariosModels::loginIntentos($datosController, "usuario");

                            // redirigimos la página al dashboard
                            header("location:dashboard");
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
            } else {
                echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <strong>No existe este articulo</strong> 
            </div>';
            }
        }
    }


    #-------------------------------------------------------------
    #CREAR ARTICULOS
    #-------------------------------------------------------------
    public static function crearArticulosControllers()
    {

        //validamos que los datos han sido enviados por el boton submit
        if (isset($_POST['crearArticulo'])) {
            //validamos que la imagen no este vacia
            if ($_FILES["imagenArticulo"]["error"] > 0) {
                echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>No agrego una imagen para este articulo</strong> 
                    </div>';
            } else {
                //obtenemos los valores

                $datosController = array(
                    "titulo" => trim($_POST["tituloArticulo"]),
                    "contenido" => trim($_POST["contenidoArticulo"]),
                    "fecha_publicacion" => trim($_POST["fechaArticulo"])
                );

                // var_dump($_FILES['imagenArticulo']['name']);

                if (empty($datosController['titulo']) || $datosController['titulo'] == '' || empty($datosController['contenido']) || $datosController['contenido'] == '' || empty($datosController['fecha_publicacion']) || $datosController['fecha_publicacion'] == '') {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Algunos campos estan vacio</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                } else {

                    $imagen = $_FILES['imagenArticulo']['name'];
                    $imagenArray = explode('.', $imagen);
                    $rand = rand(1000, 99999);
                    $nuevoNombreImagen = $imagenArray[0] . $rand . '.' . $imagenArray[1];
                    $rutaFinal = "../views/assets/galeria/" . $nuevoNombreImagen;

                    # movemos los archivos temporales a nuestra carpeta imagenes
                    move_uploaded_file($_FILES['imagenArticulo']['tmp_name'], $rutaFinal);

                    $datosController['imagen'] = $rutaFinal;

                    // var_dump($datosController);

                    $respuesta = ArticulosModels::crearArticulosModel($datosController, "articulo");

                    var_dump($respuesta);

                    if ($respuesta[0] == "exitoso") {
                        header("location:articulos/$respuesta[1]");
                    } else {
                        // mensaje de fallo
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>FAllo</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                    }
                }
            }
        }
    }

    #-------------------------------------------------------------
    #ACTUALIZAR ARTICULOS
    #-------------------------------------------------------------
    public static function actualizarArticulosControllers()
    {


        //validamos que los datos han sido enviados por el boton submit
        if (isset($_POST['actualizarArticulo']) && $_POST['actualizarTituloArticulo'] != '') {
            //Aignar los valores del POST a un arreglo
            $datosController = array(
                "id" => $_POST["idArticulo"],
                "titulo" => trim($_POST["actualizarTituloArticulo"]),
                "contenido" => trim($_POST["actualizarcontenido"])
            );


            //validamos que la imagen no este vacia
            if ($_FILES["imagenArticulo"]["error"] > 0) {



                // No se sube la imagen pero actualiza los demás campos
                if (empty($datosController['titulo']) || $datosController['titulo'] == "" || empty($datosController['contenido']) || $datosController['contenido'] == "") {

                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Algunos campos estan vacio</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                } else {

                    $datosController['imagen'] = "";

                    $respuesta = ArticulosModels::actualizarArticulosModel($datosController, "articulo");

                    if ($respuesta[0] == "exitoso") {

                        header("location:" . RUTA_BACKEND . "editarArticulo/$respuesta[1]/ok");
                        /* */
                    } else {
                        // mensaje de fallo
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>FAllo</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                    }
                }
            } else {

                // validar que los campos no vengan vacios
                if (empty($datosController['titulo']) || $datosController['titulo'] == '' || empty($datosController['contenido']) || $datosController['contenido'] == '') {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Algunos campos estan vacio</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                } else {

                    # code...
                    $imagen = $_FILES['imagenArticulo']['name'];
                    $imagenArray = explode('.', $imagen);
                    //rand — Genera un número entero aleatorio
                    $rand = rand(1000, 99999);
                    $nuevoNombreImagen = $imagenArray[0] . $rand . '.' . $imagenArray[1];
                    $rutaFinal = "../views/assets/galeria/" . $nuevoNombreImagen;

                    # movemos los archivos temporales a nuestra carpeta imagenes
                    move_uploaded_file($_FILES['imagenArticulo']['tmp_name'], $rutaFinal);

                    $datosController['imagen'] = $rutaFinal;

                    $respuesta = ArticulosModels::actualizarArticulosModel($datosController, "articulo");

                    if ($respuesta[0] == "exitoso") {
                        // Retornando la actualizacion
                        header("location:" . RUTA_BACKEND . "editarArticulo/$respuesta[1]");
                    } else {
                        // mensaje de fallo
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>FAllo</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                    }
                }
            }
        }
    }

    #-------------------------------------------------------------
    #BORRAR ARTICULOS
    #-------------------------------------------------------------
    public function borrarArticulosControllers()
    {

        // obtenemos la url amigable y capturamos el id del articulo
        $idArticulo = explode("/", $_SERVER['REQUEST_URI']);

        // var_dump($idArticulo);
        if (isset($idArticulo[3]) && is_numeric($idArticulo[3])) {
            # code...
            $id = $idArticulo[3];

            $respuesta = ArticulosModels::borrarArticulosModel($id, "articulo");
            if ($respuesta == "exitoso") {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <strong>Articulo Eliminado</strong> 
            </div>';
            } else {
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
