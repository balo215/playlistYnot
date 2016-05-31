<?php
    
    require_once ('db/databaseClass.php');
    class list_model extends databaseClass {
        public $list;
        function __construct() {
            require('models/ListModelClass.php');
            $list = new listClass();
            
        }//constructor
        function buscar() {
            $conexion = databaseClass::singleton ();
            if (!$conexion->conectar())
                die('FALLO'.$conexion->errno.':'.$conexion->error);
            $consulta = "SELECT * FROM listas;";
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
        function buscar3() {
            $conexion = databaseClass::singleton ();
            if (!$conexion->conectar())
                die('FALLO'.$conexion->errno.':'.$conexion->error);
            $consulta = "SELECT nombre FROM listas WHERE pass = '' LIMIT 3;";
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

        function buscarNombre($name){
            $conexion = databaseClass::singleton ();
            if (!$conexion->conectar())
                die('FALLO'.$conexion->errno.':'.$conexion->error);
            $consulta = "SELECT * FROM listas WHERE nombre = '$name';";
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
        function buscarNombrePass($name, $pass){
            $conexion = databaseClass::singleton ();
            if (!$conexion->conectar())
                die('FALLO'.$conexion->errno.':'.$conexion->error);
            $consulta = "SELECT * FROM listas WHERE nombre = '$name' AND pass = '$pass';";
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
        function obtenerCanciones($name){
            $conexion = databaseClass::singleton ();
            if (!$conexion->conectar())
                die('FALLO'.$conexion->errno.':'.$conexion->error);
            $consulta = "SELECT canciones FROM listas WHERE nombre = '$name';";
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
        function agregarCanciones($name, $list){
            $conexion = databaseClass::singleton ();
            if (!$conexion->conectar())
                die('FALLO'.$conexion->errno.':'.$conexion->error);
            $actualDate = date('Y-m-d H:i:s');
            $consulta = "UPDATE listas SET canciones = '$list', fechaMod = '$actualDate'  WHERE nombre = '$name';";
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
        function borrarCancion($name, $list){
            $conexion = databaseClass::singleton ();
            if (!$conexion->conectar())
                die('FALLO'.$conexion->errno.':'.$conexion->error);
            $consulta = "UPDATE listas SET canciones = '$list' WHERE nombre = '$name';";
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
        function creaLista($array){
            $name = $array['list_nombre'];
            $pass = $array['list_pass'];
            if($pass == ""){
                $pass = null;
            }
            $actualDate = date('Y-m-d H:i:s');
            $conexion = databaseClass::singleton ();
            if (!$conexion->conectar())
                die('FALLO'.$conexion->errno.':'.$conexion->error);
            if(isset($_SESSION)){
                if(isset($_SESSION['email'])){
                    $email = $_SESSION['email'];
                    $consulta = "SELECT id FROM usuarios WHERE correo = '$email'";
                    $resultadoSelect = $conexion -> ejecutarConsulta($consulta);
                    $id = $resultadoSelect[0]['id'];
                    $insert = "INSERT INTO listas (nombre, pass, id_user, canciones, fechaCreacion) VALUES ('$name', '$pass', '$id', '[]', '$actualDate')";
                    $_SESSION['pname'] = $name;
                }else{
                    $insert = "INSERT INTO listas (nombre, pass,  canciones, fechaCreacion) VALUES ('$name', '$pass', '[]', '$actualDate')";
                    $_SESSION['pname'] = $name;
                }
           }else{
                $insert = "INSERT INTO listas (nombre, pass,  canciones, fechaCreacion) VALUES ('$name', '$pass', '[]', '$actualDate')";
                $_SESSION['pname'] = $name;
            }
            $resultado = $conexion -> ejecutarConsulta($insert);
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
