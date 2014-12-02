<?php
class Account
{
	function save(){
		$details=Input::get();
		$user=new Users;
		$rules=array(
			'fb_id'=>'required',
			'name'=>'required|maxl:50',
			'gender'=>'required',
			'longitude'=>'required',
			'latitude'=>'required'
			);
		$validate=Validator::validate($details,$rules);
		if (!$validate) {
			$data['data']['success']=0;
			$data['data']['message']=Validator::error();
			Json::response($data,200);
			return false;
		}

		if($user->insert($details)){
			$data['data']['success']=1;
			$data['data']['message']='User Created succesfully';
			Json::response($data,200);
			return false;
		}
		$data['data']['success']=0;
		$data['data']['message']='Some error Ocuured';
		Json::response($data,503);
	}

	function login(){
		$user=new Users;
		$fb_id=Input::get('fb_id');
		if(!Validator::validate(array('fb_id'=>$fb_id),array('fb_id'=>'required'))){
			Json::response(array('message'=>'please provide fb_id'));
			return false;
		}
		$user_id=$user->user_id($fb_id);
		$token=$user->generate_token($fb_id);
		if ($user_id) {
			$sql="UPDATE users set access_token=:access_token WHERE fb_id=:fb_id";
			if($user->update($sql,array('access_token'=>$token,'fb_id'=>$fb_id))){
				$data['data']['token']=$token;
				$data['message']='login successfull';
				$status=200;
			}else{
				$data['data']['message']='Some problem occured.';
				$status=503;
			}
		}else{
			$data['message']='No user found';
			$status=200;
		}
		Json::response($data,$status);
	}
}
?>