<?php
include_once '../db/db.php';

session_start();

$controller = isset($_REQUEST['c']) ? strtolower($_REQUEST['c']) : 'pais';
$accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';

$validControllers = ['rol', 'user', 'map', 'post', 'comment', 'invitado', 'pais', 'notificacion', 'dashboard', 'denuncia'];
if (!in_array($controller, $validControllers)) {
    die("Acción no permitida");
}

require_once "../controller/$controller.controller.php";
$controller = ucwords($controller) . 'Controller';
$controller = new $controller;

call_user_func( array( $controller, $accion ) );
