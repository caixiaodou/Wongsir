<?php

	//require 'smarty/Smarty.class.php';
//	require_once('DB/user.php');
//	require_once('DB/userOperation.php');
//	
//	$smarty = new Smarty;
//	
//	$smarty->debugging = false;
//	$smarty->caching = false;
//	$smarty->cache_lifetime = 120;
//	$smarty->left_delimiter="{";
//	$smarty->right_delimiter="}";
//	
//	$Info= new User();
//	
//	$Info->UserTel=$_POST['UserTel'];
//	$Info->UserPassword=sha1($_POST['UserPassword']);
//	
//	$user=new UserOperation();
//	$arr=$user->getUser($Info->UserTel);
//	
//	
//	if($Info->UserPassword==$arr[UserPassword])
//	{
//		$smarty->display('caixiaodou.html');
//	}
//	else
//	{
//		$smarty->display('login.html');	
//	}

	// global $smarty;
  require_once('model/userOperation.php');
$user=new userOperation();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	// echo "<script>alert('测试');</script>";
	$arr=$_POST;
	$user->userTel=mysql_escape_string($arr['UserTel']); //转义一个字符串用于mysql_query,防sql注入
	
	$user->userPassword=sha1($arr['UserPassword']);
	
	$row=$user->getUser($user->userTel);

	if($row&&$row['userPassword']==$user->userPassword){
	    $_SESSION['loginFlag']=true;
	    $_SESSION['userName']=$row['userName'];
	    $_SESSION['userTel']=$row['userTel'];
		header('Location:index.php');
	}

}else{
	$smarty->display('login.html');

}
// require_once('init.php');
// require_once('model/userOperation.php');

// $user=new userOperation();
// if($_SERVER['REQUEST_METHOD']=='POST'){
// 	$userTel=$_POST['UserTel'];
// }

?>