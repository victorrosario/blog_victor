<?php


class RepositorioUsuario{
    
    public static function obtener_todos($conexion){ // obtener todos los usuarios de la base de datos en mysql
        $usuarios = array();
        if(isset($conexion)){ // si la conexion existe osea es verdadera por el metodo isset ejecutate
            try {
                include_once 'Usuario.inc.php';
                $sql = "SELECT * FROM usuarios" ;// le estamos diciendo que queremos todos los datos de la tabla usuarios
                $sentencia = $conexion->prepare($sql); // prepara la orden
                $sentencia -> execute(); // ejecuta la orden sql
                $resultado = $sentencia->fetchAll(); // nos devuelve todos los resultados existentes
                if(count($resultado)){ // el metodo count nos dice cuantas cosas hay en un array si devuelve uno sicnifica que 
                //si hay datos y devolveria true entonces se ejecutario si al contrario no hay 
                //datos daria cero es decir false y no se ejecutaria
                    foreach ($resultado as $fila ){ // recorremos el array resultado fila es lo que itera cada indice
                        $usuarios[] = new Usuario(
                                $fila['id'],$fila['nombre'],$fila['email'],$fila['password'],$fila['fecha_registro'],$fila['activo']
                        );
                        
                    }
                    
                    
                }
                else{
                    print "No hay Usuarios victor";
                }
                
            } catch (PDOException $ex) {
                print "ERROR" . $ex-> getMessage();
            } 
        }
        return $usuarios; // devuelve los usuarios
        
        
    }
    
    public static function obtener_numero_usuarios($conexion){
        $total_usuarios = null;
        if(isset($conexion)){ //  si es verdadero es decier si existe la conexion ejecutate
            try {
                $sql = "SELECT COUNT(*) as total FROM usuarios "; // LE ESTAMOS DICIENDO QUE CUENTE TODOS LOS 
                // USUARIOS HAY EN LA BASE DE DATOS MYSQL Y EL ALIAS ES EL
                //  total es decir total es el que nos devolvera el resultado de cauntos usuarios hay en la base de 
                //  datos blog  en la tabla usuarios
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia-> fetch(); // le estamos diciendo0 que recupere el numero de usuarios que o es lo mismo
                // que recuperar todos los usuarios ahi si seria fetchALL() porque
                //  le estariamos diciendo recuperame TODOS LOS USUARIOS Y ESO INCCLUYE ID NOMBRE PASSWORD ETC
                $total_usuarios = $resultado['total']; // a la variable resultado
                // le estamos pasando el valor total que es el as total que es el que contiene el numero de usuarios
            } catch (PDOException $ex) {
              print "ERROR VICTOR" . $ex->getMessage();  
            }
        }
        return $total_usuarios; // nos devuelve el total de usuarios
    }
    
    public static function insertar_usuario($conexion,$usuario){ // inseta usuarios en la base de datos mysql
        
        $usuario_insertado = false;
        if(isset($conexion)){ //comprobamos si la conexion existe si existe ejecutate
            try {
                $sql = "INSERT INTO usuarios(nombre,email,password,fecha_registro,activo) VALUES(:nombre,:email,:password,NOW(), 0)";// :nombre , :email 
                //:password son alias po0rque tienen el :, el metodo now() introdusira la fecha actual, Y  para activo introducimos 0 que sicnifica que el usuario no estara activo
                 $nombretemp = $usuario -> obtener_nombre();
                 $emailtemp = $usuario->obtener_email();
                 $passwordtemp = $usuario->obtener_password();
                 $sentencia = $conexion->prepare($sql); // prepara la sentencia sql 
                 $sentencia -> bindParam(':nombre', $nombretemp , PDO::PARAM_STR); // bindparam atar parametro enlasar
                 // parametro
                 //, para indicar 
                 //de que tipo es este parametro como es texto usamos PDO::PARAM_STR
                 $sentencia -> bindParam(':email', $emailtemp , PDO::PARAM_STR);
                 $sentencia -> bindParam(':password',  $passwordtemp , PDO::PARAM_STR);
                 
                $usuario_insertado = $sentencia->execute(); // ejecuta la sentencia sql y devuelve un booleano true o false
            } catch (PDOException $ex) {
                print "ERROR VICTOR" . $ex->getMessage();
            }
        }
        return $usuario_insertado; // delvolvemos el usuario insertado que nos dara true o false
    }
    
    public static function nombre_existe($conexion,$nombre) { // veremos si el nombre ya existe en la base de
    // datos mysql y si existe ya no podra ser utilisado es decir la idea es que no existan nombres iguales
        $nombre_existe=true; // por defecto asumiremos que el nombre si exixte y para verificar
        // que no existe tendremos que hacer la consulta a la base de datos
        if(isset($conexion)){ // si la conexion existe ejecutate
            try {
                $sql= "SELECT * FROM usuarios WHERE nombre = :nombre"; // usuarios es la tabla usuarios en mysql
                // :nombre es el parametro que $nombre que le estamos pasando
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':nombre', $nombre, PDO::PARAM_STR);// nos permite insertar el parametro en :nombre
                $sentencia->execute();
                $resultado= $sentencia->fetchAll(); // recuperamos todos lso resultados que puedan usar ese nombre
                if(count($resultado)){ // vamos a contar cauntos el resultado es decir cuantos nombres hay,
                // si hay algo que cotar ejecutate osea si es true
                    $nombre_existe=true;
                    
                }else{
                    $nombre_existe=false;
                }
            } catch (Exception $ex) {
                print 'ERROR VICTOR EN NOMBRE_EXISTE()' . $ex->getMessage();
            }
        }
        return $nombre_existe; // devolvemos la variable $nombre_existe
    }
    
     public static function email_existe($conexion,$email) { // veremos si el email ya existe en la base de
    // datos mysql y si existe ya no podra ser utilisado es decir la idea es que no existan email iguales
        $email_existe=true; // por defecto asumiremos que el nombre si exixte y para verificar
        // que no existe tendremos que hacer la consulta a la base de datos
        if(isset($conexion)){ // si la conexion existe ejecutate
            try {
                $sql= "SELECT * FROM usuarios WHERE email = :email"; // usuarios es la tabla usuarios en mysql
                // :email es el parametro que $nombre que le estamos pasando
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':email', $email, PDO::PARAM_STR);// nos permite insertar el parametro en :nombre
                $sentencia->execute();
                $resultado= $sentencia->fetchAll(); // recuperamos el los resultados que puedan usar ese email
                if(count($resultado)){ // vamos a contar cauntos el resultado es decir cuantos nombres hay,
                // si hay algo que cotar ejecutate osea si es true
                    $email_existe=true;
                    
                }else{
                    $email_existe=false;
                }
            } catch (Exception $ex) {
                print 'ERROR VICTOR EN EMAIL_EXISTE()' . $ex->getMessage();
            }
        }
        return $email_existe; // devolvemos la variable $nombre_existe
    }
    
    public static function obtener_usuario_por_email($conexion,$email){ // este metodo nos devolvera 
    //un usuario a partir de un imail
        $usuario = null;
        if(isset($conexion)){ // si la conexion existe ejecutate
            try {
                include_once 'Usuario.inc.php';
                $sql="SELECT * FROM usuarios WHERE email = :email"; // usaurios es la tabla usuarios de mysql y :email es
                // el parametro $email
                $sentencia = $conexion-> prepare($sql);
                $sentencia->bindParam(':email',$email,PDO::PARAM_STR); // :email es lo que enlasamos con 
                //la funcion bindParam y le damos el valor de el parametro $email y es de typo PARAM_STR
                $sentencia->execute();
                $resultado = $sentencia->fetch(); // recupera un solo resultado
                if(!empty($resultado)){ // si resultado NO esta vacio es decir que si hay hay un email de usaurio registrado 
                //ejecutate
                    $usuario = new Usuario($resultado['id'],
                            $resultado['nombre'],
                            $resultado['email'],
                            $resultado['password'],
                            $resultado['fecha_registro'],
                            $resultado['activo']);// iniciamos el usaurio
                }
            } catch (PDOException $ex) {
                print "ERROR VICTOR EN OBTENER_USUARIO_POR_EMAIL()" . $ex->getMessage();
            }
        }
        return $usuario; // si no existe usaurio este decolvera usuario null, null secnifica la ausencia de valor 
        //que no existe valor, que esta vacia
        
    }
}


?>
