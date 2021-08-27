<div class="form-group">
    <label>Nombre de usuario</label>
    <input type="text" class="form-control" name="nombre" placeholder="Usuario" <?php $validador -> mostrar_nombre();?> >
    <?php
        $validador-> mostrar_error_nombre(); // no ahce nada si no hay errorres
    ?>
</div>
<div class="form-group">
    <label>Email</label>
    <input type="email" class="form-control" name="email" placeholder="usaurio@mail.com"<?php $validador -> mostrar_email();?> >
    <?php
        $validador-> mostrar_error_email(); // no hace nada si no hay errorres
    ?>
</div>
<div class="form-group">
    <label>Contraseña</label>
    <input type="password" class="form-control" name="clave1">
    <?php
        $validador-> mostrar_error_clave1(); // no hace nada si no hay errorres
    ?>
</div>
<div class="form-group">
    <label>Repite la Contraseña</label>
    <input type="password" class="form-control" name="clave2">
    <?php
        $validador-> mostrar_error_clave2(); // no hace nada si no hay errorres
    ?>
</div>
<br>
<button type="reset" class="btn btn-default">
    Limpiar Formulario
</button> <!--reset limpia los datos-->
<br>
<br>
<button type="submit" class="btn btn-default" name="enviar">
    Enviar Datos
</button> <!--submit envia los datos-->

