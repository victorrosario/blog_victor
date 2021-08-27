<?php
include_once 'RepositorioUsuario.inc.php';

class ValidadorRegistro{
    private $aviso_inicio;
    private $aviso_cierre;
    
    private $nombre; // cuando usamos this -> nombre nos referemos a estas variables
    private $email; // cuando usamos this -> email nos referemos a estas variables
    private $clave;
    
    private $error_nombre; 
    private $error_email; 
    private $error_clave1; 
    private $error_clave2; 
    
    public function __construct($nombre,$email,$clave1,$clave2, $conexion){
        $this -> aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
        $this -> aviso_cierre ="</div>";
        
        $this -> nombre ="";
        $this-> email ="";
        $this->clave="";
        
        $this-> error_nombre = $this->validar_nombre($conexion,$nombre);
        $this-> error_email = $this->validar_email($conexion,$email);
        $this-> error_clave1 = $this->validar_clave1($clave1);
        $this-> error_clave2 = $this->validar_clave2($clave1,$clave2);
        
        if($this-> error_clave1 ==="" && $this->error_clave2 ===""){ // si error_clave2es igual a un string vacio es decir no 
        //hubo nungun error ejecutate y si error_clave2 tanbien es igual a un strin vacio
           $this->clave=$clave1;
            
            
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
    
    private function validar_nombre($conexion,$nombre){
        if(!$this->variable_iniciada($nombre)){ // si la variable no esta iniciada y esta vacia ejecutate
            return "Debes escribir un nombre de usuario";
        }else{
            $this->nombre = $nombre;
        }
        if(strlen($nombre)< 6){ // comprobaremos la longetud del string que es $nombre, si su longitud es menos de 6 ejecutare
            return "el nombre debe ser mas largo que 6 caracteres";
        }
        if(strlen($nombre)> 24){
            return "El nombre no puede ocupar mas de 24 caracteres ";
        }
        
        if(RepositorioUsuario::nombre_existe($conexion,$nombre)){ // si el nombre ya existe
        // es decir hay otro usuario con ese nombre ejecutate
            return "este nombre de usuario ya esta en uso por favor. pueba otro nombre";
            
            
        }
        return ""; // si ninguna de las condiciones se cumple devuelve un campo vacio porque no a habido errores
    }
    private function validar_email($conexion,$email){
        if(!$this->variable_iniciada($email)){ // si la variable no esta iniciada y esta vacia ejecutate
            return "Debes proporcionar un email";
        }else{
            $this->email = $email;
        }
        
        if(RepositorioUsuario::email_existe($conexion,$email)){
            return "Este email ya esta en uso ,Por favor, prueba otro email o <a href='#'>intente recuperar la contraseña</a>";
        }
        return ""; // si no a habiado ningun error devolvemos un espacio vacio
    }
    private function validar_clave1($clave1){
        if(!$this->variable_iniciada($clave1)){ // si la variable no esta iniciada y esta vacia ejecutate
            return "Debes escribir una contraseña";
        }
        return "";// si ninguna de las condiciones se cumple devuelve un campo vacio porque no a habido errores
    }
    
    private function validar_clave2($clave1,$clave2){
        if(!$this->variable_iniciada($clave1)){ // si la variable clave1 no esta iniciada o esta vacia ejecutate
            return "primero debes rellenar la contraseña 1";
        }
        if(!$this->variable_iniciada($clave2)){ // si la variable no esta iniciada y esta vacia ejecutate
            return "Debes repetir tu contraseña";
        }
        if(!$clave1==$clave2){ // si clave1 es diferente de clave2 ejecutate
            return "ambas contraseñas deben coincidir";
        }
        return "";// si ninguna de las condiciones se cumple devuelve un campo vacio porque no a habido errores
    }
    
    // METODOS GETTER
    
    public function obtener_nombre(){
        return $this->nombre;
    }
    public function obtener_email(){
        return $this->email;
    }
    public function obtener_clave(){
        return $this->clave;
    }


    public function obtener_error_nombre(){
        return $this->error_nombre;
    }
    public function obtener_error_email(){
        return $this->error_email;
    }
    
    public function mostrar_nombre(){ // deja el nombre de usuario escrito en el formualrio cuando el formulario es validado
        if($this->nombre !==""){ // si nombre no es igual a vacio ejecutate
            echo 'value=" '. $this ->nombre . ' " ';
        }
    }
    public function mostrar_error_nombre(){
        if($this ->error_nombre !==""){ // si error_nombre no es igual a vacio ejecutate es
        // decir si ralmente existe un error ejecutate
            echo $this-> aviso_inicio . $this-> error_nombre . $this-> aviso_cierre;
        }
    }
    
     public function mostrar_email(){ // deja el email escrito en el formualrio cuando el formulario es validado
        if($this->email !==""){ // si email no es igual a vacio se ejecuta y lo escribimos
            echo 'value=" '. $this ->email . ' " ';
        }
    }
    
     public function mostrar_error_email(){
        if($this ->error_email !==""){ // si error_email no es igual a vacio ejecutate es
        // decir si ralmente existe un error ejecutate
            echo $this-> aviso_inicio . $this-> error_email . $this-> aviso_cierre;
        }
    }
     public function mostrar_error_clave1(){
        if($this ->error_clave1 !==""){ // si error_clave1 no es igual a vacio ejecutate es
        // decir si ralmente existe un error ejecutate
            echo $this-> aviso_inicio . $this-> error_clave1 . $this-> aviso_cierre;
        }
    }
    public function mostrar_error_clave2(){
        if($this ->error_clave2 !==""){ // si error_clave2 no es igual a vacio ejecutate es
        // decir si ralmente existe un error ejecutate
            echo $this-> aviso_inicio . $this-> error_clave2 . $this-> aviso_cierre;
        }
    }
    
    public function registro_valido(){
        if($this->error_nombre === "" &&
                $this->error_email ==="" &&
                $this->error_clave1 ==="" &&
                $this->error_clave2 ===""){ // === sinnifica exactamente igual 
        //es deicir si son del mismo valir y son del mismo tipo , si error_nombre es exaxtamente 
        //igual a vacio y si error_email, 
        //error_clave1 y error_clave2 son igual a vacio es decir que no existe
        // ningun error en ninguna de los  campos ejecutate 
            return true;
        }else{
            return false;
        }
    }
    
}


?>
