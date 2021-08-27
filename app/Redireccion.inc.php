<?php
class Redireccion{
    public static function redirigir($url){ // cuando le pasemos una url a este metodo el nos dirigira a dicha la pagina web de la url
        header('Location: ' . $url, true,301); // header es la funcion que nos permite redirigir, los servidores funcionan 
        //con codigo ponemos 301 indica redirecion , poenrlo en true siempre eso indica a que pagina hemos sido redirigidos en la url
        exit(); // indicamos que aqui termina la ejecucion
    }
    
}


?>
