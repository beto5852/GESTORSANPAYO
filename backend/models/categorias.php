<?php 

require_once "models/conexion.php";

class CategoriasModels
{

      #-------------------------------------------------------------
    #LISTAR  LAS CATEGORIAS
    #-------------------------------------------------------------

    public static function listarCategoriasModel($tabla): array
    {
        // Instanciamos la base de datos
        $dataBase = new Conexion();
        $db = $dataBase->conectar();

        // preparamos la sentencia y le pasamos la consulta sql
        $stmt = $db->prepare("SELECT id_categoria, nombre_categoria, descripcion_categoria, estado_categoria, date_create_categoria, date_update_categoria FROM $tabla");

        // ejecutamos la consulta
        $stmt->execute();

        $categroias = $stmt->fetchAll(PDO::FETCH_ASSOC);

        var_dump($categroias);

        return $categroias;


        //liberamos la consulta

        $stmt = null;
    }


}