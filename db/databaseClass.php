<?php
class databaseClass{
    private $host;
    private $user;
    private $pass; 
    private $conn;
    private static $instance;
    private function __construct () {
        $this->host = "localhost";
        $this->user = "root";
        $this->pass = "123456";
        $this->bd = "playlist";
    }//constructor
    public static function singleton() 
    {
        if (!isset(self::$instance)) {
           $c = __CLASS__;
           self::$instance = new $c;
       }
       return self::$instance;
   }
   public function __clone()
   {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
    function conectar () {
        $conexion = new mysqli ($this->host, $this->user, $this->pass, $this->bd);
        if($conexion->errno) {
            return FALSE;
        }//if
        $this->conn = $conexion;
        return TRUE;
    }
    function ejecutarConsulta ($query) {
        $resultado = $this->conn->query ($query);
        if ($this->conn->errno) {
            echo ".  error @ query   .";
            return FALSE;
        }
        if (is_object($resultado)) {
            if ($resultado->num_rows > 0) {
                while($fila = $resultado->fetch_assoc()) {
                    $resultado_array[] = $fila;
                }
                return $resultado_array;
            }
        }
        $pos = strpos($query, 'INSERT');
        if ($pos===0) {
            echo 'INSERT';
            return $resultado;
        }
        return $this->conn->affected_rows;
    }
    function cerrar() {
        return $this->conn->close();
    }
    function limpiarVariable ($dato) {
        return $this->conn->real_escape_string($dato);
    }
}
?>
