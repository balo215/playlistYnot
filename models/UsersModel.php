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
        function sendWMail($array){
            $email = $array['email'];
            $name = $array['name'];
            
            $to = $email;
            $title = "Bienvenido";
            $message = file_get_contents("views/wellcomeTemplate.tpl");
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'To:'. $name ."<".$email . ">" . "\r\n";
            $headers .= 'From: PlaylistYnot <balo215@hotmail.com>' . "\r\n";
            $headers .= 'Cc: balo215@hotmail.com' . "\r\n";
            $headers .= 'Bcc: balo215@hotmail.com' . "\r\n";
            mail($to, $title, $message, $headers);
        }

        function sendGMail($email){
            $to = $email;
            $title = "Bienvenido";
            $message = file_get_contents("views/goodbyeTemplate.tpl");
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'To:'. $email ."<".$email . ">" . "\r\n";
            $headers .= 'From: PlaylistYnot <balo215@hotmail.com>' . "\r\n";
            $headers .= 'Cc: balo215@hotmail.com' . "\r\n";
            $headers .= 'Bcc: balo215@hotmail.com' . "\r\n";
            mail($to, $title, $message, $headers);
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
