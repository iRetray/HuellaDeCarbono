<?php
require("conexion.php");

$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$nombre = $_POST['usuario'];
$direccion = $_POST['direccion'];

$consulta = "SELECT * FROM `entidad`";
$resultado = mysqli_query($conexion, $consulta);
while ($columna = mysqli_fetch_array( $resultado )) {
    if ($columna['nombre']==$nombre || $columna['correo']==$correo) {
        header("Location:../errores/errorRepetido.html");
    }
}

function hexadecimalAzar($caracteres){
    $caracteresPosibles = "0123456789abcdef";
    $azar = '';
    for($i=0; $i<$caracteres; $i++){
        $azar .= $caracteresPosibles[rand(0,strlen($caracteresPosibles)-1)];
    }
    return $azar;
}

$idHexa = hexadecimalAzar(8);

$consulta = "INSERT INTO `entidad`(`idEntidad`, `nombre`, `direccion`, `correo`, `clave`) 
VALUES ('$idHexa','$nombre','$direccion','$correo','$contraseña')";
if (mysqli_query($conexion, $consulta)) {
    header("Location:../confirmacionRegistro.html");
} else {
    header("Location:../errores/errorRegistro.html");
}
?>