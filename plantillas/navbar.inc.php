<?php
Conexion::abrir_conexion();

$total_usuarios= RepositorioUsuario::obtener_numero_usuarios(Conexion::obtener_conexion()); // usuamos el metodo obtener conexion
//ya que el atributo
// $conexion es una variable privada y solo podemos adceder a ella atrabes de un metodo que nos la devuelva
Conexion::cerrar_conexion();
?> 
<nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <!--BOTON QUE APARECERA SI SE REDUCE LA PANTALLA-->
          <button
            type="button"
            class="navbar-toggle collapsed"
            data-toggle="collapse"
            data-target="#navbar"
            aria-expanded="false"
            aria-controls="navbar"
          >
            <span class="sr-only">
              esto solo lo podra ver dispositivos para indigentes graciasal
              sronly este boton despliega la barra de navegacion</span
            >
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!--FIN DEL BOTON QUE APARECE SI SE REDUCE LA PANTALLA-->
          <!--LOGO DE LA PAGINA-->
          <a class="navbar-brand" href="<?php echo SERVIDOR; ?>">VR</a>
          <!--fin del logo de pa pagina-->
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo RUTA_ENTRADAS; ?>"> <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Entradas</a></li>
            <li><a href="<?php echo RUTA_FAVORITOS; ?>"> <span class="glyphicon glyphicon-star" aria-hidden="true"></span> Fovoritos</a></li>
            <li><a href="<?php echo RUTA_AUTORES; ?>"> <span class="glyphicon glyphicon-education" aria-hidden="true"></span> Autores</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li>
                  <a href="#">
                   <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                  <?php
                    echo $total_usuarios; 
                  ?>
                  </a>
              </li>
            <li><a href="<?php echo RUTA_LOGIN; ?>"> <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Iniciar Seccion</a></li>
            <li><a href="<?php echo RUTA_REGISTRO; ?>"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Registro</a></li>
          </ul>
        </div>
      </div>
    </nav>
