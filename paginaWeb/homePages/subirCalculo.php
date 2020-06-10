<?php
    require_once('obtenerFecha.php');
    session_start();
    $nombre = $_SESSION['nombre'];  
    $usuario = $_SESSION['usuario'];
    $tipoUsuario = $_SESSION['tipoUsuario'];
    if ($tipoUsuario==1) {
        $tipo = "Administrador de entidad";
    } else {
        $tipo = "Usuario standard";
    }
    
	$apellido = $_SESSION['apellido'];
	$edad = $_SESSION['edad'];
	$correo = $_SESSION['correo'];
    $telefono = $_SESSION['telefono'];
    $nombreEntidad = $_SESSION['nombreEntidad'];

    $fecha = getdate();

    if ($nombre=="") {
        header("Location:../index.html");
    }

    $huellaTotal = $_POST['huella'];

    require("../php/conexion.php");

    $consulta = "INSERT INTO `informes`(`idInformes`, `resultado`, `fecha`) VALUES ('$usuario','$huellaTotal','$fechaString')";
    $resultado = mysqli_query($conexion, $consulta) or die (mysqli_error($conexion));    

    $consultaSesion = "SELECT * FROM `informes`";
    $resultado = mysqli_query($conexion, $consultaSesion) or die (mysqli_error($conexion));

    $cantidadCalculos = 0;
    $sumatoria = 0;

    while ($columna = mysqli_fetch_array( $resultado )) {
        if ($columna['idInformes']==$usuario) {
            $cantidadCalculos++;
            $sumatoria = $sumatoria+$columna['resultado'];
        }
    }

    $promedio = $sumatoria / $cantidadCalculos;
    $_SESSION['cantidad'] = $cantidadCalculos;
    $_SESSION['sumatoria'] = $sumatoria;
    $_SESSION['promedio'] = $promedio; 

    header("Location:homeUser.php");
?>