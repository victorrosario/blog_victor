<?php
include_once './app/Conexion.inc.php';
include_once './app/RepositorioUsuario.inc.php';
$titulo = "blog de victor";
include_once './plantillas/documento-declaracion.inc.php';
include_once './plantillas/navbar.inc.php';

?>


    <!-- baarra de navegacion con boostrap-->

   
    <!-- fin de la barra de navegacion con bootrap-->

    <!-- header jumbotrom-->

    <div class="container">
      <div class="jumbotron">
        <h1>Blog de victor</h1>
        <p>blog dedicado a la programacion</p>
      </div>
    </div>

    <!-- FIN DEL  header jumbotrom-->

    <!--REGILLA DE LA PAGINA-->

    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Busqueda
                </div>
                <div class="panel-body">
                  <div class="form-group">
                    <input
                      type="search"
                      class="form-control"
                      placeholder="¿ QUE BUSCAS?"
                    />
                  </div>
                  <button class="form-control">Buscar</button>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <span class="glyphicon glyphicon-filter" aria-hidden="true"></span> Filtro
                </div>
                <div class="panel-body">

                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Archivo
                </div>
                <div class="panel-body">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="panel panel-default">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-time" aria-hidden="true"></span> Ultimas Entradas
            </div>
            <div class="panel-body">
               
              <p>Todabia no hay entradas que mostrar</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- FIN DE LA REGILLA DE LA PAGINA-->

  <?php
                include_once './plantillas/documento-cierre.inc.php';
  ?>