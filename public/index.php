<?php
require_once '../app/init.php';
$route=new Route;
$route->get('/users','user@save');
$route->get('/users/:id/details/:id1','user@details');
$route->run();
?>
