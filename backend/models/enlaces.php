<?php 

class EnlacesModels
{

    public static function enlacesModels($link)
    {
        //verificamos si el link esta en nuestra lista 
        if($link == "dashboard"  ||
           $link == "login"      ||
           $link == "slider"     ||
           $link == "galerias"   ||
           $link == "articulos"  ||
           $link == "editarArticulo"  ||
           $link == "categorias" ||
           $link == "perfil"     ||
           $link == "permisos"   ||
           $link == "salir")
        {
            //le enviamos al modulo en la lista
            $modules = "views/modules/".$link.".php";

        }
        else if($link == "index")
        {
            //le enviamos al index
            $modules = "views/modules/login.php";
        }
        else if($link == "editar")
        {
            //le enviamos al index
            $modules = "views/modules/login.php";
        }
        else
        {
            //le enviamos al modulo de index
            $modules = "views/modules/login.php";
        }

        return $modules;

    }


}


