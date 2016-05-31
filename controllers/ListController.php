<?php
    require_once "controllers/renderViewController.php";
    class list_controller extends renderViewController{
        function __construct(){
            require_once("models/ListModel.php");
            $this->list = new list_model();
            session_start();
        }
 
        function execute(){
            if(isset($_REQUEST["action"])){
                $action = $_REQUEST["action"];
                switch($action){
                    case 'join':
                        $name = $_REQUEST["name"];
                        if($_REQUEST['password'] != ""){
                            $pass = $_REQUEST['password'];
                            $result = $this->list->buscarNombrePass($name, $pass);
                            $_SESSION['pname'] = $name;
                            echo $result;
                        }else{
                            $result = $this->list->buscarNombre($name);
                            if($result != FALSE){
                                if($result[0]['pass'] == NULL){
                                    $_SESSION['pname'] = $name;
                                    echo json_encode($result);
                                }else{
                                    echo 1;
                                }
                            }else{
                                
                                echo json_encode($result);
                            }
                        }
                        break;
                    
                    case 'createForm':
                        echo $this->processTemplate("views/createList.php");
                        break;
                    case 'create':
                        $insert = $this->list->creaLista($_POST);
                        if($insert != false){
                            header('Location: views/plTemplate.php');
                        }
                        break;

                    case 'details':
                        $result = $this->list->obtenerCanciones($_SESSION['pname']);
                        if(!isset($_SESSION['email'])){
                            echo json_encode(array("canciones"=>$result[0]['canciones'], "name"=>$_SESSION['pname'], "logued"=>false));
                        }else{
                            echo json_encode(array("canciones"=>$result[0]['canciones'], "name"=>$_SESSION['pname'], "logued"=>true, "email"=>$_SESSION['email']));
                        }
                        break;
                    
                    case 'addSong':
                        $result = $this->list->obtenerCanciones($_SESSION['pname']);
                        $song = $_REQUEST['id'];
                        if(strlen($result[0]['canciones']) > 5){
                            $newList .= substr($result[0]['canciones'], 0, strlen($result[0]['canciones'])-1) . "," . $song . "]";
                        }else{
                            $newList .= substr($result[0]['canciones'], 0, strlen($result[0]['canciones'])-1) . $song . "]";
                        }
                        $updateResult = $this->list->agregarCanciones($_SESSION['pname'], $newList);
                        echo $updateResult;
                        break;
                    case 'deleteSong':
                        $result = $this->list->obtenerCanciones($_SESSION['pname']);
                        $idSong = $_REQUEST['id'];
                        $fullList = $result[0]['canciones'];
                        $newList = substr($fullList, 0, strpos($fullList, $idSong)) . substr($fullList, strpos($fullList, $idSong)+11, strlen($fullList));
                        $newList = str_replace("[,", "[", $newList);
                        $newList = str_replace(",,", ",", $newList);
                        $newList = str_replace(",]", "]", $newList);
                        $deletedResult = $this->list->borrarCancion($_SESSION['pname'], $newList);
                        echo json_encode($result);
                        break;
                }
            }
        }        
    }
?>
