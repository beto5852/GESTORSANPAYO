<?php 




      // filter_has_var — Comprueba si existe una variable de un tipo concreto existe

    /* if (filter_has_var(INPUT_POST, "info")) {
        # code...
        echo "Información enviada";
    }else{
        echo "No se envio la informacion";
    } */


    // Validar el email

    /* if (filter_has_var(INPUT_POST, "info")) {
        if (filter_input(INPUT_POST,"info",
        FILTER_VALIDATE_EMAIL)) {
            echo "Email valido";
        }else{
            echo "Es un Email Invalido";
        }
    }
    else
    {
        echo "No se pudo enviar la informacion";
    } 
     */

  /*   if (filter_has_var(INPUT_POST, "info")) {

        // $email = $_POST["info"];
        $pass = $_POST["info"];

        // Eliminar caracteres invalido (sanear) alexo2407///<>()@<gmail>.com
        // $emailLimpio = filter_var($email, FILTER_SANITIZE_EMAIL);

        $expresion = array(
                            "options" => array("regexp"=>"/^[a-zA-Z0-9]+$/")
                            );

        if (filter_var($pass, FILTER_VALIDATE_REGEXP , $expresion)) {
            $mensaje = "Pass Invalido";
        }else{
            $mensaje = "Pass Valido";
        }

        echo $mensaje;

    } */
    
    


    // Tipos de validaciones
    // FILTER_VALIDATE_EMAIL
    // FILTER_VALIDATE_IP
    // FILTER_VALIDATE_INT
    // FILTER_VALIDATE_BOOL
    // FILTER_VALIDATE_FLOAT
    // FILTER_VALIDATE_REGEXP
    // FILTER_VALIDATE_DOMAIN

    // tipod de saneaciones
    // FILTER_SANITIZE_EMAIL
// FILTER_SANITIZE_STRING
// FILTER_SANITIZE_NUMBER_INT


// Validar un numero entero
// $numero = 300;

/* if (filter_has_var(INPUT_POST,"info")) {
    # code...
    $numero = $_POST["info"];
    if (filter_var($numero, FILTER_VALIDATE_INT)) {
        # code...
        $mensaje =  ' <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Este es un numero entero</strong> 
                </div>';
        }else{
                $mensaje = ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Este no es un numero entero</strong> 
                    </div>';
    } */


    // sanear un numero entero
  /*   if (filter_has_var(INPUT_POST,"info")) {
        # code...
        $numero = $_POST["info"];

        $saneado = filter_var($numero, FILTER_SANITIZE_NUMBER_INT);
        if ($saneado) {
            # code...
            $mensaje =  ' <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>'.$saneado.'</strong> 
                    </div>';
            }
    } */


    // Prevenir ejecuciones de script

    /* if (filter_has_var(INPUT_POST,"info")) {
        # code...
        $script = $_POST["info"];

        // $mensaje = $script;

        $saneado = filter_var($script, FILTER_SANITIZE_SPECIAL_CHARS);
        if ($saneado) {
            # code...
            $mensaje =  ' <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>'.$saneado.'</strong>  <span>Cuidado estas inyectando código</span>
                    </div>';
            }
    } */

    //Filter input array

  /*   
    $filtros = array($_POST["registrarNombre"] => FILTER_VALIDATE_EMAIL,
    $_POST["registrarPassword"] => array(
       "filter" => FILTER_VALIDATE_REGEXP,
       "options" => array( "regexp" => '/^[a-zA-Z0-9]+$/')));

    $filtros = array(   "info" => FILTER_VALIDATE_EMAIL,
                        "info2" => array(
                            "filter" => FILTER_VALIDATE_INT,
                            "options" => array(
                                "min_range" => 1,
                                "max_range" => 20
                            )
                        )
                     );
                      $filtros = array ($_POST['registrarEmail'] => FILTER_VALIDATE_EMAIL,
            $_POST['registrarNickname'] => array('filter' => FILTER_VALIDATE_REGEXP,
                                                'options' => array( 'regexp' => '/^[a-zA-Z0-9]+$/')
                                            ),
            $_POST['registrarNombre'] => array('filter' => FILTER_VALIDATE_REGEXP,
                                                "options" => array( 'regexp' => '/^[a-zA-Z0-9]+$/')
                                            ),
            $_POST['registrarPassword'] => array('filter' => FILTER_VALIDATE_REGEXP,
                                                'options' => array( 'regexp' => '/^[a-zA-Z0-9]+$/')
                                            ));

            print_r(filter_input_array(INPUT_POST,$filtros));

    $campos = filter_input_array(INPUT_POST,$filtros); */



    ?>