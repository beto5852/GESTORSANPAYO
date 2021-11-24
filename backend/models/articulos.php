<?php 

include_once "models/conexion.php";
class Articulos
{
    //propiedades de conexion
    private $conectar;
    private $table = "articulo";

    // propiedades
    public $id;
    public $titulo;
    public $introduccion;
    public $contenido;
    public $imagen;
    public $orden;
    public $estado;
    public $fecha_creacion;

    // constructor de la clase articulo
    public function __construct($db)
    {
        $this->conectar = $db;
    }

    // obtener los articulos

    public function leerArticulosModel(): object
    {
        // Instanciamos la base de datos
        $dataBase = new Conexion();
        $db = $dataBase->conectar();

        # creamos la query
        $consulta = 'SELECT id_articulo, titulo_articulo, introduccion_articulo, contenido_articulo, imagen_articulo, orden_articulo, estado_articulo, date_create_articulo FROM '.$this->table;

        // preparamos la sentencia y le pasamos la consulta sql
        $stmt = $db->prepare($consulta);

        // ejecutamos la consulta
        $stmt->execute();

        $articulos = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $articulos;
    }

    


}