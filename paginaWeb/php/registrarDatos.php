<?php
require("conexion.php");

$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$edad = $_POST['edad'];
$telefono = $_POST['telefono'];

$consulta = "SELECT * FROM `usuario`";
$resultado = mysqli_query($conexion, $consulta);
while ($columna = mysqli_fetch_array( $resultado )) {
    if ($columna['usuario']==$usuario || $columna['correo']==$correo) {
        header("Location:errorRepetido.html");
    }
}

$consulta = "INSERT INTO `usuario`
(`usuario`, `contraseña`, `nombres`, `apellidos`, `edad`, `correo`, `telefono`) 
VALUES ('$usuario','$contraseña','$nombre','$apellidos','$edad','$correo','$telefono')";
if (mysqli_query($conexion, $consulta)) {
    $consultaCalculos = "INSERT INTO `informes`(`idInformes`, `sumatoria`, `promedio`, `cantidad`) 
    VALUES ('$usuario',0,0,0)";
    mysqli_query($conexion, $consultaCalculos);
    header("Location:../confirmacionRegistro.html");
} else {
    header("Location:../errorRegistro.html");
}
?>