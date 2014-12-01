<?php
require_once '../app/init.php';
$route=new Route;
$route->get('/users/login','user@login');
$route->run();
?>
