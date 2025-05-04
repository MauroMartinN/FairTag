<?php
include_once '../db/db.php';

if(!isset($_REQUEST['c']))
{
    require_once '../view/header.php';
    require_once '../view/map/inicioMap.php';
    require_once '../view/footer.php';

}
else
{
    $controller = strtolower($_REQUEST['c']);
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
    
    require_once "../controller/$controller.controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    
    call_user_func( array( $controller, $accion ) );
}