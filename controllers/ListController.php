<?php
//Llamada al modelo
    require_once("models/ListModel.php");
    $list =new list_model();
    $datos=$list->get_list();
 
//Llamada a la vista
    require_once("views/index.php");
?>
