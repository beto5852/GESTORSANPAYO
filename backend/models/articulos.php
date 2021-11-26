<?php 
declare(strict_types = 1);
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

    public static function leerUnArticuloModel($idArticulo,$tabla): array
    {
        // Instanciamos la base de datos
        $dataBase = new Conexion();
        $db = $dataBase->conectar();

        // preparamos la sentencia y le pasamos la consulta sql
        $stmt = $db->prepare("SELECT id_articulo, titulo_articulo, contenido_articulo, imagen_articulo,  date_create_articulo FROM $tabla WHERE id = : idArticulo LIMIT 0,1");

        $stmt->bindParam(":idArticulo",$idArticulo,PDO::PARAM_INT );

        // ejecutamos la consulta
        $stmt->execute();

        $articulos = $stmt->fetch(PDO::FETCH_OBJ);

        // var_dump($articulos);

        return $articulos;


        //liberamos la consulta

        $stmt = null;
    }









    #-------------------------------------------------------------
    #OBTENERE LOS ARTICULOS
    #-------------------------------------------------------------

   

    


}