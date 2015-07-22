<?php
	/**
	 * Example Application
	 *
	 * @package Example-application
	 */
	
	// require 'smarty/Smarty.class.php';
	// require_once 'DB/user.php';
	// require_once 'DB/userOperation.php';
	
	
	// $smarty = new Smarty;
	
	// $smarty->debugging = false;
	// $smarty->caching = false;
	// $smarty->cache_lifetime = 120;
	// $smarty->left_delimiter="{";
	// $smarty->right_delimiter="}";
	// //$smarty->template_dir="html";
	// ////$smarty->compile_dir="smarty";
	// //$smarty->compile_dir="template_c";
	// //$smarty->cache_dir="cache";
	
	// $Info=new User();
	
	// $Info->UserName=$_POST['UserName'];
	// $Info->UserTel=$_POST['UserTel'];
	// $Info->Email=$_POST['Email'];
	// $Info->UserPassword=sha1($_POST['UserPassword']);
	// $Info->Sex="保密";
	
	// $user=new UserOperation();
	// $user->addUser($Info);
	
	
	
	
require_once('model/userOperation.php');
$user=new userOperation();
if(isset($_POST['UserTel'])&&$_POST['UserTel']!=""){
	$arr=$_POST;
	$user->userTel=mysql_escape_string($arr['UserTel']);
	$user->userName=$arr['UserName'];
	$user->userPassword=sha1($arr['UserPassword']);
	$user->email=$arr['Email']?$arr['Email']:'@caixiaodou.com';
	$user->regTime=time();
	$row=$user->addUser($user);
	if($row){
	    // echo "<script>alert('测试成功');</script>";
		header('Location:index.php?op=login');
	}else{
		// echo "<script>alert('测试失败');</script>";
		echo "<script>alert('注册失败，请重新注册');</script>";
		$smarty->display('register.html');
	}

}else{
	$smarty->display('register.html');

}



