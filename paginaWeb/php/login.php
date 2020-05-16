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
$claveCorrecta = false;
while ($columna = mysqli_fetch_array( $resultado ))
{
	if ($columna['correo']==$correo) {
		$usuarioEncontrado = true;
		if ($columna['contraseña']==$contraseña) {
			$tipoUsuario = $columna['tipoDeUsuario'];
			$nombre = $columna['nombres'];
			$claveCorrecta = true;
			}
        }
    if ($columna['usuario']==$usuario) {
		$usuarioEncontrado = true;
		if ($columna['contraseña']==$contraseña) {
			$tipoUsuario = $columna['tipoDeUsuario'];
			$nombre = $columna['nombres'];
			$claveCorrecta = true;		
			}
        }
        
}

if ($usuarioEncontrado && $claveCorrecta) {
    session_start();
    $_SESSION['nombre'] = $nombre;
    $_SESSION['usuario'] = $usuario;
    $_SESSION['tipoUsuario'] = $tipoUsuario;
	switch ($tipoUsuario) {
		case 1:
			header("Location:../home/homeAdmin.html");
			break;
		case 2:
			header("Location:../home/homeUser.html");
			break;
	}
} else{
	header("Location:../errorLogin.html");
}
?>