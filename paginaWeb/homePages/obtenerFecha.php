<?php
date_default_timezone_set ( "America/Bogota" );
$fecha = getdate();
function convertirFecha($fecha, &$dia, &$nombreDia, &$mes, &$año){
    $dia = $fecha['mday'];
    switch ($fecha['wday']) {
        case '0':
            $nombreDia = "Domingo";
            break;
        case '1':
            $nombreDia = "Lunes";
            break;
        case '2':
            $nombreDia = "Martes";
            break;
        case '3':
            $nombreDia = "Miercoles";
            break;
        case '4':
            $nombreDia = "Jueves";
            break;
        case '5':
            $nombreDia = "Viernes";
            break;
        case '6':
            $nombreDia = "Sabado";
            break;
    }
    switch ($fecha['mon']) {
        case '1':
            $mes = "Enero";
            break;
        case '2':
            $mes = "Febrero";
            break;
        case '3':
            $mes = "Marzo";
            break;
        case '4':
            $mes = "Abril";
            break;
        case '5':
            $mes = "Mayo";
            break;
        case '6':
            $mes = "Junio";
            break;
        case '7':
            $mes = "Julio";
            break;
        case '8':
            $mes = "Agosto";
            break;
        case '9':
            $mes = "Septiembre";
            break;
        case '10':
            $mes = "Octubre";
            break;
        case '11':
            $mes = "Noviembre";
            break;
        case '12':
            $mes = "Diciembre";
            break;
    }
    $año = $fecha['year'];
}
function obtenerHora($fecha, &$hora, &$minuto, &$horario){
    if ($fecha['hours']>=13) {
        $horario = "PM";
        $hora = $fecha['hours']-12;
    } else {
        $horario = "AM";
        $hora = $fecha['hours'];
    }
    if ($fecha['minutes']<=9) {
        $minuto = "0"+$fecha['minutes'];
    } else {
        $minuto = $fecha['minutes'];
    }    
}
convertirFecha($fecha, $dia, $nombreDia, $mes, $año);
obtenerHora($fecha, $hora, $minuto, $horario);
$fechaString = $nombreDia." ".$dia." de ".$mes." del ".$año." / ".$hora.":".$minuto." ".$horario;
?>