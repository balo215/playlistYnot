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
    }
?>
