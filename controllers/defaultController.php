<?php
    require_once "controllers/renderViewController.php";
    class defaultController extends renderViewController{
        public $list;
        public $users;
        
        function __construct(){
            require 'models/ListModel.php';
            require 'models/UsersModel.php';
            $this->list  = new list_model();
            $this->users = new users_model();
            session_start();
        }
        
        function execute(){
            $top5 = $this->list->buscar();
            echo $this->processTemplate('views/index.php', $top5);
        }

        

    }
?>
