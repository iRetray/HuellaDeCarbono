<?php
require("conexion.php");

$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
$adminCode = $_POST['adminCode'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$edad = $_POST['edad'];
$telefono = $_POST['telefono'];

if($adminCode=="12d68c") {
    $tipoUsuario = "1";
} else {
    $tipoUsuario = "0";
}

$consulta = "INSERT INTO `usuario`
(`usuario`, `contraseña`, `tipoDeUsuario`, `nombres`, `apellidos`, `edad`, `correo`, `telefono`) 
VALUES ('$usuario','$contraseña','$tipoUsuario','$nombre','$apellidos','$edad','$correo','$telefono')";
if (mysqli_query($conexion, $consulta)) {
    $consultaCalculos = "INSERT INTO `informes`(`idInformes`, `sumatoria`, `promedio`, `cantidad`) 
    VALUES ('$usuario',0,0,0)";
    mysqli_query($conexion, $consultaCalculos);
    header("Location:../confirmacionRegistro.html");
} else {
    header("Location:../errorRegistro.html");
}
?>