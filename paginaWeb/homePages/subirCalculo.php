<?php
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

    if ($nombre=="") {
        header("Location:../index.html");
    }

    $huellaTotal = $_POST['huella'];

    require("../php/conexion.php");

    $consulta = "SELECT `idInformes`, `sumatoria`, `promedio`, `cantidad` FROM `informes` WHERE 1";
    $resultado = mysqli_query($conexion, $consulta) or die (mysqli_error($conexion));
    while ($columna = mysqli_fetch_array( $resultado )) {
        if ($columna['idInformes']==$usuario) {
            $nuevaSumatoria = $columna['sumatoria']+$huellaTotal;
            $cantidadNueva = $columna['cantidad']+1;
            $promedioNuevo = ($nuevaSumatoria)/$cantidadNueva;
        }
    }

    $consultaInsertar = "UPDATE `informes` 
    SET `sumatoria`='$nuevaSumatoria',`promedio`='$promedioNuevo',`cantidad`='$cantidadNueva' 
    WHERE idInformes = '$usuario'";
    $resultado = mysqli_query($conexion, $consultaInsertar) or die (mysqli_error($conexion));

    $consultaSesion = "SELECT * FROM `informes`";
    $resultado = mysqli_query($conexion, $consultaSesion) or die (mysqli_error($conexion));
    while ($columna = mysqli_fetch_array( $resultado )) {
        if ($columna['idInformes']==$usuario) {
            $_SESSION['cantidad'] = $columna['cantidad'];
            $_SESSION['sumatoria'] = $columna['sumatoria'];
            $_SESSION['promedio'] = $columna['promedio'];
        }
    }

    header("Location:homeUser.php");
?>