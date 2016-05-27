<?php
    require_once "controllers/renderViewController.php";
    class defaultController extends renderViewController{
        public $list;
        public $users;
        
        function __construct(){
            require 'models/ListModel.php';
            require 'models/UsersModel.php';
            $this->list  = new list_model();
        }
        
        function execute(){
            $top5 = $this->list->buscar();
            echo $this->processTemplate('views/index.php', $top5);
/*            if(isset($_REQUEST["action"])){
                $action = $_REQUEST["action"];
                if($action == "login"){
                    if (!isset($_REQUEST['email']) && !isset($_REQUEST['pass'])) {
                    } else {
                        $email = $_REQUEST['email'];
                        $pass  = $_REQUEST['pass'];
                        $user = $this->users->login($email, $pass);
                        if($user != false){
                            if (is_array($user) || is_object($user)) {
                                $_SESSION['logued']=true;
                                $_SESSION['email']=$user[0]['correo'];
                            }
                        }else{
                            echo $this->processTemplate('views/logIn.php', $user);
                        }
                        
                    }
                }
            }
            if(isset($_SESSION) && isset($_SESSION['logued'])){
                echo $this->processTemplate('views/index.php', $top5);
            } else{
                echo $this->processTemplate('views/index.php', $top5);
            }   */
        }

        

    }
?>
