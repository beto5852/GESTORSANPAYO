<?php

declare(strict_types=0);
// ob_start — Activa el almacenamiento en búfer de la salida
ob_start();

// set_error_handler("var_dump");
class ArticulosControllers
{

    #-------------------------------------------------------------
    #LISTAR ARTICULOS
    #-------------------------------------------------------------
    public function leerArticulosControllers()
    {

        $respuesta = ArticulosModels::leerArticulosModel("articulo");

        return $respuesta;
    }


    #-------------------------------------------------------------
    #LISTAR ARTICULOS
    #-------------------------------------------------------------
    public function editarArticulosControllers()
    {
        // obtenemos la url amigable y capturamos el id del articulo
        $idArticulo = explode("/", $_SERVER['REQUEST_URI']);

        // var_dump($idArticulo);
        if (isset($idArticulo[3]) && is_numeric($idArticulo[3])) {
            # code...
            $id = $idArticulo[3];

            $respuesta = ArticulosModels::editarArticuloModel($id, "articulo");
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
                // var_dump($datosController);

                // var_dump($_FILES['imagenArticulo']['name']);

                if ($datosController['titulo'] == '' || $datosController['contenido'] == '') {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>FAllo</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                } 
                else 
                {

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

                    // var_dump($respuesta);

                    if ($respuesta[0] == "exitoso") 
                    {
                        header("location:articulos/$respuesta[0]/$respuesta[1]");
                      
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
                "titulo" => trim( $_POST["actualizarTituloArticulo"]),
                "contenido" => trim($_POST["actualizarcontenido"])
            );

            
            //validamos que la imagen no este vacia
            if ($_FILES["imagenArticulo"]["error"] > 0) {
                
              

                // No se sube la imagen pero actualiza los demás campos
                if ($datosController['titulo'] == "" ||  $datosController['contenido'] == "") 
                {
                    // obtenemos la url amigable y capturamos el id del articulo
                    $idArticulo = explode("/", $_SERVER['REQUEST_URI']);

                    // var_dump($idArticulo);
                    if (isset($idArticulo[3]) && is_numeric($idArticulo[3])) {

                        header("location:".RUTA_BACKEND."editarArticulo/$idArticulo[3]/error");
                    }                   

                } else {

                    $datosController['imagen'] = "";

                    $respuesta = ArticulosModels::actualizarArticulosModel($datosController, "articulo");

                    if ($respuesta[0] == "exitoso") {

                        header("location:".RUTA_BACKEND."editarArticulo/$respuesta[1]/ok");
                        
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
                if ($datosController['titulo'] == '' ||  $datosController['contenido'] == '') 
                 {
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
                        header("location:".RUTA_BACKEND."editarArticulo/$respuesta[1]/ok");
                    }
                    else {
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
            if ($respuesta == "exitoso") 
            {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <strong>Articulo Eliminado</strong> 
            </div>';
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
