<?php
/**
* 
*/
class DB
{
	private static $instance=null;
	private function __construct()
	{
		self::$instance=new PDO('mysql:host=127.0.0.1;dbname=radius','root','');
	}
	function getInstance(){
		if (!isset(self::$instance)) {
			new DB;
		}
		return self::$instance;
	}
}
?>