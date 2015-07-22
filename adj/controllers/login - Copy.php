<?php

	require 'smarty/Smarty.class.php';
	require_once('DB/user.php');
	require_once('DB/userOperation.php');
	
	$smarty = new Smarty;
	
	$smarty->debugging = false;
	$smarty->caching = false;
	$smarty->cache_lifetime = 120;
	$smarty->left_delimiter="{";
	$smarty->right_delimiter="}";
	
	$Info= new User();
	
	$Info->UserTel=$_POST['UserTel'];
	$Info->UserPassword=sha1($_POST['UserPassword']);
	
	$user=new UserOperation();
	$arr=$user->getUser($Info->UserTel);
	
	
	if($Info->UserPassword==$arr[UserPassword])
	{
		$smarty->display('caixiaodou.html');
	}
	else
	{
		$smarty->display('login.html');	
	}
?>