<?php
    require_once "controllers/renderViewController.php";
    class user_controller extends renderViewController{
        public $model;
        function __construct(){
            require("models/UsersModel.php");
            $this->users = new users_model();
            session_start();
        }
        
        function execute(){
            if(isset($_REQUEST["action"])){
                $action = $_REQUEST["action"];
                if($action == "kill"){
                    session_destroy();
                    $_SESSION = array();
                    echo $this->processTemplate('index.php', "[]");
                }



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
                if($action == "sign"){
                    $insert = $this->users->sign($_POST);
                    if($insert != false){
                        echo $this->processTemplate('index.php', "[]");
                    }
                    
                }
   
/*            if(isset($_SESSION) && isset($_SESSION['logued'])){
                 echo $this->processTemplate('views/index.php', []);
            } else{
                echo $this->processTemplate('views/index.php', []);
            }
*/




            }

        }
       
    } 
?>
