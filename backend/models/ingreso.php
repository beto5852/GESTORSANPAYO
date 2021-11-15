<?php

declare(strict_types = 1);
require_once "models/conexion.php";

class LoginModels extends Conexion
{
     /***************************************************************************
     * 
     * METODO PARA BUSCAR EL USUARIO PARA EL LOGIN
     * 
     ***************************************************************************/
    public static function loginModel( array $datosModel, string $tabla): array|bool
    {
        $stmt = Conexion::conectar()->prepare("SELECT user_name, nombre_usuario,password_usuario, email_usuario, imagen_usuario, intentos FROM  $tabla WHERE user_name = :usuario");

        $stmt->bindParam(":usuario",$datosModel["usuario"], PDO::PARAM_STR);

        $stmt->execute();
        
        //retornamos un array asociativo o false si no se ejecuta
        return $stmt->fetch();

        
        //cerramos las conexiones
        $stmt= null;
    }
    /***************************************************************************
     * 
     * METODO PARA ACTUALIZAR LOS INTENTOS FALLIDOS
     * 
     ***************************************************************************/


    public static function loginIntentos(array $datosModel,string $tabla) :string
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET intentos = :intentos WHERE user_name = :usuario");

        $stmt->bindParam(":intentos",$datosModel["actualizarIntentos"], PDO::PARAM_INT);
        $stmt->bindParam(":usuario",$datosModel["usuarioActual"], PDO::PARAM_STR);

       

        //retornamos un array asociativo o false si no se ejecuta
        if ( $stmt->execute()) {
            
            return "actualizado";
        }
       else{
           return "error";
       }

        
        //cerramos las conexiones
        $stmt= null;
    }
}







