<?php 
require_once "config/config.php";
require_once "models/enlaces.php";


require_once "controllers/enlaces.php";
require_once "controllers/template.php";

// hacemos la llamada al metodo estatica template
$front = new  TemplateController();

$front->template();


