<?php 

// cargamos las clases de los enlaces que estan en el modelo
require_once "models/enlaces.php";
require_once "models/ingreso.php";
require_once "models/articulos.php";
// cargamos las clase para agregar plantilla
require_once "controllers/template.php";

// cargamos la clase de los enlaces que se estan pasando por el GET atraves de la url
require_once "controllers/enlaces.php";
require_once "controllers/ingreso.php";
require_once "controllers/articulos.php";

$plantillaBackend = new TemplateController();
$plantillaBackend->template();



?>