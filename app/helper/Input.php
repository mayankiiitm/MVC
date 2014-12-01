<?php
/**
*			 
*/
class Input 		
{
	public static function get($key=null){
		if(!isset($key)){
			foreach ($_GET as $key => $value) {
				$get[$key]=self::clean($value);
			}
			return $get;
		}
		return self::clean($_GET[$key]);
	}
	public function post($key=null){
		if(!isset($key)){
			foreach ($_POST as $key => $value) {
				$post[$key]=self::clean($value);
			}
			return $post;
		}
		return self::clean($_POST[$key]);
	}

	private static function clean($var=''){
		return $var?htmlspecialchars(strtolower(trim($var))):'';
	}
}
?>