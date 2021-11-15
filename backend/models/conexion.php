<?php 

declare(strict_types = 1);

class Conexion
{

    public static function conectar():object
    {
        $conexion = new PDO("mysql:host=localhost;dbname=gestor","root","");
        
        return $conexion;

        $conexion = null;
    }


}




