<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    session_start();
    $nombre = $_SESSION['nombre'];  
    $usuario = $_SESSION['usuario'];
    $tipoUsuario = $_SESSION['tipoUsuario'];
    if ($tipoUsuario==1) {
        $tipo = "Administrador de entidad";
    } else {
        $tipo = "Usuario standard";
    }
    
	$apellido = $_SESSION['apellido'];
	$edad = $_SESSION['edad'];
	$correo = $_SESSION['correo'];
    $telefono = $_SESSION['telefono'];

    if ($nombre=="") {
        header("Location:../index.html");
    }

    $codigo = $_POST['codigo'];
    require("conexion.php");
    $consulta = "SELECT * FROM `entidad`";
    $resultado = mysqli_query($conexion, $consulta);

    $codigoCorrecto = false;
    $nombreEntidad = "";
    while ($columna = @mysqli_fetch_array($resultado)) {
	if ($columna['idEntidad']==$codigo) {
            $codigoCorrecto = true;
            $nombreEntidad = $columna['nombre'];
            $consultaIngreso = "UPDATE `usuario` SET `entidad`='$codigo', `nombreEntidad`='$nombreEntidad'
            WHERE `correo`='$correo'";
            $resultado = mysqli_query($conexion, $consultaIngreso) or die(mysqli_error($conexion));
            $_SESSION['nombreEntidad'] = $nombreEntidad;
        }        
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/estilos.css">
	<link rel="stylesheet" href="../css/estilosPack2.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script> 
    <script src="../js/bootstrap.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-vue/2.13.0/bootstrap-vue.js"></script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet"> 
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript" src="../js/scriptsVerificacion.js"></script>
    <link rel="stylesheet" href="../css/estiloSlider.css">
    <link rel="stylesheet" href="../css/estilosHome.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Ingresar Entidad</title>
</head>
<body class="gris" onload="mensaje();">

	<!--Barra de navegacion-->
	<nav class="navbar sticky-top navbar-dark bg-dark" href="index.html">
		<a class="navbar-brand" href="index.html">
			<img src="../svg/mundo-verde.svg" width="50" height="50" class="d-inline-block" alt="">
			iFootprint
			<small class="text-muted">PRO</small>
        </a>
        <form class="form-inline" action="cerrarSesion.php">
			<button class="btn btn-danger" type="submit"><i class="fas fa-door-open"></i> Cerrar sesión</button>
			</div>
		</form>
	</nav>
<div id="appVue" class="padreHome">


<div class="formularioPadre">
		<div class="jumbotron formulario">
			<center>
                <p class="display-4" v-if="codigoEncontrado">Ahora puedes volver a tu inicio para revisar los cambios hechos.</p>
                <p class="display-4" v-else>Intenta ingresar el código de tu entidad de nuevo.</p>
                <br>
                <button class="btn btn-warning btn-lg btn-block"
                onclick="location.href='../homePages/homeUser.php'"><i class="fas fa-home"></i> Volver al Home</button>
			</center>
		</div>
	</div>

<script>
    function mensaje() {
        if ("<?php echo $codigoCorrecto; ?>") {
            Swal.fire({
            title: 'Entidad conectada',
            icon: 'success',
            html:
                'Ahora perteneces a la entidad '+
                '<?php echo $nombreEntidad; ?>'+
                ', tus resultados podrán ser monitoreados por tu organización.',
            showCloseButton: true,
            focusConfirm: false,
            confirmButtonText:
                'OK'
            })
        } else {
            Swal.fire({
            title: 'Código incorrecto',
            icon: 'error',
            html:
                'EL código que ingresaste es incorrecto'+
                ', vuelve a tu plataforma e intentalo de nuevo.',
            showCloseButton: true,
            focusConfirm: false,
            confirmButtonText:
                'OK'
            })
        }
    }
</script>


        <!-- Script -->
        <script>
            const app = new Vue({
            el:'#appVue',
            data:{
                codigo: null               
            },
            computed: {
                codigoEncontrado() {
                    return "<?php echo $codigoCorrecto; ?>";
                }
            },
            methods:{
                
            }
            })
        </script>

</body>
</html>