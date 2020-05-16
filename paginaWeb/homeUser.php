<?php
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
    $entidad = $_SESSION['entidad'];
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
	<nav class="navbar sticky-top navbar-dark bg-dark" href="index.html">
		<a class="navbar-brand" href="index.html">
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
    <h1>{{ nombre }} <span class="badge badge-secondary"><i class="fas fa-users"></i> Usuario nuevo</span></h1>
    <div v-if="hayOrganizacion">
        {{ organizacion }}
    </div>
    <div v-else>
        No perteneces a ninguna organización.
        <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-sign-in-alt"></i> Unirme ahora</button>
    </div>
    <hr class="my-4">
    <small class="text-muted">Ver mis datos personales</small><br>
    <label class="switch">
        <input type="checkbox"
        v-model="conCorreo">
        <span class="slider round"></span>
    </label>
    <div v-if="isChecked">
        <div class="alert alert-secondary" role="alert">
            <h4>{{ nombre }} {{ apellido }}</h4>
            <p v-if="hayOrganizacion"><i class="fas fa-university"></i> Organización: {{ organizacion }}</p>
            <p v-else><i class="fas fa-university"></i> Organización: Ninguna</p>
            
            <small>{{ tipoUsuario }}</small>
            <p><strong>Nombre de usuario: </strong> {{ usuario }}<br>
            <strong>Edad: </strong> {{ edad }}<br>
            <strong>Correo electrónico: </strong> {{ correo }}<br>
            <strong>Teléfono: </strong> {{ telefono }}</p>
        </div> 
    </div>
    
    <hr class="my-4">
    <p class="lead">Bienvenido! Esta es tu plataforma de inicio en <strong>iFootprint</strong></p>
    <div class="alert alert-primary" role="alert">
        <center>
    <i class="fas fa-exclamation-triangle"></i> Ahora podrás realizar <strong>calculos de tu huella de carbono</strong>, y estos quedarán guardados en tu <strong>historial</strong>.
    </center>    
</div>
    <div class="alert alert-success" role="alert">
        <center>
    <i class="fas fa-question-circle"></i> ¡Vaya! <strong>Detectamos que aún no has realizado tu primer examen<br><br>
    <button type="button" class="btn btn-success"><i class="fas fa-feather-alt"></i> Realizar mi primer examen</button>
    </center>
    </div>
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
                isChecked() {
                    return this.conCorreo;
                },
                nombre() {
                    return "<?php echo $nombre; ?>";
                },
                apellido() {
                    return "<?php echo $apellido; ?>";
                },
                usuario() {
                    return "<?php echo $usuario; ?>";
                },
                tipoUsuario() {
                    return "<?php echo $tipo; ?>";
                },
                edad() {
                    return "<?php echo $edad; ?>";
                },
                correo() {
                    return "<?php echo $correo; ?>";
                },
                telefono() {
                    return "<?php echo $telefono; ?>";
                },
                organizacion() {
                    return "<?php echo $entidad; ?>";
                },
                hayOrganizacion() {
                    return "<?php echo $entidad; ?>".lenght == 0;
                }
            },
            methods:{
                
            }
            })
        </script>

</body>
</html>