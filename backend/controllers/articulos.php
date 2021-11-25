<?php

class ArticulosControllers
{

    #-------------------------------------------------------------
    #LISTAR ARTICULOS
    #-------------------------------------------------------------
    public static function leerArticulosControllers()
    {

        $respuesta = ArticulosModels::leerArticulosModel("articulo");

        // var_dump($res);
        $ruta = RUTA_FRONTEND;
        // recorremos el arreglo obtenido a traves de la consulta en la BD con el item
        foreach ($respuesta as $item) {

            //en el boton de eliminar linkeamos con una peticion get para eliminar a tarves de un action y un id seleccionado

            echo '<tr>
                    <td scope="row">' . $item["id_articulo"] . '</td>
                    <td>' . $item["titulo_articulo"] . '</td>
                    <td class="text-center"> <img src="' . $ruta . $item["imagen_articulo"] . '" class="img-fluid" width="150" height="auto" ></td>
                    <td><a  class="btn btn-warning" href="index.php?action=usuarios&idBorrar=' . $item["estado_articulo"] . '">Desactivar  <i class="nav-icon far fa-check-square"></i></a></td>
                    <td>
                        <a  class="btn btn-primary" href="index.php?action=usuarios&idBorrar=' . $item["id_articulo"] . '">Editar <i class="nav-icon far fa-edit"></i></a>
                        <a  class="btn btn-danger" href="index.php?action=usuarios&idBorrar=' . $item["id_articulo"] . '">Borrar <i class="nav-icon far fa-trash-alt"></i> </a>
                    </td>
                </tr>';
        }
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
