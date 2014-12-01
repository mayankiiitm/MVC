<?php
/**
* 
*/
class Validator
{
	public static $error=array();
	public static function validate(Array $input, Array $rules){
		self::$error=false;
		foreach ($rules as $key => $value) {
			$rule=explode('|', $value);
			foreach ($rule as $rule) {
				if (strpos($rule, ':')) {
					$rule=explode(':', $rule);
					$value=isset($input[$key])?$input[$key]:'';
					self::$rule[0]($value,$rule[1],$key);
				}else{
					$value=isset($input[$key])?$input[$key]:'';
					self::$rule($value,$key);
				}
			}
		}
		return !self::$error;
	}
	
	private static function required($value,$key){
		if (empty($value) || !isset($value) || $value=='') {
			self::setError($key, $key.' is required');
			return false;
		}
		return true;
	}
	private static function min($value,$param,$key){
		if($value>=(int)$param){
			return true;
		}
		self::setError($key, $key.' must be at least '.$param);
		return false;
	}
	private static function max($value,$param,$key){
		if($value<=(int)$param){
			return true;
		}
		self::setError($key, $key.' must be less than '.$param);
		return false;
	}
	private static function email($value,$key){
		if(filter_var($value, FILTER_VALIDATE_EMAIL)){
			return true;
		}
		self::setError($key, $key.' must be valid email');
		return false;
	}
	private static function minl($value,$param,$key){
		if(strlen($value)>=$param){
			return true;
		}
		self::setError($key, $key.' shold be at least '.$param.' charecter long');
		return false;
	}
	private static function maxl($value,$param,$key){
		if(strlen($value)<=$param){
			return true;
		}
		self::setError($key, $key.' should not be more than '.$param.' charecter long');
		return false;
	}

	private static function setError($key,$value){
		self::$error[$key]=$value;
	}
}
?>