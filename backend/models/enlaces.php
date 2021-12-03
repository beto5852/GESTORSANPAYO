<?php 

class EnlacesModels
{

    public array $rutas;

    public static function enlacesModels($link)
    {

        $rutas = explode("/", $link);
        
        // print_r($rutas)

        //verificamos si el link esta en nuestra lista 
        if($rutas[0] == "login"      ||
           $rutas[0] == "registrar"  ||
           $rutas[0] == "dashboard"  ||
           $rutas[0] == "slider"     ||
           $rutas[0] == "galerias"   ||
           $rutas[0] == "articulos"  ||
           $rutas[0] == "crearArticulo"  ||
           $rutas[0] == "editarArticulo"  ||
           $rutas[0] == "usuarios" ||
           $rutas[0] == "editarUsuario" ||
           $rutas[0] == "perfil"     ||
           $rutas[0] == "permisos"   ||
           $rutas[0] == "salir")
        {
            //le enviamos al modulo en la lista
            $modules = "views/modules/".$rutas[0] .".php";

        }
        else if($rutas[0]  == "index" )
        {
            //le enviamos al index
            $modules = "views/modules/login.php";
        }
        else if($rutas[0]  == "ok")
        {
            //le enviamos al index
            $modules = "views/modules/crearArticulo.php";
        }
        else if($rutas[0]  == "borrarArticulo")
        {
            //le enviamos al index
            $modules = "views/modules/articulos.php";
        }
        else if($rutas[0]  == "borrarUsuario")
        {
            //le enviamos al index
            $modules = "views/modules/articulos.php";
        }
        else
        {
            //le enviamos al modulo de index
            $modules = "views/modules/login.php";
        }

        return $modules;

    }


}


