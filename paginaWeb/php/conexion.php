<?php
$servidor = "localhost";
$usuarioBD = "id13717416_root";
$contraseña = "Zop6/c]^SG2Uf#Bm";
$baseDeDatos = "id13717416_footprint";
$conexion = mysqli_connect($servidor, $usuarioBD, $contraseña, $baseDeDatos) or die ("La conexion al servidor no fue establecida");
$db = mysqli_select_db($conexion,$baseDeDatos) or die ("No se logro conectar a la base de datos");
?>