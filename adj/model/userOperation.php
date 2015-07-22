<?php

require_once('DB.php');
require_once('user.php');

class UserOperation extends user
{
	
	function __construct()
	{

	}
	
	function addUser($Info)
	{
		$user_db=new DB();
		if($user_db->addUser($Info))
			return true;
		else{
			return false;
		}
	}
	
	function modifyUser($Info)
	{
		
	}
	
	function getUser($UserTel)
	{
		$user_db=new DB();
		$result=$user_db->getUser($UserTel);	
		
		return $result;
	}
	
	function getOrder()
	{
		
	}
	
	function cancleOrder()
	{
		
	}
}

?>
