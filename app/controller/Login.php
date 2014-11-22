<?php
/**
* 
*/
class login
{
	function login1(){
		echo "this is static method";
	}
	function dynamic($id)
	{
		echo $id;
	}
	function dynamic1($id,$id1)
	{
		echo $id + $id1;
	}
}
?>