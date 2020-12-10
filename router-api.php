<?php
require_once 'libs/router/Router.php';
require_once 'api/municipio.Api.controller.php';

$router =new Router();

$router->addRoute('centros/tipo/:TIPO', 'GET', 'MunicipoApiController', 'getCentros');
$router->addRoute('lotes/disponible/:DISPONIBLE', 'GET', 'MunicipoApiController', 'getLotesDisponibles');


$router->route($_REQUEST['resource'],$_SERVER['REQUEST_METHOD']); //recurso (productos, rubros...) y verbo (GET, POst....)




