<?php
    /* Formatear fecha */
    function formatearFecha($fecha){
        return date('d M, Y, g:i a', strtotime($fecha));
    }

    /* Recortar texto, texto de introducción */
    function textoCorto($texto, $char){

        $limpiarTexto = strip_tags($texto);
        //substr — Devuelve parte de una cadena
        $texto = mb_substr($limpiarTexto,0, $char,'UTF-8')."...";
      return $texto;
    }
