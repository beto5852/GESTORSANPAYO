<?php 

include_once "models/categorias.php";

class CategoriasControllers
{
    #-------------------------------------------------------------
    #LISTAR ARTICULOS
    #-------------------------------------------------------------

    public static function listarCatergoriasControllers()
    {
        $respuesta = CategoriasModels::listarCategoriasModel("categoria");

       
        foreach($respuesta as $categoria){

            echo '<option>'.$categoria['nombre_categoria'].'</option>';

        }

    }
}