<?php 

// cargamos los helpes


require_once "helpers/helpers.php";

// cargamos las clases de los enlaces que estan en el modelo
require_once "models/enlaces.php";
require_once "models/usuarios.php";
require_once "models/articulos.php";
require_once "models/categorias.php";



// cargamos las clase para agregar plantilla
require_once "controllers/template.php";

// cargamos la clase de los enlaces que se estan pasando por el GET atraves de la url
require_once "controllers/enlaces.php";
require_once "controllers/usuarios.php";
require_once "controllers/articulos.php";
require_once "controllers/categorias.php";

$plantillaBackend = new TemplateController();
$plantillaBackend->template();



?>