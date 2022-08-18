<?php
// ob_start();
include('./config.php');

// if ($_SERVER['HTTPS'] != "on" or strpos($_SERVER['HTTP_HOST'], 'www') !== false) {
//     header("location: " . $proyect['root_absolute']);
// }

// include './model/library/Router/Route.php';
// include './model/library/Router/Router.php';
// include './model/library/Router/RouteNotFoundException.php';

// $router = new Router\Router($proyect['name']);

// $router->add('/(|inicio|index|index.php)', function () {
//     global $proyect;
//     $currentFolder = 'data';
//     include('./view/page/inicio.php');
// }, ['GET']);

// $router->add('/(\w+)', function ($currentFolder) {
// if (file_exists("$currentFolder")) {
//     global $proyect;
//     include('./view/page/inicio.php');
// } else {
//     echo '<h1>No existe la carpeta</h1>';
// }
// }, ['GET']);

$linkStr = str_replace($proyect['name'], '', $_SERVER['REQUEST_URI']);
$link = array_filter(explode('/', $linkStr));
// echo "./data$linkStr";
if (file_exists("./data/$linkStr") and $linkStr != '/' and $linkStr != '/data') {
    $currentFolder = "./data$linkStr";
    include('./view/page/inicio.php');
} else {
    $currentFolder = './data';
    include('./view/page/inicio.php');
}

// for ($i = 0; $i < count($link); $i++) {
//     $folder = trim($link[$i]);
// }

// ERROR 404
// $router->add('/.*', function () {
//     global $proyect;
//     echo "404 error";
// });

// EJECUTAR RUTAS
// $router->route();
