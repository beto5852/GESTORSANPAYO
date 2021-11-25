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

    #-------------------------------------------------------------
    #OBTENERE LOS ARTICULOS
    #-------------------------------------------------------------

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


        //liberamos la consulta

        $stmt = null;
    }

    #-------------------------------------------------------------
    #OBTENERE LOS ARTICULOS
    #-------------------------------------------------------------

    public static function crearArticulosModel($datosModel,$tabla): object
    {
        // Instanciamos la base de datos
        $dataBase = new Conexion();
        $db = $dataBase->conectar();

        // preparamos la sentencia y le pasamos la consulta sql
        $stmt = $db->prepare("INSERT INTO `articulo`(`id_articulo`, `titulo_articulo`, `introduccion_articulo`, `contenido_articulo`, `imagen_articulo`, `orden_articulo`, `estado_articulo`, `date_create_articulo`, `date_update_articulo`, `fk_categoria`, `fk_usuario`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]')");

        // ejecutamos la consulta
        $stmt->execute();

        $articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($articulos);

        return $articulos;

        $stmt = null;


    }

    


}