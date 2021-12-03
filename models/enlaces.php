<?php 


class EnlacesFrontModels
{

    public array $rutas;

    public static function enlacesFrontModel($link)
    {

        $rutas = explode("/", $link);
        
        // print_r($rutas)

        //verificamos si el link esta en nuestra lista 
        if($rutas[0] == "inicio"  ||
           $rutas[0] == "detalleArticulo"  )
        {
            //le enviamos al modulo en la lista
            $modules = "views/modules/".$rutas[0] .".php";

        }
        else if($rutas[0]  == "index" )
        {
            //le enviamos al index
            $modules = "views/modules/inicio.php";
        }       
        else
        {
            //le enviamos al modulo de index
            $modules = "views/modules/inicio.php";
        }

        return $modules;

    }

}



?>