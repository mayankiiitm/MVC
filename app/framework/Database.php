<?php
/**
* 
*/
class db
{
	private static $instance=null;
	private function __construct()
	{
		self::$instance=new PDO('mysql:host=127.0.0.1;dbname=givvr','root','');
	}
	function get(){
		if (!isset(self::$instance)) {
			new db;
		}
		return self::$instance;
	}
}
?>