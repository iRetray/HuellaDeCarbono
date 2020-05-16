<?php
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
while ($columna = mysqli_fetch_array( $resultado ))
{
	if ($columna['correo']==$correoLogin) {
		$usuarioEncontrado = true;
		if ($columna['contraseña']==$contraseña) {
			$tipoUsuario = $columna['tipoDeUsuario'];
			$nombre = $columna['nombres'];
			$apellido = $columna['apellidos'];
			$edad = $columna['edad'];
			$correo = $columna['correo'];
			$telefono = $columna['telefono'];
			$entidad = $columna['entidad'];
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
			$entidad = $columna['entidad'];
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
	$_SESSION['entidad'] = $entidad;

	switch ($tipoUsuario) {
		case 1:
			header("Location:../homeAdmin.php");
			break;
		case 0:
			header("Location:../homeUser.php");
			break;
	}
} else{
	header("Location:../errorLogin.html");
}
?>