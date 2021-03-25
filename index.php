<?php
session_start();
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layoults/header.php';
require_once 'views/layoults/sidebar.php';


function show_error() {
    $error = new errorController();
    $error->index();
}

if(isset($_GET['controller'])){
    
    $controller_name= $_GET['controller'] . "Controller";
    
}elseif(!isset ($_GET['controller'] ) && !isset($_GET['action'])) {
    $controller_name = controller_default;

}else{
    show_error();
    exit();
}

if(class_exists($controller_name)){
    
    $controller = new $controller_name();
    
    if(isset($_GET['action']) && method_exists($controller, $_GET['action'])){
        $action = $_GET['action'];
      
        $controller->$action();
    }elseif (!isset ($_GET['controller'] ) && !isset($_GET['action'])) {
        $action=action_default;
        $controller->$action();
    }else{
        show_error();
    }
    
}else{
    show_error();
}

require_once 'views/layoults/footer.php';

