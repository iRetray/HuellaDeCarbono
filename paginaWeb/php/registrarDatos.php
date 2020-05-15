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

echo ($correo);
echo ($usuario);
echo ($contraseña);
echo ($adminCode);
echo ($nombre);
echo ($apellidos);
echo ($edad);
echo ($telefono);

?>