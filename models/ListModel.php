<?php
class list_model{
    private $db;
    private $list;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->list=array();
    }
    public function get_list(){
        $consulta=$this->db->query("select * from listas;");
        while($filas=$consulta->fetch_assoc()){
            $this->list[]=$filas;
        }
        return $this->list;
    }
}
?>
