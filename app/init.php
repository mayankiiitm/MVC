<?php
require_once 'framework/Route.php';
require_once 'helper/Helper.php';
require_once 'framework/Controller.php';
require_once 'framework/Model.php';
require_once 'framework/Database.php';
require_once 'framework/View.php';

function autoload($class){
	require_once '../app/model/'.$class.'.php';
}
spl_autoload_register('autoload');
?>