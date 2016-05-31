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
            $top3 = $this->list->buscar3();
            $view = file_get_contents("views/index.php");
            $lineStart = strrpos($view, "<li><a");
            $lineEnd = strrpos($view, "</li>")+5;

            $lineS = substr($view, $lineStart, $lineEnd-$lineStart);
            foreach($top3 as $line){
                $newLine = $lineS;
                $array = array('{LIST}'=> $line['nombre']);
                $newLine = strtr($newLine, $array);
                $lines .= $newLine;
            }
            $view = str_replace($lineS, $lines, $view);
            $header = file_get_contents("views/header.html");
            $footer = file_get_contents("views/footer.html");
            echo $header . $view . $footer;


        }

        

    }
?>
