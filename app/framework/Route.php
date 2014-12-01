<?php

class Route
{	
	public $pattern=array();
	private $controller;
	private $method;
	private $args;


	private function parse_uri($uri){
		if(!empty($uri)){
			$url=parse_url($uri)['path'];
			$url=urldecode($url);
			$url=rtrim(trim($url),'/');
			$url=strtolower($url);
			return $url?$url:'/';
		}
		return '/';
	}

	private function pattern($route) {
		$route=$this->parse_uri($route);
		$args=preg_match_all('/(?<=\/:)([aA-zZ0-9]+)(?=\/|$)/', $route, $matches);
		return array('pattern' => '/^'.str_replace(array(':','/'), array('','\/'), preg_replace('/(?<=\/:)([aA-zZ0-9]+)(?=\/|$)/', '([aA-zZ0-9]+)', $route)).'$/',
			'args'=>sizeof($matches[0])?$matches[0]:false);
	}


	private function addroute($uri,$param,$verbs='GET'){
		$params=explode('@', $param);
		$pattern=$this->pattern($uri);
		$this->pattern[$pattern['pattern']][$verbs]['controller']=ucfirst(strtolower($params[0]));
		$this->pattern[$pattern['pattern']][$verbs]['method']=strtoupper($params[1]);
		$this->pattern[$pattern['pattern']][$verbs]['args']=$pattern['args'];
	}

	private function match($uri,$verbs){
		$pattern=array_keys($this->pattern);
		foreach ($pattern as $regex) {
			if (preg_match($regex, $uri)) {
				return isset($this->pattern[$regex][$verbs])?$regex:false;
				break;
			}
		}
		return false;
	}

	public function get($uri, $params){
		$this->addroute($uri, $params);
	}

	public function post($uri, $params){
		$this->addroute($uri, $params,'POST');
	}

	public function any($uri, $params){
		$this->addroute($uri, $params);	
		$this->addroute($uri, $params,'POST');
	}

	

	function run(){
		$request_uri=$this->parse_uri($_SERVER['REQUEST_URI']);
		$verbs=$_SERVER['REQUEST_METHOD'];
		if ($regex=$this->match($request_uri,$verbs)) {
			$this->controller=$this->pattern[$regex][$verbs]['controller'];
			$this->method=$this->pattern[$regex][$verbs]['method'];
			preg_match($regex, $request_uri, $this->args);
			unset($this->args[0]);
			$file='../App/Controller/'.$this->controller.'.php';
			if (file_exists($file)) {
				require_once $file;
				call_user_func_array(array(new $this->controller,$this->method), $this->args);
				
			}else{
				throw new Exception("The controller not found", 1);				
			}
		}else{
			require_once '../app/controller/error.php';
		}
		
	}







	

}










