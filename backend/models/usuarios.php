<?php

declare(strict_types=1);
require_once "models/conexion.php";
ob_start();

class UsuariosModels
{


    /***************************************************************************
     * 
     * METODO PARA BUSCAR EL USUARIO PARA EL LOGIN
     * 
     ***************************************************************************/
    public static function loginModel( array $datosModel, string $tabla): array|bool
    {
         // Instanciamos la base de datos
         $dataBase = new Conexion();
         $db = $dataBase->conectar();

        //  var_dump($db);

        $stmt = $db->prepare("SELECT id_usuario, user_name, nombre_usuario, password_usuario, email_usuario, imagen_usuario, intentos FROM  $tabla WHERE user_name = :usuario");

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
         // Instanciamos la base de datos
         $dataBase = new Conexion();
         $db = $dataBase->conectar();

        $stmt = $db->prepare("UPDATE $tabla SET intentos = :intentos WHERE user_name = :usuario");

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

     #-------------------------------------------------------------
    #LISTAR LOS USUARIO
    #-------------------------------------------------------------

    public static function listarRolesModel($tabla)
    {
        // Instanciamos la base de datos
        $dataBase = new Conexion();
        $db = $dataBase->conectar();

        // preparamos la sentencia y le pasamos la consulta sql
        $stmt = $db->prepare("SELECT id_permiso AS id, nombre_permiso AS permiso FROM $tabla");

        // ejecutamos la consulta
        $stmt->execute();

        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);

        // var_dump($articulos);

        return $usuarios;


        //liberamos la consulta

        $stmt = null;
    }


    #-------------------------------------------------------------
    #LISTAR LOS USUARIO
    #-------------------------------------------------------------

    public static function listarUsuariosModel($tabla)
    {
        // Instanciamos la base de datos
        $dataBase = new Conexion();
        $db = $dataBase->conectar();

        // preparamos la sentencia y le pasamos la consulta sql
        $stmt = $db->prepare("SELECT u.id_usuario AS id, u.nombre_usuario AS nombre, u.email_usuario AS email, u.imagen_usuario AS imagen, p.nombre_permiso AS permiso
        FROM usuario AS u
        INNER JOIN permiso AS p
        ON u.permiso_id = p.id_permiso");

        // ejecutamos la consulta
        $stmt->execute();

        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);

        // var_dump($articulos);

        return $usuarios;


        //liberamos la consulta

        $stmt = null;
    }

    #-------------------------------------------------------------
    #CREAR LOS ARTICULOS
    #-------------------------------------------------------------

    public static function crearUsuarioModel($datosModel, $tabla)
    {
        // Instanciamos la base de datos
        $dataBase = new Conexion();
        $db = $dataBase->conectar();

        // preparamos la sentencia y le pasamos la consulta sql
        $stmt = $db->prepare("INSERT INTO $tabla (user_name, nombre_usuario, email_usuario, password_usuario ) VALUES(:alias, :nombre, :email, :password) ");

        $stmt->bindParam(":alias", $datosModel['alias'], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datosModel['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datosModel['email'], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datosModel['password'], PDO::PARAM_STR);


        // ejecutamos la consulta
        if ($stmt->execute()) {
            return "exitoso";
        } else {
            return "error";
        }
    }


    #-------------------------------------------------------------
    #EDITAR LOS ARTICULOS
    #-------------------------------------------------------------

    public static function editarUsuarioModel($idUsuario, $tabla)
    {
        // Instanciamos la base de datos
        $dataBase = new Conexion();
        $db = $dataBase->conectar();

        // preparamos la sentencia y le pasamos la consulta sql
        $stmt = $db->prepare("SELECT u.id_usuario AS id,  u.user_name AS nickname, u.nombre_usuario AS nombre, u.apellido_usuario AS apellido, u.email_usuario AS email, u.password_usuario AS password, u.telefono_usuario AS telefono, u.imagen_usuario AS imagen, p.nombre_permiso AS permiso
        FROM $tabla AS u INNER JOIN permiso AS p ON u.permiso_id = p.id_permiso WHERE u.id_usuario = :idUsuario");

        $stmt->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);

        // ejecutamos la consulta
        $stmt->execute();

        $articulos = $stmt->fetch(PDO::FETCH_OBJ);

        // var_dump($articulos);

        return $articulos;


        //liberamos la consulta

        $stmt = null;
    }


    #-------------------------------------------------------------
    #EDITAR LOS ARTICULOS
    #-------------------------------------------------------------

    public static function actualizarArticulosModel($datosModel, $tabla)
    {
        // Instanciamos la base de datos
        $dataBase = new Conexion();
        $db = $dataBase->conectar();

        if ($datosModel["imagen"] == "") {
            // preparamos la sentencia y le pasamos la consulta sql
            $stmt = $db->prepare("UPDATE $tabla SET  titulo_articulo = :titulo, contenido_articulo = :contenido WHERE id_articulo = :idArticulo");

            $stmt->bindParam(":titulo", $datosModel["titulo"], PDO::PARAM_STR);
            $stmt->bindParam(":contenido", $datosModel["contenido"], PDO::PARAM_STR);
            $stmt->bindParam(":idArticulo", $datosModel["id"], PDO::PARAM_INT);

            // ejecutamos la consulta

            if ($stmt->execute()) {
                # code...
                $resp = ["exitoso", $datosModel["id"]];
                return $resp;
            } else {
                return "error";
            }
        } else {
            // preparamos la sentencia y le pasamos la consulta sql
            $stmt = $db->prepare("UPDATE $tabla SET  titulo_articulo = :titulo, contenido_articulo = :contenido, imagen_articulo = :imagen WHERE id_articulo = :idArticulo");

            $stmt->bindParam(":titulo", $datosModel["titulo"], PDO::PARAM_STR);
            $stmt->bindParam(":contenido", $datosModel["contenido"], PDO::PARAM_STR);
            $stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);
            $stmt->bindParam(":idArticulo", $datosModel["id"], PDO::PARAM_INT);

            // ejecutamos la consulta

            if ($stmt->execute()) {
                # code...
                $resp = ["exitoso", $datosModel["id"]];
                return $resp;
            } else {
                return "error";
            }
        }

        //liberamos la consulta

        $stmt = null;
    }


    #-------------------------------------------------------------
    #BORRAR LOS ARTICULOS
    #-------------------------------------------------------------

    public static function borrarArticulosModel($idArticulo, $tabla)
    {
        // Instanciamos la base de datos
        $dataBase = new Conexion();
        $db = $dataBase->conectar();

        // preparamos la sentencia y le pasamos la consulta sql
        $stmt = $db->prepare("DELETE FROM $tabla WHERE id_articulo = :id");

        $stmt->bindParam(":id", $idArticulo, PDO::PARAM_INT);


        // ejecutamos la consulta
        if ($stmt->execute()) {
            return "exitoso";
        } else {
            return "error";
        }
    }
}
