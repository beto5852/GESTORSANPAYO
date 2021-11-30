<?php 

class EnlacesControllers 
{

    public function enlacesControllers(){

        //obtenemos el enlace por medio de la variable GET
        if(isset($_GET["enlace"]))
        {
            // la asignamos si existe a una variable
            $link = $_GET["enlace"];
            // $rutas = explode("/", $link);
            
        }
        else
        {
            // si no cumple le asignamos por defecto index
            $link= "index";
        }
        
        //enviamos al modelo para verificar si esta e la lista blanca

        $respuesta = EnlacesModels::enlacesModels($link);

        // incluimos la repuesta en el index
        // var_dump($respuesta);
        include $respuesta;

    }



}
