<?php 
declare(strict_types = 1);
require_once "models/conexion.php";
class ArticulosModels
{
  
    // constructor de la clase articulo
    public function __construct($db)
    {
        $this->conectar = $db;
    }

    // obtener los articulos

    public static function leerArticulosModel($tabla): array
    {
        // Instanciamos la base de datos
        $dataBase = new Conexion();
        $db = $dataBase->conectar();

        // preparamos la sentencia y le pasamos la consulta sql
        $stmt = $db->prepare("SELECT id_articulo, titulo_articulo, introduccion_articulo, contenido_articulo, imagen_articulo, orden_articulo, estado_articulo, date_create_articulo FROM $tabla");

        // ejecutamos la consulta
        $stmt->execute();

        $articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($articulos);

        return $articulos;
    }

    


}