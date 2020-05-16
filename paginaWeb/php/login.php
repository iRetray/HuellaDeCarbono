<?php
require("conexion.php");

$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

$consulta = "SELECT * FROM `usuario`";
$resultado = mysqli_query($conexion, $consulta);
$tipoUsuario = "";
$nombre = "";
$usuarioEncontrado = false;
while ($columna = mysqli_fetch_array( $resultado ))
{
	if ($columna['correo']==$correo) {
		if ($columna['contraseña']==$contraseña) {
			$tipoUsuario = $columna['tipoDeUsuario'];
			$nombre = $columna['nombres'];
			$usuarioEncontrado = true;
			}
        }
    if ($columna['usuario']==$usuario) {
		if ($columna['contraseña']==$contraseña) {
			$tipoUsuario = $columna['tipoDeUsuario'];
			$nombre = $columna['nombres'];
			$usuarioEncontrado = true;
			}
        }
        
}

if ($usuarioEncontrado) {
    session_start();
    $_SESSION['nombre'] = $nombre;
    $_SESSION['usuario'] = $usuario;
    $_SESSION['tipoUsuario'] = $tipoUsuario;
	switch ($tipoUsuario) {
		case 1:
			header("Location:../home/homeAdmin.php");
			break;
		case 2:
			header("Location:../home/homeUser.php");
			break;
	}
} else {
	header("Location:../errorLogin.html");
}
?>