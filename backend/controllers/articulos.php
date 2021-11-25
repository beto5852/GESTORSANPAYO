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
                    <td scope="row">'.$item["id_articulo"].'</td>
                    <td>'.$item["titulo_articulo"].'</td>
                    <td class="text-center"> <img src="'.$ruta.$item["imagen_articulo"].'" alt="" width="150" height="auto" ></td>
                    <td><a  class="btn btn-success" href="index.php?action=usuarios&idBorrar='.$item["estado_articulo"].'">Activo</a></td>
                    <td>
                        <a  class="btn btn-primary" href="index.php?action=usuarios&idBorrar='.$item["id_articulo"].'">Actualizar</a>
                        <a  class="btn btn-danger" href="index.php?action=usuarios&idBorrar='.$item["id_articulo"].'">Borrar</a>
                    </td>
                </tr>';
        }
       

    }


}