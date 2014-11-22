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
		$pattern=$this->parser($url);
		$this->url[$pattern[0]]['controller']=$var[0];
		$this->url[$pattern[0]]['method']=$var[1];
		$this->url[$pattern[0]]['args']=$pattern[1];
	}
	function run(){


		$ru=isset($_SERVER['REQUEST_URI'])?rtrim($_SERVER['REQUEST_URI'],'/'):'/';
		if(!$ru)
			$ru='/';
		if ($this->match($ru)) {
			require '../app/controller/'.$this->url[$this->match($ru)]['controller'].'.php';
			$this->controller=new $this->url[$this->match($ru)]['controller'];
			$this->method=$this->url[$this->match($ru)]['method'];
			$this->args=$this->url[$this->match($ru)]['args'];
			preg_match($this->match($ru), $ru, $matches);
			unset($matches[0]);
			if($this->args){
			call_user_func_array(array($this->controller,$this->method), $matches);

			}else{
				call_user_func_array(array($this->controller,$this->method),array());
			}
		}else{
				require '../app/controller/error.php';
		$this->controller=new error;
		}
		



	}



	function parser($route) {
		$args=preg_match_all('/(?<=\/:)([aA-zZ0-9]+)(?=\/|$)/', $route, $matches);
        return array('/^'.str_replace(array(':','/'), array('','\/'), preg_replace('/(?<=\/:)([aA-zZ0-9]+)(?=\/|$)/', '([aA-zZ0-9]+)', $route)).'$/',sizeof($matches[0])?$matches[0]:false);
	}


	function match($route){
		$pattern=array_keys($this->url);
		foreach ($pattern as $regex) {
			if (preg_match($regex, $route)) {
				return $regex;
				break;
			}
		}
		return false;
	}

}
?>