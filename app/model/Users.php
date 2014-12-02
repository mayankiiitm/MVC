<?php

class Users extends Model{
	protected $table='users';

	public function generate_token($id){
			return hash('sha256', $id.time());
	}
	public function user_id($fb_id){
		$user=$this->select("SELECT * FROM users WHERE fb_id=:fb_id",array('fb_id'=>$fb_id));
		return $user;
	}

	public function access_token($access_token){
		$user=$this->sql("SELECT * FROM users WHERE access_token=:access_token",array('access_token'=>$access_token));
		return $user->fetch();	
	}
}
