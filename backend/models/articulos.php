<?php

declare(strict_types=1);
require_once "models/conexion.php";
class ArticulosModels
{

    // propiedades
    public $id_articulo;
    public $titulo_articulo;
    public $contenido_articulo;
    public $imagen_articulo;
    public $date_create_articulo;

    // constructor de la clase articulo
    public function __construct($db)
    {
        $this->conectar = $db;
    }

    #-------------------------------------------------------------
    #LISTAR LOS ARTICULOS
    #-------------------------------------------------------------

    public static function leerArticulosModel($tabla): array
    {
        // Instanciamos la base de datos
        $dataBase = new Conexion();
        $db = $dataBase->conectar();

        // preparamos la sentencia y le pasamos la consulta sql
        $stmt = $db->prepare("SELECT id_articulo, titulo_articulo, contenido_articulo, imagen_articulo,  date_create_articulo FROM $tabla");

        // ejecutamos la consulta
        $stmt->execute();

        $articulos = $stmt->fetchAll(PDO::FETCH_OBJ);

        // var_dump($articulos);

        return $articulos;


        //liberamos la consulta

        $stmt = null;
    }

    #-------------------------------------------------------------
    #CREAR LOS ARTICULOS
    #-------------------------------------------------------------

    public static function crearArticulosModel($datosModel, $tabla)
    {
        // Instanciamos la base de datos
        $dataBase = new Conexion();
        $db = $dataBase->conectar();

        // preparamos la sentencia y le pasamos la consulta sql
        $stmt = $db->prepare("INSERT INTO $tabla (titulo_articulo, contenido_articulo, imagen_articulo, date_create_articulo)  VALUES (:titulo, :contenido, :imagen, :fecha)");

        $stmt->bindParam(":titulo", $datosModel['titulo'], PDO::PARAM_STR);
        $stmt->bindParam(":contenido", $datosModel['contenido'], PDO::PARAM_STR);
        $stmt->bindParam(":imagen", $datosModel['imagen'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datosModel['fecha_publicacion'], PDO::PARAM_STR);


        // ejecutamos la consulta
        if ($stmt->execute()) {
            $resp = ["exitoso", $db->lastInsertId()];
            // var_dump($db->lastInsertId());
            return $resp;
        } else {
            return "error";
        }
    }


    #-------------------------------------------------------------
    #EDITAR LOS ARTICULOS
    #-------------------------------------------------------------

    public static function editarArticuloModel($idArticulo, $tabla)
    {
        // Instanciamos la base de datos
        $dataBase = new Conexion();
        $db = $dataBase->conectar();

        // preparamos la sentencia y le pasamos la consulta sql
        $stmt = $db->prepare("SELECT id_articulo, titulo_articulo, contenido_articulo, imagen_articulo, date_create_articulo FROM $tabla WHERE id_articulo = :idArticulo");

        $stmt->bindParam(":idArticulo", $idArticulo, PDO::PARAM_INT);

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
        }
        else
        {
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
}
