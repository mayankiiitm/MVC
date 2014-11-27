<?php
/**
* 
*/
class Model extends PDO
{
	 function __construct(){
	 	parent::__construct('mysql:host=127.0.0.1;dbname=givvr','root','');
	}

	public function select($sql){
		$sth= $this->prepare($sql);
		$sth->execute();
		$sth=$sth->fetchAll();
		var_dump($sth);
	}
	public function insert($sql){
		
	}
}
