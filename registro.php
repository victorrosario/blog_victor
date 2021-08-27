<?php
include_once './app/Conexion.inc.php';
include './app/Usuario.inc.php';
include_once './app/RepositorioUsuario.inc.php';
include_once './app/ValidadorRegistro.inc.php';
include_once './app/Redireccion.inc.php';
if(isset($_POST['enviar'])){ // si el boton de enviar es presionado en el formulario ejecutate y envia la informacion del formulario
    Conexion::abrir_conexion(); // abrimos conexion con la base de datos mysql
    $validador = new ValidadorRegistro($_POST['nombre'],$_POST['email'],$_POST['clave1'],$_POST['clave2'], Conexion::obtener_conexion()); 
    //// inicializamos 
    //el objeto $validador de tipo ValidadorRegistro
   //con esto validamos que los campos nombre email clave1 calve2 existan y no esten vacios
    //LE PASAMOS LA CONEXION CON L METODO statico obtener_conexion()

    if($validador->registro_valido()){ // si todo esta todo es correcto en el formulario osea si el registro es valido ejecutate
        $usuario = new Usuario('',$validador->obtener_nombre(),$validador->obtener_email(),
                password_hash($validador->obtener_clave(), PASSWORD_DEFAULT),'',''); 
        //// el primer '' es el id no se pone porque es automatico eñ segundo '' es la fecha 
        //no se pone porque es automatica y el tercer '' es activo no se pone porque al no indicar nada lo dejamos en false
        //CON ESTO YA HEMOS CREADO UN NUEVO USUARIO CON LA INFORAMCION QUE SE NOS A SUMINISTRADO EN EL FORMULARIO
        $usuario_insertado = RepositorioUsuario::insertar_usuario(Conexion::obtener_conexion(),$usuario);//insertamos los datos del usaurio
    // en mysql
    
        if($usuario_insertado){ // si usuario insertado devuelve true ejecutate y redirige al login
            //redirege a registro-correcto
            Redireccion::redirigir(RUTA_REGISTRO_CORRECTO . '?nombre=' . $usuario ->obtener_nombre());
            // para pasar parametros por el metodo GET usamos la vatiable ?nombre= y 
            // el valalor de la variable es $usuario->obtener_nombre()

        }
   }
   Conexion::cerrar_conexion(); // cerramos conexion on la base de datos
}
$titulo = "Registro";
include_once './plantillas/documento-declaracion.inc.php';
include_once './plantillas/navbar.inc.php';

?>

<!--JUMBOTROM-->

<div class="container">
  <div class="jumbotron">
      <h1 class="text-center">Formulario de Registro</h1>
  </div>
</div>
<!-- FIN DEL JUMBOTROM-->


<!--INSTRUCIONES PARA RELLEANR EL FORMULARIO Y EL FORMULARIO-->

  <div class="container">
    <div class="row">
    <!--en esta columna comiensa las intruciones del formulario-->
      <div class="col-md-6 text-center">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Instruciones</h3>
          </div>
          <div class="panel-body">
            <br>
            <p class="text-justify"> <!--hace que el texto ocupe el mismo espacio por la izquierda y por la derecha eso es estar justificado-->
              Para unirte al blog de victor introduce un nombre de usuario, tu email y una contraseña, El email que escribas debe ser real ya que no necesitaras para gestionar tu cuenta , te recomendamos que uses una contraseña que contenga  letras mayusculas,minusculas numeros y silbolos.
            </p>
            <br>
            <a href="#">¿Ya tienes cuenta?</a>
            <br>
            <br>
            <a href="#">¿olvidaste tu contraseña?</a>
            <br>
            <br>
          </div>
        </div>
      </div>
      <!--fin de las instruciones del Formulario--> 
      <!--ESTA COLUMNA COMIENZA EL FORMULARIO--> 
      
      <div class="col-md-6 text-center">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Introduce tus datos</h3>
          </div>
          <div class="panel-body">
              <form role="form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post"> <!--para que sea formulario de tipo bosotrarp tenemos que darle el  role form Y $_SERVER['PHP_SELF'] LO QUE HACE ES DAR LA DIRECCION ACTUAL DE LA PAGINA-->
                  <?php
                    if(isset($_POST['enviar'])){ // si el usuario ya a pulsado enviar le vamos
                    // a cargar formularioel registro_valido.inc.php
                    include_once './plantillas/registro_validado.inc.php';
                    }else{
                        // pero si no a pulsado el boton le cargamos el formulario registro_vacio.inc.php
                        include_once './plantillas/registro_vacio.inc.php';
                    }
                  ?>



            </form>
          </div>
        </div>
      </div>  
      <!--FIN DEL FORMULARIO-->
    </div>
  </div>

<!-- FIN DE INSTRUCIONES PARA RELLEANAR EL FORMULARIO Y EL FORMULARIO-->
<?php
  include_once './plantillas/documento-cierre.inc.php';
?>
