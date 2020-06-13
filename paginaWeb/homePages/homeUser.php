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

    $cantidad = $_SESSION['cantidad'];
    $promedio = $_SESSION['promedio'];
    $sumatoria = $_SESSION['sumatoria'];

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
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script> 
    <script src="../js/bootstrap.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-vue/2.13.0/bootstrap-vue.js"></script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet"> 
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript" src="../js/scriptsVerificacion.js"></script>
    <link rel="stylesheet" href="../css/estiloSlider.css">
    <link rel="stylesheet" href="../css/estilosHome.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Home</title>
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

<div width="300" height="300">

</div>

</div>

<script>

</script>

<div id="appVue" class="padreHome container-fluid">
    <div class="row">
        <div class="col-4 jumbotron home">
            <h1>{{ nombre }} <span class="badge badge-secondary"><i class="fas fa-users"></i> Usuario nuevo</span></h1>
            <h3 v-show="haHechoExamen">Promedio de huella de carbono: <span class="badge badge-warning"><i class="fas fa-biohazard"></i> {{ promedio }}</span></h3>
            <div v-if="hayOrganizacion">
                <h4><span class="badge badge-success"><i class="fas fa-university"></i> {{ organizacion }}</span></h4>
            </div>
            <div v-else>
            <form action="../php/ingresarEntidad.php" method="POST">
                {{ organizacion }}
            No perteneces a ninguna organización.<br>
            <input type="text" placeholder="Código de entidad" required="true" name="codigo">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-sign-in-alt"></i> Unirme ahora</button>
            </form>
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
            <div class="alert alert-success" role="alert" v-if="haHechoExamen">
                <center>
                <i class="fas fa-question-circle"></i> ¿Quieres realizar otro examen? <br> <br> 
                <button type="button" class="btn btn-success" onclick="location.href='calculoHuella.php'"><i class="fas fa-feather-alt"></i>  Realizar otro examen</button>
                </center>
            </div>
            <div class="alert alert-success" role="alert" v-else>
                <center>
                <i class="fas fa-question-circle"></i> ¡Vaya! <strong>Detectamos que aún no has realizado tu primer examen<br><br>
                <button type="button" class="btn btn-success" onclick="location.href='calculoHuella.php'"><i class="fas fa-feather-alt"></i> Realizar mi primer examen</button>
                </center>
            </div>
            <div class="alert alert-danger" role="alert" v-if="haHechoExamen"><center>
                <p><strong><i class="fas fa-biohazard"></i> Cantidad de examenes hechos:</strong>
                <h4> {{ cantidad }} </h4>
            </div>
            <div class="alert alert-warning" role="alert" v-if="haHechoExamen"><center>
                <p><strong><i class="fas fa-temperature-low"></i> Promedio de huela de carbono:</strong>
                <h4> {{ promedio }} toneladas de CO2</h4>
            </div>
        </div>
        <div class="col-7 jumbotron informe" v-show="haHechoExamen">
            <h1>Historial de calculos</h1>
            <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                <th>Fecha</th>
                <th>Resultado</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="examen in examenes">
                    <td>{{ examen.fecha }}</td>
                    <td>{{ examen.resultado }}</td>
                </tr>                
            </tbody>
            </table>
            <canvas id="myChart" width="500" height="500"></canvas>
        </div>
    </div>
</div>


</div>



        <!-- Script -->
        <script>
            const app = new Vue({
            el:'#appVue',
            data:{
                conCorreo: false,
                examenes: [],
                labels: [],             
            },
            mounted () {
                axios
                .get('obtenerCalculos.php')
                .then(response => (
                    this.examenes = response.data;
                    this.labels.push('Naranja'); 
                    ))
            },
            computed: {
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
                    return "<?php echo $nombreEntidad; ?>";
                },
                hayOrganizacion() {
                    return "<?php echo $nombreEntidad; ?>"!="";
                },
                haHechoExamen() {
                    return "<?php echo $cantidad; ?>"!=0;
                },
                cantidad() {
                    return "<?php echo $cantidad; ?>";
                },
                promedio() {
                    return "<?php echo $promedio; ?>";
                }
            },
            methods:{
                
            }
            })

            var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
        </script>

</body>
</html>