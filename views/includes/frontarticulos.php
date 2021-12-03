<?php

$mostrarArticulos = new GestorArticulosController();
$listarArticulos = $mostrarArticulos->listarArticulosFront();

// var_dump($listarArticulos);
?>

<section class="evento">
    <h2>Eventos Nacionales</h2>
    <div class="contenedor-cards">
        <?php foreach ($listarArticulos as $articulo) : ?>

            <?php
            switch ($articulo->categoria) {
                case 'Noticias':
                    echo '<article class="card">
                            <img src="'. $articulo->imagen . '" alt="">
                            <div class="info">
                                <h6 class="categoria ' . $articulo->categoria . '">' . $articulo->categoria . '</h6>
                                <h3 class="titulo">' . $articulo->titulo . '</h3>
                                <p class="precio">' . textoCorto($articulo->contenido, 100) . '</p>
                                <a href="detalleArticulo/'.$articulo->id.'" class="btn">Leer Más</a>
                            </div>
                        </article>';
                    break;
                case 'Turismo':
                    echo '<article class="card">
                            <img src="'.$articulo->imagen . '" alt="">
                            <div class="info">
                                <h6 class="categoria ' . $articulo->categoria . '">' . $articulo->categoria . '</h6>
                                <h3 class="titulo">' . $articulo->titulo . '</h3>
                                <p class="precio">' . textoCorto($articulo->contenido, 100) . '</p>
                                <a href="detalleArticulo/'.$articulo->id.'" class="btn">Leer Más</a>
                                </div>
                         </article>';
                    break;
                case 'Deportes':
                    echo '<article class="card">
                            <img src="'. $articulo->imagen . '" alt="">
                            <div class="info">
                                <h6 class="categoria ' . $articulo->categoria . '">' . $articulo->categoria . '</h6>
                                <h3 class="titulo">' . $articulo->titulo . '</h3>
                                <p class="precio">' . textoCorto($articulo->contenido, 100) . '</p>
                                <a href="detalleArticulo/'.$articulo->id.'" class="btn">Leer Más</a>
                            </div>
                         </article>';
                    break;
                    case 'Juegos':
                        echo '<article class="card">
                            <img src="'. $articulo->imagen . '" alt="">
                            <div class="info">
                                <h6 class="categoria ' . $articulo->categoria . '">' . $articulo->categoria . '</h6>
                                <h3 class="titulo">' . $articulo->titulo . '</h3>
                                <p class="precio">' . textoCorto($articulo->contenido, 100) . '</p>
                                <a href="detalleArticulo/'.$articulo->id.'" class="btn">Leer Más</a>
                            </div>
                        </article>';
                        break; 
                        case 'Conciertos':
                            echo '<article class="card">
                                <img src="'. $articulo->imagen . '" alt="">
                                <div class="info">
                                    <h6 class="categoria ' . $articulo->categoria . '">' . $articulo->categoria . '</h6>
                                    <h3 class="titulo">' . $articulo->titulo . '</h3>
                                    <p class="precio">' . textoCorto($articulo->contenido, 100) . '</p>
                                    <a href="detalleArticulo/'.$articulo->id.'" class="btn">Leer Más</a>
                                </div>
                            </article>';
                            break;                           

                default:
                    # code...
                    break;
            }


            ?>

        <?php endforeach; ?>
        <!-- 
        <article class="card">
            <img src="views/assets/actividades/canopy.jpg" alt="">
            <div class="info">
                <h6 class="categoria juegos">Juegos</h6>
                <h3 class="titulo">Canopy Tour Miravalle</h3>
                <p class="precio"><span>Precio: </span>C$1200 c/u</p>
            </div>
        </article>
        
        <article class="card">
            <img src="views/assets/actividades/boarding.jpg" alt="">
            <div class="info">
                <h6 class="categoria deporte">Deporte</h6>
                <h3 class="titulo">Boarding Cerro Negro</h3>
                <p class="precio"><span>Precio: </span>C$1200 c/u</p>
            </div>
        </article>
        <article class="card">
            <img src="views/assets/actividades/concierto.jpeg" alt="">
            <div class="info">
                <h6 class="categoria eventos">Conciertos</h6>
                <h3 class="titulo">Concierto en Rivas</h3>
                <p class="precio"><span>Precio: </span>C$500 c/u</p>
            </div>
        </article> -->
    </div> <!-- div para card-->
</section>
<!--seccion evento-->


