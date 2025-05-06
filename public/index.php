<?php
include_once '../db/db.php';

session_start();

$controller = isset($_REQUEST['c']) ? strtolower($_REQUEST['c']) : 'user';
$accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';

$validControllers = ['rol', 'user', 'map', 'post'];
if (!in_array($controller, $validControllers)) {
    die("Acción no permitida");
}

require_once "../controller/$controller.controller.php";
$controller = ucwords($controller) . 'Controller';
$controller = new $controller;

call_user_func( array( $controller, $accion ) );
