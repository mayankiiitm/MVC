<?php
/**
* 
*/
class Home
{
	function home1(){	
		 $data3['title']='test';
		 $data3['h1']='testing';
		 $data3['message']='This is variable from ';
		 $user=new User;
		 $user=$user->query("insert into videos(title) VALUES('name')");
		 Helper::pre($user);
	}
}
?>