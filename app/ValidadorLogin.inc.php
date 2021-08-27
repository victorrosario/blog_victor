<?php
include_once 'RepositorioUsuario.inc.php';

class ValidadorLogin{
     private $usuario; // atributo usaurio de la clase ValidadorLogin
     private $error; // atributo error de la clase ValidadorLogin
     
     public function __construct($email,$clave,$conexion){
         $this->error=""; // error es el atributo error de la clase ValidadorLogin
        if(!$this->variable_iniciada($email) || !$this->variable_iniciada($clave)){ // si el email no esta iniciada o si 
        //el password no esta iniciada ejecutate
            $this->usuario=null;
            $this->error="Debes introducir tu email  y tu Contraseña";
        }else{
            $this-> usuario= RepositorioUsuario::obtener_usuario_por_email($conexion,$email);
            if(is_null($this->usuario)|| !password_verify($clave,$this-> usuario ->obtener_password())){// si usuario es null
            // porque cualquier cosa a salido mal los
            // datos son incorrectos  ejecutate, password_verify va a verificar si la clave introducida councide con 
            // la clave sifrada por hast 
            //  que tenemos en mysql ENTONCES SI LA CONTRASEÑA NO ESTA VERIFICADA O EL USUARIO ES NULL OSEA TIENE DATOS
            //   INCORRECTOS EJECUTATE
                
              $this->error="Datos Incorrectos";  
            }
        }
     }
     
      private function variable_iniciada($variable){
        if(isset($variable)&& !empty($variable)){ // con el isset comprovamos si la variable
        // esta iniciada osea si existe y si no esta vacia ejecutate
            return true;
            
        }else{
            return false;
        }
    }
    
    public function obtener_usuario(){ // para que desde afuera podamos obtener cualqueir usuario que tengamos
        return $this->usuario;
    }
    
    public function obtener_error(){ // usamos este metodo para que nos devuelva el errror es decir obtengamos el error
        return $this->error;
    }
    
    public function mostrar_error(){ // msotrara en rojo el error en el formulario al usuario
        if($this->error !==''){ // si error no es igual a texto vacio ejecutate, es deciir 
        //si la variable error no esta vacia ejecutate
            echo "<br><div class='alert alert-danger' role='alert' >";
            echo $this->error;
            echo "</div><br>";
        }
    }
}



?>
