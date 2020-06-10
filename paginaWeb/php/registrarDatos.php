<?php
ob_start();
require("conexion.php");
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$edad = $_POST['edad'];
$telefono = $_POST['telefono'];
$usuarioRepetido = false;
$consulta = "SELECT * FROM `usuario`";
$resultado = mysqli_query($conexion, $consulta);
while ($columna = mysqli_fetch_array( $resultado )) {
    if ($columna['usuario']==$usuario or $columna['correo']==$correo) {
        $usuarioRepetido = true;      
    }
}
$vacio = "";
if ($usuarioRepetido==1) {
    header("Location:../errores/errorRepetido.html");
} else {
    $consulta = "INSERT INTO `usuario`
    (`usuario`, `contraseña`, `nombres`, `apellidos`, `edad`, `correo`, `telefono`, `entidad`, `nombreEntidad`) 
    VALUES ('$usuario','$contraseña','$nombre','$apellidos','$edad','$correo','$telefono','$vacio','$vacio')";
    $resultadoIngreso = mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
    if ($resultadoIngreso) {
        header("Location:../confirmacionRegistro.html");
    } else {
        header("Location:../errores/errorRegistro.html");
    }
}
?>