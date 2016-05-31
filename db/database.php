<?php

class Conectar{
    public static function conexion(){
        $conexion=new mysqli("localhost", "root", "123456", "playlist");
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }
}
?>
