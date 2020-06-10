<?php
ob_start();
require("conexion.php");
$correoLogin = $_POST['correo'];
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
$consulta = "SELECT * FROM `usuario`";
$resultado = mysqli_query($conexion, $consulta);
$tipoUsuario = "";
$nombre = "";
$apellido = "";
$edad = "";
$correo = "";
$telefono = "";
$entidad = "";
$usuarioEncontrado = false;
$claveCorrecta = false;
while ($columna = mysqli_fetch_array( $resultado )){
	if ($columna['correo']==$correoLogin) {
		$usuarioEncontrado = true;
		if ($columna['contraseña']==$contraseña) {
			$tipoUsuario = $columna['tipoDeUsuario'];
			$nombre = $columna['nombres'];
			$apellido = $columna['apellidos'];
			$edad = $columna['edad'];
			$correo = $columna['correo'];
			$telefono = $columna['telefono'];
			$nombreEntidad = $columna['nombreEntidad'];
			$claveCorrecta = true;
		}
    }
    if ($columna['usuario']==$usuario) {
		$usuarioEncontrado = true;
		if ($columna['contraseña']==$contraseña) {
			$tipoUsuario = $columna['tipoDeUsuario'];
			$nombre = $columna['nombres'];
			$apellido = $columna['apellidos'];
			$edad = $columna['edad'];
			$correo = $columna['correo'];
			$telefono = $columna['telefono'];
			$nombreEntidad = $columna['nombreEntidad'];
			$claveCorrecta = true;		
			}
        }       
}
if ($usuarioEncontrado && $claveCorrecta) {
    session_start();
    $_SESSION['nombre'] = $nombre;
    $_SESSION['usuario'] = $usuario;
	$_SESSION['tipoUsuario'] = $tipoUsuario;
	$_SESSION['apellido'] = $apellido;
	$_SESSION['edad'] = $edad;
	$_SESSION['correo'] = $correo;
	$_SESSION['telefono'] = $telefono;
	$_SESSION['nombreEntidad'] = $nombreEntidad;
	$consulta = "SELECT * FROM `informes`";
	$resultado = mysqli_query($conexion, $consulta);
	$cantidadCalculos = 0;
    $sumatoria = 0;

    while ($columna = mysqli_fetch_array( $resultado )) {
        if ($columna['idInformes']==$usuario) {
            $cantidadCalculos++;
            $sumatoria = $sumatoria+$columna['resultado'];
        }
    }

	$promedio = $sumatoria / $cantidadCalculos;
	
    $_SESSION['promedio'] = $promedio; 
	$_SESSION['cantidad'] = $cantidadCalculos;
	$_SESSION['sumatoria'] = $sumatoria;
	header("Location:../homePages/homeUser.php");
} else{
	header("Location:../errores/errorLogin.html");
}
?>