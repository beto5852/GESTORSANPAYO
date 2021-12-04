 <!-- ---------------------------------
    INICIA HEADERSLIDER
    ---------------------------------- -->
    <?php 
        
        $detallesArticulo = new GestorArticulosController();
        $respuesta = $detallesArticulo->detalleArticulosFront();
        // var_dump($respuesta);
    
    ?>
 <div class="">

    <!-- ---------------------------------
    INICIA EL CONTENEDOR HERO
    ---------------------------------- -->

     <div class="hero-internas" style="background-image: url('<?=$respuesta->imagen?>');">
         <header class="header contenedor" id="header">
        <!-- ---------------------------------
        INICIA MENU
        ---------------------------------- -->
         <?php include "views/includes/menu.php"; ?>

         </header> <!-- termina el header-->
     </div> <!-- div de la imagen hero -->

 </div>
 <!-- termina la seccion del header slider -->
 
 <!-- ---------------------------------
        INICIA SECCION PRINCIPAL
    ---------------------------------- -->

<main class="container ml-1 mr-1">

<div class="row">
    <div class="col-12">
       
    </div>
</div>


</main> <!-- termina la seccion main o principal-->


<?php include "views/includes/footer.php"; ?>