<?php
/**
* 
*/
class DB
{
	private static $instance=null;
	private function __construct()
	{
		self::$instance=new PDO(DRIVER.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASSWORD);
	}
	function getInstance(){
		if (!isset(self::$instance)) {
			new DB;
		}
		return self::$instance;
	}
}
?>