<?php
require("conexion.php");

$correoLogin = $_POST['correo'];
$contraseña = $_POST['contraseña'];

$consulta = "SELECT * FROM `entidad`";
$resultado = mysqli_query($conexion, $consulta);
$idEntidad = "";
$nombre = "";
$direccion = "";
$correo = "";

$usuarioEncontrado = false;
$claveCorrecta = false;
while ($columna = mysqli_fetch_array( $resultado ))
{
	if ($columna['correo']==$correoLogin) {
		$usuarioEncontrado = true;
		if ($columna['clave']==$contraseña) {
			$idEntidad = $columna['idEntidad'];
			$nombre = $columna['nombre'];
			$direccion = $columna['direccion'];
			$correo = $columna['correo'];
			$claveCorrecta = true;
			}
        }        
}

if ($usuarioEncontrado && $claveCorrecta) {
	session_start();

	$_SESSION['idEntidad'] = $idEntidad;
	$_SESSION['nombre'] = $nombre;
	$_SESSION['direccion'] = $direccion;
	$_SESSION['correo'] = $correo;

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
	header("Location:../homeEntidad.php");

} else{
	header("Location:../errorLogin.html");
}
?>