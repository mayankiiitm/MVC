<?php
/**
* 
*/
class View
{
	public static function make($view, $data=null){
		require '../app/view/'.$view.'.php';
	}
}
?>