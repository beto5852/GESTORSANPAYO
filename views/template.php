
<!-- ---------------------------------
INICIA CABECERA
---------------------------------- -->

<!DOCTYPE html>
<html lang="es-419">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?=RUTA_FRONTEND?>views/css/normalize.css">

    <!-- FontAwesome css -->

    <link rel="stylesheet" href="<?=RUTA_FRONTEND?>views/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/views/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/> -->

    <script src="<?=RUTA_FRONTEND?>views/js/jquery.min.js"></script>    
    <script src="<?=RUTA_FRONTEND?>views/js/jquery.bxslider.min.js"></script>

    <!-- Cargamos los estilos de las librerias -->
    <link rel="stylesheet" href="<?=RUTA_FRONTEND?>views/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?=RUTA_FRONTEND?>views/css/lightbox.css">
    <link rel="stylesheet" href="<?=RUTA_FRONTEND?>views/css/jquery.bxslider.css">

   
    <!-- Cargamos nuestros propios estilo -->

    <link rel="stylesheet" href="<?=RUTA_FRONTEND?>views/css/estilos.css">
    <title>San Payo Tour</title>
</head>

<!-- termina la cabecera head -->

<!-- ---------------------------------
INICIA EL CUERPO
---------------------------------- -->
<body>

    <?php 
    
    $home = new enlacesFrontControllers();
    $home->enlacesFrontControllers();
    
    ?>

   
  

    <!-- libreria owlcarrusel -->
    <script src="<?=RUTA_FRONTEND?>views/js/owl.carousel.min.js"></script>
    <!-- libreria smothcroll -->
    <script src="<?=RUTA_FRONTEND?>views/js/smooth-scroll.min.js"></script>
    <!-- libreria lightbox -->
    <script src="<?=RUTA_FRONTEND?>views/js/lightbox.js"></script>
    <!-- nuestra propia libreria javascript -->
    <script src="<?=RUTA_FRONTEND?>views/js/init.js"></script>

</body><!-- termina el body -->
</html>

