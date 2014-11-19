<?php 
/**
 * @author    Mayank Kumar <mayankkumariiitm@gmail.com>
 */


class Route
{	
	public $url=array();
	public $controller;
	public $method;

	function get($url, $parameter){
		$var=explode('@', $parameter);
		$this->url[$url]['controller']=$var[0];
		$this->url[$url]['method']=$var[1];
	}
	function run(){
		$ru=isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:'/';
		if (isset($this->url[$ru]['controller'])) {
			require '../app/controller/'.$this->url[$ru]['controller'].'.php';
		$this->controller=new $this->url[$ru]['controller'];
		$method=$this->url[$ru]['method'];
		$this->controller->$method();
		}else{
				require '../app/controller/error.php';
		$this->controller=new error;
		}
		
	}
}
?>