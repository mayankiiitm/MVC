<?php
require_once '../app/init.php';

$route=new Route;
$route->get('/','Home@index');
$route->get('/url1','Home@index');
$route->get('/url2','Home@index1');
$route->get('/userlogin','Login@login1');
$route->run();

?>