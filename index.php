<?php 
require_once "backend/config/config.php";
require_once "backend/helpers/helpers.php";

require_once "models/enlaces.php";
require_once "models/gestorArticulos.php";


require_once "controllers/enlaces.php";
require_once "controllers/template.php";
require_once "controllers/gestorArticulos.php"; 


// hacemos la llamada al metodo estatica template
$front = new  TemplateController();

$front->template();


