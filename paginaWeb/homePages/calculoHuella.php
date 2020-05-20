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

    <!-- Pregunta 3 --> 
    <p class="lead">¿Usas gas natural?</p>
        <label class="switch">  
            <input type="checkbox"
            v-model="usarGas">
            <span class="slider round"></span>
        </label>
    <div class="form-group" v-if="usarGas">
        <div class="alert alert-secondary" role="alert">        
        <small>
            <p>¿Cuál es tu consumo mensual en unities? <strong>{{ gas }}</strong> </p>              
        </small>
            <input 
            type="range" 
            id="gas" 
            v-model="gas" 
            name="gas"
            max=40>
            </input>        
    </div>
    </div>

    <!-- Pregunta 4 --> 
    <p class="lead">¿Usas energía eléctrica?</p>
        <label class="switch">  
            <input type="checkbox"
            v-model="usarElectricidad">
            <span class="slider round"></span>
        </label>
    <div class="form-group" v-if="usarElectricidad">
        <div class="alert alert-secondary" role="alert">        
        <small>
            <p>¿Cuál es tu consumo mensual en kWh? <strong>{{ electricidad }}</strong> </p>              
        </small>
            <input 
            type="range" 
            id="electricidad" 
            v-model="electricidad" 
            name="electricidad"
            max=40>
            </input>        
    </div>
    </div>

    <!-- Pregunta 5 --> 
    <p class="lead">¿Realizas viajes en avión?</p>
        <label class="switch">  
            <input type="checkbox"
            v-model="usarAvion">
            <span class="slider round"></span>
        </label>
    <div class="form-group" v-if="usarAvion">
        <div class="alert alert-secondary" role="alert">        
        <small>
            <p>¿Cuántos vuelos nacionales has hecho el último año? <strong>{{ vNacional }}</strong> </p>              
        </small>
            <input 
            type="range" 
            id="vNacional" 
            v-model="vNacional" 
            name="vNacional"
            max=20>
            </input>              
        <small>
            <p>¿Cuántos vuelos hacia Europa has hecho el último año? <strong>{{ vEuropa }}</strong> </p>              
        </small>
            <input 
            type="range" 
            id="vEuropa" 
            v-model="vEuropa" 
            name="vEuropa"
            max=20>
            </input>             
        <small>
            <p>¿Cuántos vuelos hacia Sudamérica has hecho el último año? <strong>{{ vAmerica }}</strong> </p>              
        </small>
            <input 
            type="range" 
            id="vAmerica" 
            v-model="vAmerica" 
            name="vAmerica"
            max=20>
            </input>               
        <small>
            <p>¿Cuántos vuelos hacia EEUU has hecho el último año? <strong>{{ vEEUU }}</strong> </p>              
        </small>
            <input 
            type="range" 
            id="vEEUU" 
            v-model="vEEUU" 
            name="vEEUU"
            max=20>
            </input>
    </div>
        
    </div>
    <hr class="my-4">
        <h3>Resultado final<h3>
        <span class="badge badge-warning"> {{ huellaTotal }} </span> <small>Toneladas de CO2</small>
        <hr class="my-4">
        <button type="submit" class="btn btn-success btn-block"><i class="fas fa-cloud-upload-alt"></i> Guardar resultado</button> 
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
                diasCarne: 0,
                usarGas: false,
                gas: 0,
                usarElectricidad: false,
                electricidad: 0,
                usarAvion: false,
                vNacional: 0,
                vEuropa: 0,
                vAmerica: 0,
                vEEUU: 0
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
                    if (this.usarGas && this.gas>=10) {
                        huella = huella + (0.3*this.gas)/10;
                    }
                    if (this.electricidad && this.electricidad>=10) {
                        huella = huella + (0.2*this.electricidad)/100;
                    }
                    if (this.usarAvion) {
                        huella = huella 
                        + 1*this.vNacional 
                        + 1.5*this.vEuropa 
                        + 0.5*this.vAmerica
                        + 0.8*this.vEEUU;
                    }
                    huella = huella.toFixed(2);
                    return huella;
                }
            },
            methods:{
                checkForm:function(e) {
                    hayError = false;
                    if(this.usarBus && this.diasBus==0 || this.usarBus && this.horasBus==0){
                        hayError = true;
                    }
                    if(this.comerCarne && this.diasCarne==0){
                        hayError = true;
                    }
                    if(this.usarGas && this.gas==0){
                        hayError = true;
                    }
                    if(this.usarElectricidad && this.electricidad==0){
                        hayError = true;
                    }
                    if(this.usarAvion && this.vNacional==0 || this.usarAvion && this.vEuropa==0 || this.usarAvion && this.vAmerica==0 || this.usarAvion && this.vEEUU==0){
                        hayError = true;
                    }
                    if (!hayError){
                        document.formRegistro.submit();
                    } else {
                        Swal.fire({
                        icon: 'error',
                        title: 'Datos erroneos',
                        text: '¿Has afirmado que usas un servicio? Entonces no puedes dejar su cantidad en cero. Revisa tus respuestas e intentalo de nuevo'
                        })
                    }
                }
            }
            })
        </script>

</body>
</html>