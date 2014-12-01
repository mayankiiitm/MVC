<?php
class User
{
	function save(){
		$details=Input::get();
		$rule=array(
			'access_token'=>'required',
			'gender'=>'required|maxl:1',
			'age'=>'required|min:18|max:30'
			);
		$validate=Validator::validate($details,$rule);
		$user=new Users;
	}
	function login(){
		$user=new Users;
		$id=Input::get('id');
		if(!Validator::validate(array('id'=>$id),array('id'=>'required'))){
			Json::response(array('message'=>'please provide id'));
			return false;
		}
		if($token=$user->generate_token()){
			$sql="UPDATE users set access_token=:access_token WHERE id=:id";
			if($user->update($sql,array('access_token'=>$token,'id'=>$id))){
				$data['data']['token']=$token;
				$data['message']='login successfull';
				}else{
					$data['message']='login unsuccessfull';
				}
		}else{
			$data['data']['message']='Unauthorized Access';
		}
		echo json_encode($data);
	}

}
?>