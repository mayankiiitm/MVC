<?php
/**
*			 
*/
class Input 		
{
	public static function get($key=null){
		if(!isset($key)){
			$get=array();
			foreach ($_GET as $key => $value) {
				$get[$key]=self::clean($value);
			}
			return $get;
		}
		return isset($_GET[$key]) ?self::clean($_GET[$key]):null;
	}
	public function post($key=null){
		if(!isset($key)){
			$post=array();
			foreach ($_POST as $key => $value) {
				$post[$key]=self::clean($value);
			}
			return $post;
		}
		return isset($_POST[$key])?self::clean($_POST[$key]):null;
	}

	private static function clean($var=''){
		return $var?htmlspecialchars(strtolower(trim($var))):'';
	}
}
?>