<?php
require_once 'controllers/lote.controller.php';
require_once 'controllers/auth.controller.php';


define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = $_GET['action'];

if ($action == '') {
    $action = 'tabla';
}

$parametro = explode('/', $action);

switch ($parametro[0]) {

    case 'agregar':
        $controller = new LoteController();
        $controller->agregar();
        break;

    case 'tabla':
        $controller = new LoteController();
        $controller->tabla();
        break;

    default:
        echo "404";
        break;
}
