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
        function getLists($email){
            $conexion = databaseClass::singleton ($email);
            if (!$conexion->conectar()){
                die('FALLO'.$conexion->errno.':'.$conexion->error);
            }
            $consulta = "SELECT listas.nombre, listas.fechaMod, listas.id FROM listas, usuarios WHERE listas.id_user = usuarios.id AND usuarios.correo = '$email'";
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
        function deletePlaylist($id){
            $conexion = databaseClass::singleton ($email);
            if (!$conexion->conectar()){
                die('FALLO'.$conexion->errno.':'.$conexion->error);
            }
            $consulta = "DELETE FROM listas WHERE id = $id";
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

        function deleteUser($email){
            $conexion = databaseClass::singleton ($email);
            if (!$conexion->conectar()){
                die('FALLO'.$conexion->errno.':'.$conexion->error);
            }
            $consulta = "DELETE listas, usuarios FROM listas, usuarios WHERE listas.id_user = usuarios.id AND usuarios.correo = '$email';";
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
