<?php
/**
* 
*/
class user
{
	function save(){
		$details=Input::get();
		$rule=array(
			'access_token'=>'required',
			'gender'=>'required|maxl:1',
			'age'=>'required|min:18|max:30'
			);
		$validate=Validator::validate($details,$rule);
		if($validate){
			$user=new Users;
			$user->insert($details);
		}
	}
	function details($i,$j){
		echo $i,$j;
		
	}
}
?>