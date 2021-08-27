<?php
include './app/config.inc.php';
include './app/Conexion.inc.php';
include './app/RepositorioUsuario.inc.php';
include_once './app/ValidadorLogin.inc.php';
if(isset($_POST['login'])){// conprueba que el usaurio a preciodado el boton de iniciar seccion del formulario de login 
//si lo preciono ejecutate
     Conexion::abrir_conexion();
    $validador = new ValidadorLogin($_POST['email'],$_POST['clave'], Conexion::obtener_conexion());
    
    if($validador-> obtener_error() === '' && !is_null($validador->obtener_usuario())){ // si obtener error es igual a vacio 
    // es decir que no a habido ningun error Y 
    //SI EL usuario usuario NO ES NULO ejecutate
        //INICIAR SECCION
        //REDIRIGIR A INDEX
        echo 'Inicio de Seccion ok';
    }else{
        echo 'Inicio de Seccion fallo';
    }
        
    Conexion::cerrar_conexion();
        
        
}

$titulo = 'login';

include './plantillas/documento-declaracion.inc.php';
include_once './plantillas/navbar.inc.php';

?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <!--dejar vacia esta columna va a espaciaar tres columnas de lo que vallamos a hacer-->
        </div>
        <div class="col-md-6">
           <!--de ESTAFORMA  DE PONER LAS COLUNNAS COL-MD-3 Y COL-MD-6 TENDREMOS TODO EL FORMULARIO CENTRADO Y NO OCUOARA TODO-->
           <div class="panel panel-default">
               <div class="panel-heading text-center">
                   <h4>Iniciar Seccion</h4>
               </div>
               <div class="panel-body">
                   <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" >
                       <!--role="role" le indica a bootrap que esto es un formulario tipo bootstrap,
                       Y PHP_SELF INDICA QUE MANDAREMOS LA INFORMACION DEL FORMULARIO A ESTE MISMA PAGINA LOGIN.PHP -->
                       <h2>Introduce tus datos</h2>
                       <br>
                       <!--ESTE LABEL SOLO SERA VISIBLE PARA dispositivos para INVIDENTES gracias a la clase sr-only-->
                       <label for="email" class="sr-only">Email</label>
                       <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                             <?php
                             if(isset($_POST['login']) && isset($_POST['email']) && !empty($_POST['email'])){ // si el usuario 
                             //a pulsado el boton de login Y SI esta puesto 
                             //el campo email es decir esta iniciado  y si el campo email no esta vacio ejecutate
                                 echo 'value="' . $_POST['email'] . '"'; // asi evitamos que se borre lo que alla
                                 // escrito nuestro usuario
                             }
                             ?> 
                              required autofocus  >
                       <!--requiered significa que el campo es obligatorio de llenar y autofocus sicnifica 
                       que cuando carquemos la pagina ese campo estara activo sin tener que hacer click en el -->
                       <br>
                       <!--ESTE LABEL SOLO SERA VISIBLE PARA dispositivos para INVIDENTES gracias a la clase sr-only-->
                       <label for="email" class="sr-only">Contraseña</label>
                       <input type="password" name="clave" id="clave" class="form-control" placeholder="Contraseña" required  >
                       <br>
                       <?php
                        if(isset($_POST['login'])){ // si el usuario le a dado al boton de login  ejecutate
                            $validador -> mostrar_error(); // si no existe error es decir esta vacio el error inicia seccion
                        }
                       ?>
                       <button type="submit" name="login" class="btn btn-lg btn-block">
                           <!--btn-lg es para que el boton sea grande y btn-block es 
                           para que sea ams grande tipobloque , no ponemos el btn-primary porque eso pone el
                           boton de color  azul -->
                           Iniciar Seccion
                       </button>
                   </form>
                   <br>
                   <br>
                   <div class="text-center">
                       <a href="#">¿Olvidaste tu Contraseña?</a>
                   </div>
               </div>
           </div>
        </div>
    </div>
</div>





