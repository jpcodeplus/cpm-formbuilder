<?php
use App\core\Router;
$router = new Router($_ENV['APP_URL']);



// Definiere Routen
$router->addRoute('GET', '/', function () {
    echo 'Home';
});
$router->addRoute('GET', '/login', function () {
  include  __DIR__.'/views/login.php';
});

$router->addRoute('POST', '/login', function () {
    var_dump($_POST);
});



// Verarbeite die Anfrage
$router->dispatch();