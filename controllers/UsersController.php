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
                    $_SESSION = NULL;
                    session_unset();
                    session_destroy();
                    $action = "";
                    
                    echo $this->processTemplate('views/index.php', "[]");
                }


                if($action == "logForm"){
                    echo $this->processTemplate('views/logIn.php', '[]');
                }
                if($action == "signForm"){
                    echo $this->processTemplate("views/signUp.php", "[]");
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
                            echo $this->processTemplate('views/index.php', "[]");
                         }else{  
                            echo $this->processTemplate('views/logIn.php', "[]");
                        }   
                        
                    }   
                }   
                if($action == "sign"){
                    $insert = $this->users->sign($_POST);
                    if($insert != false){
                        header('Location: index.php');
                    }
                    
                }
                if($action == "userLists"){
                    $email = $_SESSION['email'];
                    $lists = $this->users->getLists($email);
                    $view = file_get_contents("views/newList.php");
                    $start = strrpos($view, '<tr>');
                    $end = strrpos($view, '</tr>')+5;

                    $row = substr($view, $start, $end-$start);
                    $rows = "";
                    foreach($lists as $single){
                        $new_row = $row;
                        $dic = array('{{NAME}}' => $single['nombre'],
                                     '{{DATE}}' => $single['fechaMod'],
                                       '{{ID}}' => $single['id']);

                        $new_row = strtr($new_row, $dic);
                        $rows .= $new_row;
                    }
                    $view = str_replace($row,$rows, $view);

                    echo $this->processView($view);
                }

                if($action == "deletePlaylist"){
                    $idSong = $_REQUEST['id'];
                    $result = $this->users->deletePlaylist($idSong);
                    echo $result;
                }
                if($action == "deleteUser"){
                    $email = $_SESSION['email'];
                    $result = $this->users->deleteUser($email);
                    $_SESSION = array();
                    session_destroy();
                    echo $result;
                    header('Location: index.php');
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
