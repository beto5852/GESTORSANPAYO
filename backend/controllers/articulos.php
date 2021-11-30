<?php
declare(strict_types=0);
// ob_start — Activa el almacenamiento en búfer de la salida
ob_start();

// set_error_handler("var_dump");
class ArticulosControllers
{


    private $tabla = "articulo";
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
        $idArticulo = explode("/",$_SERVER['REQUEST_URI']);

        // var_dump($idArticulo);
        if (isset($idArticulo[3])) {
            # code...
            $id = $idArticulo[3];
            
            $respuesta = ArticulosModels::editarArticuloModel($id, "articulo");
            if ($respuesta == true) {
                # code...
                var_dump($respuesta);

            }
            else{
                echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <strong>No agrego una imagen para este articulo</strong> 
            </div>';
            }

        }

        return $respuesta;
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
                    "titulo" => $_POST["tituloArticulo"],
                    "contenido" => $_POST["contenidoArticulo"],
                    "fecha_publicacion" => $_POST["fechaArticulo"]
                );

                // var_dump($_FILES['imagenArticulo']['name']);

                if (empty($datosController['titulo']) || $datosController['titulo'] == '' || empty($datosController['contenido']) || $datosController['contenido'] == '' || empty($datosController['fecha_publicacion']) || $datosController['fecha_publicacion'] == '') 
                {
                    echo  "Error algunos campos estan vacio";
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
                    
                    var_dump($respuesta);

                    if ($respuesta[0] == "exitoso") {
                        // mensaje de fallo
                    header("location:articulos/$respuesta[1]");
                     /*    echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <strong>Agregado</strong> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>'; */
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
}
