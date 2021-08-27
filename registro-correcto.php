<?php
include 'app/config.inc.php';
include_once './app/Conexion.inc.php';
include_once './app/RepositorioUsuario.inc.php';
include './app/Redireccion.inc.php';

if(isset($_GET['nombre']) && !empty($_GET['nombre']) ){ // 
//INVESTIGAR, si la varaible nombre esta iniciada y no esta vacia ejecutate
    $nombre = $_GET['nombre']; // imprimimos en pantalla lo que contenga el get nombre
    // la variable nombre se inicia cuando se poen en la url y se pone su valor 
//, si la varaible nombre  sesta iniciada y no esta vacia ejecutate
    
}else{
    Redireccion::redirigir(SERVIDOR);// SI no existe ninguna variable get de nombre lo devolvemos al index porque 
    //se supone que tiene que registrarse correctamente
}

// ES IMPOETANTE QUE LA REDIRECCION SIEMPRE ESTE ANTES DE CUALQUIER CODIGO HMTL PARA QUE FUNCIONE CORRECTAMENTE
$titulo='¡Registro correcto';
include_once './plantillas/documento-declaracion.inc.php';
include_once './plantillas/navbar.inc.php';


?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel panel-heading">
                    <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Registro Correcto
                </div>
                <div class="panel-body text-center">
                    <p><b>¡Gracias por Registrarte <?php echo $nombre; ?></b>!</p>
                    <br>
                    <p><a href="<?php echo RUTA_LOGIN; ?>">Iniciar Seccion</a> para comenzar a usar tu cuenta.</p>
                </div>
            </div>
        </div>
    </div>
</div>