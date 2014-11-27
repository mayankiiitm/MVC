<?php
require_once '../app/init.php';
$route=new Route;
$ru= $_SERVER['REQUEST_URI'];
//$route->('/home','home@home');
$route->get('/user/:a/:b','home@home2');
$route->get('/user','home@home1');
$route->run();
?>
