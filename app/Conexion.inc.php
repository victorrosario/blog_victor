<?php

class Conexion{
    private static $conexion;
    
    public static function abrir_conexion(){
        if(!isset(self::$conexion)){ // comprueba la conecion con el isset  si la conexion es falsa es decir no existe ejecutate
            try {
                include_once 'config.inc.php';
                self::$conexion = new PDO('mysql:host='.NOMBRE_SERVIDOR.'; dbname='.NOMBRE_BD,NOMBRE_USUARIO,PASSWORD);
                self::$conexion -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                self::$conexion -> exec("SET CHARACTER SET utf8");
                //  ESTE ES LA FORMA CORRECTA DE HACERLO APRA NO TENER PROBLEMAS EN EL FUTURO YA QUE PHP FUE ACTUALIZADO 
                
            } catch (PDOException $ex) {
                print "ERROR" . $ex -> getMessage(). "<br>";
                die();
            }
        }
    }
    
    public static function cerrar_conexion(){
        if(isset(self::$conexion)){ //comprueba con el metodo isset   si la conexion esta iniciada devolvera true si es asi ejecutate
            self::$conexion = null; // asi cerramos la conexion
            
        }
    }
    
   // creamos este metodo para obtener  la variable private static conexion ya que esta es privada y 
   // fuera de la clase no se puede obtener ya que es una variable si fuera un metodo si se podria
    public static function obtener_conexion(){
        return self::$conexion;
        
        
    }
    
    
}






?>
