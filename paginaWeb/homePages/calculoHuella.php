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
    $nombreEntidad = $_SESSION['nombreEntidad'];

    if ($nombre=="") {
        header("Location:../index.html");
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
    <title>Calculadora</title>
</head>
<body class="gris">

	<!--Barra de navegacion-->
	<nav class="navbar sticky-top navbar-dark bg-dark" href="../index.html">
		<a class="navbar-brand" href="../index.html">
			<img src="../svg/mundo-verde.svg" width="50" height="50" class="d-inline-block" alt="">
			iFootprint
			<small class="text-muted">PRO</small>
        </a>
        <form class="form-inline" action="../php/cerrarSesion.php">
			<button class="btn btn-danger" type="submit"><i class="fas fa-door-open"></i> Cerrar sesión</button>
			</div>
		</form>
	</nav>
<div id="appVue" class="padreHome">
    <div class="calculadora ">
<div class="calculadora jumbotron">
    <center>
        <p class="display-4">Calculadora de Huella de carbono</p>
        <div class="alert alert-success" role="alert">
        La huella de carbono es un indicador ambiental que se expresa en las <strong>toneladas de CO2</strong>, buscando expresar la cantidad de gases efecto invernadero que emiten las actividades de cada ser humano. 
        </div>
        <hr class="my-4">
        <h3>El impacto ambiental que generas es de: <span class="badge badge-warning"> {{ huellaTotal }} </span> <small>Toneladas de CO2</small> </h3>
        <hr class="my-4">   
    </center>
    <center>
    <b-form @submit="checkForm" action="subirCalculo.php" method="post" novalidate="true"
    v-on:submit.prevent="checkForm" name="formRegistro">
    <!-- Pregunta 1 --> 
    <p class="lead">¿Usas autobuses para movilizarte?</p>
        <label class="switch">  
            <input type="checkbox"
            v-model="usarBus">
            <span class="slider round"></span>
        </label>
    <div class="form-group" v-if="usarBus">
        <div class="alert alert-secondary" role="alert">        
        <small>
            <p>¿Cuántos dias a la semana? <strong>{{ diasBus }}</strong> </p>              
        </small>
            <input 
            type="range" 
            id="diasBus" 
            v-model="diasBus" 
            name="diasBus"
            max=7>
            </input>
        <div v-if="diasBus!=0">
        <small>
            <p>¿Cuántas horas al dia? <strong>{{ horasBus }}</strong> </p>              
        </small>
            <input 
            type="range" 
            id="horasBus" 
            v-model="horasBus" 
            name="horasBus"
            max=24>
            </input>
        </div>
    </div>
    </div>

    <!-- Pregunta 2 --> 
    <p class="lead">¿Consumes carne de res?</p>
        <label class="switch">  
            <input type="checkbox"
            v-model="comerCarne">
            <span class="slider round"></span>
        </label>
    <div class="form-group" v-if="comerCarne">
        <div class="alert alert-secondary" role="alert">        
        <small>
            <p>¿Cuántos dias a la semana? <strong>{{ diasCarne }}</strong> </p>              
        </small>
            <input 
            type="range" 
            id="diasCarne" 
            v-model="diasCarne" 
            name="diasCarne"
            max=7>
            </input>        
    </div>
    </div>
        
    </div>
    </div>
    </b-form>
    </center>


</div>
</div>
</div>


        <!-- Script -->
        <script>
            const app = new Vue({
            el:'#appVue',
            data:{
                usarBus: false,
                diasBus: 0,
                horasBus: 0,
                comerCarne: false,
                diasCarne: 0
            },
            computed: {
                huellaTotal() {
                    huella = 0;
                    if (this.usarBus) {
                        huella = huella + 0.2*this.diasBus + 0.2*this.horasBus;
                    }
                    if (this.comerCarne) {
                        huella = huella + 2.9*this.diasCarne;
                    }
                    huella = huella.toFixed(2);
                    return huella;
                }
            },
            methods:{
                
            }
            })
        </script>

</body>
</html>