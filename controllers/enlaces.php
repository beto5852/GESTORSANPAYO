<?php 

class enlacesFrontControllers
{
    public function enlacesFrontControllers(){

        //obtenemos el enlace por medio de la variable GET
        if(isset($_GET["enlacefront"]))
        {
            // la asignamos si existe a una variable
            $link = $_GET["enlacefront"];
            // $rutas = explode("/", $link);
            
        }
        else
        {
            // si no cumple le asignamos por defecto index
            $link= "index";
        }
        
        //enviamos al modelo para verificar si esta e la lista blanca

        $respuesta = EnlacesFrontModels::enlacesFrontModel($link);

        // incluimos la repuesta en el index
        // var_dump($respuesta);
        include $respuesta;

    }

}







?>