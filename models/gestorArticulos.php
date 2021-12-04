<?php 

require_once "backend/models/conexion.php";

class GestorArticulosModels
{

    /**
     * Listar los articulos en el fronend
     */

     public static function listarArticulos($tabla)
     {
         $dataBase = new Conexion();
         $db = $dataBase->conectar();

         $stmt = $db->prepare("SELECT a.id_articulo AS id, a.titulo_articulo AS titulo, a.contenido_articulo AS contenido, a.imagen_articulo AS imagen, a.date_create_articulo AS publicacion, c.nombre_categoria AS categoria FROM $tabla AS a INNER JOIN categoria AS c ON a.fk_categoria = c.id_categoria
         WHERE a.date_create_articulo = (SELECT MAX(date_create_articulo) FROM articulo) 
         ORDER BY a.id_articulo DESC LIMIT 3");

         $stmt->execute();

         $respuesta = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $respuesta;

        $stmt = null;
     }


     public static function detalleArticuloModel($idArticulo, $tabla)
     {
         $dataBase = new Conexion();
         $db = $dataBase->conectar();

         $stmt = $db->prepare("SELECT a.id_articulo AS idArticulo, a.fk_categoria AS idCategoria, a.titulo_articulo AS titulo, a.contenido_articulo AS contenido, a.imagen_articulo AS imagen, a.date_create_articulo AS publicacion, c.nombre_categoria AS categoria FROM $tabla AS a INNER JOIN categoria AS c ON a.fk_categoria = c.id_categoria WHERE a.id_articulo = :id");
         
         $stmt->bindParam(":id",$idArticulo,PDO::PARAM_INT);

         $stmt->execute();

         $respuesta = $stmt->fetch(PDO::FETCH_OBJ);

        return $respuesta;

        $stmt = null;
     }
}

?>