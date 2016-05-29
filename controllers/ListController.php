<?php
//Llamada al modelo
    require_once "controllers/renderViewController.php";
    class list_controller extends renderViewController{
        function __construct(){
            require_once("models/ListModel.php");
            $list =new list_model();
            session_start();
        }
 
        function execute(){
            if(isset($_REQUEST["action"])){
                $action = $_REQUEST["action"];
                switch($action){
                    case 'join':
                        $name = $_REQUEST["name"];
                        var_dump($_SESSION);DIE;
                        break;
                }
            }
        }        
    }
?>
