<?php

class Users extends Model{
	protected $table='users';
	public function generate_token(){
		$id=INPUT::get('id');
		$user=$this->select("SELECT id FROM users WHERE id=:id",array('id'=>$id));
		if ($user) {
			return hash('sha256', $id.time());
		}
		return false;
	}
}
