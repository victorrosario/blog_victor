<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php
    if(!isset($titulo )|| empty($titulo)){ // si la variable titulo  no existe  o si titulo esta vacio ejecutate  
        $titulo = 'Blog de victor';
    }
        echo "<title>$titulo</title>"
    
    ?>
    <!--BOOSTRAP CSS-->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!--CSS PROPIO-->
    <link rel="stylesheet" href="css/estilos.css" />
  </head>
  <body>
