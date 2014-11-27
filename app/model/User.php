<?php

class User extends Model{
 public function json($json){
 	return json_encode($json);
 }
}