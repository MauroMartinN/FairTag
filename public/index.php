<?php
include_once '../db/db.php';
// FrontController
if(!isset($_REQUEST['c']))
{
    require_once '../view/headerStart.php';
    echo "<h3>Bienvenido!! Selecciona una opción del menú para empezar.</h3>";
    echo "<h4>En otra vista prepararíamos el texto y la configuración de la pantalla inicial de la aplicación, y la llamaríamos aquí.</h4>";
    require_once '../view/footer.php';
}
else
{
    // Obtenemos el controlador que queremos cargar
    $controller = strtolower($_REQUEST['c']);
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
    
    // Instanciamos el controlador
    require_once "../controller/$controller.controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    
    // Llamada a la accion a realizar
    call_user_func( array( $controller, $accion ) );
}