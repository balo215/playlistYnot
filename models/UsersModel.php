<?php
    require_once ('db/databaseClass.php');
    class users_model extends databaseClass {
        public $usuario;
        function __construct() {
            require('UsersModelClass.php');
            $usuario = new users();
            
        }
        function login($email,$pass) {
            $conexion = databaseClass::singleton ();
            if (!$conexion->conectar())
                die('FALLO'.$conexion->errno.':'.$conexion->error);
            $consulta = "SELECT * FROM  usuarios WHERE correo = '$email' AND pass = '$pass';";
            $resultado = $conexion -> ejecutarConsulta($consulta);
            if(!$resultado) {
                $conexion->cerrar();
                return FALSE;
            }
            else {
                $conexion -> cerrar();
                return $resultado;
            }
        }
        function sign($array){
            $name = $array['name'];
            $username = $array['username'];
            $lastname = $array['lastname'];
            $pass = $array['password'];
            $email = $array['email'];
            $conexion = databaseClass::singleton ();
            if (!$conexion->conectar())
                die('FALLO'.$conexion->errno.':'.$conexion->error);
            $consulta = "INSERT INTO usuarios (nombre, apellido, usuario, pass, correo) VALUES ('$name', '$lastname', '$username', '$pass', '$email')";
            $resultado = $conexion -> ejecutarConsulta($consulta);
            if(!$resultado) {
                $conexion->cerrar();
                return FALSE;
            }
            else {
                $conexion -> cerrar();
                return $resultado;
            }

        }
    }
?>
