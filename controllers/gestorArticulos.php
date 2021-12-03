<?php 

class GestorArticulosController
{
    public function listarArticulosFront()
    {
        $respuesta = GestorArticulosModels::listarArticulos("articulo");
        return $respuesta;
    }
}


?>