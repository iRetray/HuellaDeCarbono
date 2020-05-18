<?php
    session_start();
    $tipo = "Administrador de entidad";
    $idEntidad = $_SESSION['idEntidad'];
	$nombre = $_SESSION['nombre'];  
	$direccion = $_SESSION['direccion'];
    $correo = $_SESSION['correo'];
    
    $promedioEntidad = $_SESSION['promedioEntidad'];
	$cantidadExamenes = $_SESSION['cantidadExamenes'];
	$usuarios = $_SESSION['usuarios'];

    if ($nombre=="") {
        header("Location:index.html");
    }

    require("php/conexion.php");

    $promedioEntidad = 0;
	$cantidadExamenes = 0;
	$usuarios = 0;

	$consulta = "SELECT * FROM `usuario`";
	$resultado = mysqli_query($conexion, $consulta);
	while ($columna = mysqli_fetch_array( $resultado )) { 
		if ($columna['entidad']==$idEntidad) {
			$usuarioEncontrado = $columna['usuario'];
			$subConsulta = "SELECT * FROM `informes`";
			$subresultado = mysqli_query($conexion, $subConsulta);
			while ($subcolumna = mysqli_fetch_array( $subresultado )) {
				if ($subcolumna['idInformes']==$usuarioEncontrado) {
					$promedioEntidad = $promedioEntidad + $subcolumna['promedio'];
					$usuarios = $usuarios+1;
					$cantidadExamenes = $cantidadExamenes + $subcolumna['cantidad'];
				}
			}
		}
	}

	if ($usuarios==0) {
		$promedioEntidad = 0;
	} else {
		$promedioEntidad = $promedioEntidad / $usuarios;
	}
	
	

	$_SESSION['promedioEntidad'] = $promedioEntidad;
	$_SESSION['cantidadExamenes'] = $cantidadExamenes;
	$_SESSION['usuarios'] = $usuarios;
	header("Location:homeEntidad.php");
?>