<?php
/**
* 
*/
class DB
{
	private static $instance=null;
	private function __construct(){
		$instance=new PDO(DRIVER.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASSWORD);
		$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		self::$instance=$instance; 
	}
	function getInstance(){
		if (!isset(self::$instance)) {
			new DB;
		}
		return self::$instance;
	}
}
?>