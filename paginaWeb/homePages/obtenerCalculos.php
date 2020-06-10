<?php
require("../php/conexion.php");
$consulta = "SELECT * FROM `informes` WHERE `idInformes`='TheRetray'";
$resultado = mysqli_query($conexion, $consulta) or die (mysqli_error($conexion));
$rawdata = array();
$i=0;
while($row = mysqli_fetch_array($resultado))
    {
        $rawdata[$i] = $row;
        $i++;
    }  
$conversionJSON = json_encode($rawdata);
echo($conversionJSON);
?>