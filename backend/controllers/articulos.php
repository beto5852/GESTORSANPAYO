<?php

declare(strict_types =0);
class ArticulosControllers
{

    

    #-------------------------------------------------------------
    #LISTAR ARTICULOS
    #-------------------------------------------------------------
    public function leerArticulosControllers()
    {

        $respuesta = ArticulosModels::leerArticulosModel("articulo");

        // var_dump($respuesta);
        // $ruta = RUTA_FRONTEND;
        // recorremos el arreglo obtenido a traves de la consulta en la BD con el item

        return $respuesta;

        /* foreach ($respuesta as $articulo) {

            //en el boton de eliminar linkeamos con una peticion get para eliminar a tarves de un action y un id seleccionado

            echo '<tr>
                    <td scope="row">' . $articulo->id_articulo. '</td>
                    <td>' . $articulo->titulo_articulo. '</td>
                    <td class="text-center"> <img src="' . $ruta . $articulo->imagen_articulo. '" class="img-fluid" width="150" height="auto" ></td>
                    <td>' . $articulo->contenido_articulo . '</td>

                    <td>
                        <a  class="btn btn-primary" href="index.php?action=usuarios&idBorrar=' . $articulo->id_articulo. '">Editar <i class="nav-icon far fa-edit"></i></a>
                        <a  class="btn btn-danger" href="index.php?action=usuarios&idBorrar=' . $articulo->id_articulo . '">Borrar <i class="nav-icon far fa-trash-alt"></i> </a>
                    </td>
                </tr>';
        } */
    }


    #-------------------------------------------------------------
    #CREAR ARTICULOS
    #-------------------------------------------------------------
    public static function crearArticulosControllers()
    {

        if (isset($_POST)) {
            $datosController = [
                "titulo" => $_POST["nombreArticulo"],
                "contenido" => $_POST["contenidoArticulo"],
                "imagen" => $_POST["imagenArticulo"],
                "fecha_publicacion" => $_POST["fechaPublicacion"],
                "autor" => $_SESSION["usuarioId"],
                "categoria" => $_POST["categoriaId"]
            ];

            $respuesta = ArticulosModels::crearArticulosModel($datosController, "articulo");
        }
    }
}
