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
    $tipoUsuario = "admin";
} else {
    $tipoUsuario = "user";
}

$consulta = "INSERT INTO `usuario`
(`contraseña`, `tipoDeUsuario`, `nombres`, `apellidos`, `edad`, `correo`, `telefono`) 
VALUES ('$contraseña','$tipoUsuario','$nombre','$apellidos','$edad','$correo','$telefono')";
if (mysqli_query($conexion, $consulta)) {
    echo ("Usuario registrado");
} else {
      echo "Error: " . $consulta . "<br>" . mysqli_error($conexion);
}
?>