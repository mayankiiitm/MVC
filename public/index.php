<?php
require_once '../app/init.php';
$route=new Route;
$route->get('/account/login','account@login');
$route->get('/account/register','account@save');
$route->get('/user/:id','user@index');
$route->run();
?>
