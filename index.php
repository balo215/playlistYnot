<?php
    require_once("db/database.php");
    if (isset($_REQUEST['controller'])) {
        switch($_REQUEST['controller'])
        {
            case 'user':
                include('controllers/UsersController.php');
                $controller = new user_controller();
            break;
            case 'list':
                include('controllers/ListController.php');
                $controller = new list_controller();
            break;
            case 'tmpList':
                include('../controllers/TmpListController.php');
                $controller = new tmpListController();
            break;
            default:
                include('controllers/defaultController.php');
                $controller = new defacultController(); 
            break;
        }
    }
    else {
        include("controllers/defaultController.php");
        $controller = new defaultController(); 
    }
    $controller->execute();


?>
