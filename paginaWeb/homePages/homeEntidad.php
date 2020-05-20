<?php
    session_start();
    $tipo = "Administrador de entidad";
    $idEntidad = $_SESSION['idEntidad'];
	$nombre = $_SESSION['nombre'];  
	$direccion = $_SESSION['direccion'];
    $correo = $_SESSION['correo'];
    
    $promedioEntidad = $_SESSION['promedioEntidad'];
	$cantidadExamenes = $_SESSION['cantidadExamenes'];
	$usuarios = $_SESSION['usuarios'];

    if ($nombre=="") {
        header("Location:../index.html");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="css/estilosPack2.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script> 
    <script src="js/bootstrap.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-vue/2.13.0/bootstrap-vue.js"></script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet"> 
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript" src="js/scriptsVerificacion.js"></script>
    <link rel="stylesheet" href="css/estiloSlider.css">
    <link rel="stylesheet" href="css/estilosHome.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Home</title>
</head>
<body class="gris">

	<!--Barra de navegacion-->
	<nav class="navbar sticky-top navbar-dark bg-dark" href="../index.html">
		<a class="navbar-brand" href="../index.html">
			<img src="svg/mundo-verde.svg" width="50" height="50" class="d-inline-block" alt="">
			iFootprint
			<small class="text-muted">PRO</small>
        </a>
        <form class="form-inline" action="cerrarSesion.php">
			<button class="btn btn-danger" type="submit"><i class="fas fa-door-open"></i> Cerrar sesión</button>
			</div>
		</form>
	</nav>
<div id="appVue" class="padreHome">


<div class="jumbotron">
    <h1>{{ nombre }} <span class="badge badge-secondary"><i class="fas fa-users"></i> Entidad nueva</span></h1>
    <div v-if="hayOrganizacion">
    <h4><span class="badge badge-success"><i class="fas fa-university"></i> {{ organizacion }}</span></h4>
    </div>
    <hr class="my-4">
    <small class="text-muted">Ver datos de la organización</small><br>
    <label class="switch">
        <input type="checkbox"
        v-model="conCorreo">
        <span class="slider round"></span>
    </label>
    <div v-if="conCorreo">
        <div class="alert alert-secondary" role="alert">
            <h4>{{ nombre }}</h4>
            <small>{{ tipoUsuario }}</small><br>
            <strong>Dirección: </strong> {{ direccion }}<br>
            <strong>Correo electrónico: </strong> {{ correo }}<br>
        </div> 
    </div>
    
    <hr class="my-4">
    <div class="alert alert-primary" role="alert"><center>
            <p><strong><i class="fas fa-exclamation-triangle"></i> Código de la organización:</strong>
             <h4> {{ idEntidad }} </h4>
                <small class="text-muted">Recuerda compartir este código con las personas de tu entidad</small> </center>
    </div>   
</div>
    <div class="alert alert-danger" role="alert"><center>
        <p><strong><i class="fas fa-biohazard"></i> Promedio de huella de carbono en {{ nombre }}:</strong>
        <h4> {{ promedio }} </h4>
    </div>

    <div class="alert alert-success" role="alert"><center>
        <p><strong><i class="fas fa-temperature-low"></i> Cantidad de examenes realizados en {{ nombre }}:</strong>
        <h4> {{ cantidad }} </h4>
    </div>

    <div class="alert alert-warning" role="alert"><center>
        <p><strong><i class="fas fa-hospital-user"></i> Usuarios adjuntados a la entidad {{ nombre }}:</strong>
        <h4> {{ usuarios }} </h4>
    </div>
    <center>
<button type="button" class="btn btn-warning" onclick="location.href='../php/actualizarDatos.php'"><i class="fas fa-cloud-upload-alt"></i><strong> Actualizar datos</strong></button>
</center>
</div>


</div>


        <!-- Script -->
        <script>
            const app = new Vue({
            el:'#appVue',
            data:{
                conCorreo: false         
            },
            computed: {
                noTieneCalculos() {

                },
                nombre() {
                    return "<?php echo $nombre; ?>";
                },
                correo() {
                    return "<?php echo $correo; ?>";
                },
                tipoUsuario() {
                    return "<?php echo $tipo; ?>";
                },
                idEntidad() {
                    return "<?php echo $idEntidad; ?>";
                },
                direccion() {
                    return "<?php echo $direccion; ?>";
                },
                promedio() {
                    return "<?php echo $promedioEntidad; ?>";
                },
                cantidad() {
                    return "<?php echo $cantidadExamenes; ?>";
                },
                usuarios() {
                    return "<?php echo $usuarios; ?>";
                }
            },
            methods:{
                
            }
            })
        </script>

</body>
</html>