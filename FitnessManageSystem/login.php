<?php
require_once("db.php");

session_start(); 

if(!isset($_POST["submit"])){
    exit('非法访问!');
}
$userid = $_POST["Account"];
$password = $_POST["password"];


//检测用户名及密码是否正确
if(  $userid < 15000 )
 {

    $database = new DB();
    $info = $database->getMember($_POST["Account"]);
	if($info == false)
	       echo "用户名输入错误!";
	if($info->String_Password == $_POST["password"])
	{
	  //登陆成功
	  $_SESSION['userid'] = $info->getMemberID();
	  echo $info->String_Name . "登陆成功!";
	  header("refresh:5;url=member/index.html");
	  print('<br>正在加载,请稍等...五秒后自动跳转。');
	  exit;
     }
	 else
	 {
	 exit('登陆失败');
	 }
	
  }
  elseif( $userid < 30000)
  {
    $database = new DB();
    $info = $database->getCoach($_POST["user"]);
	if($info == false)
	       echo "用户名输入错误!";
	if($info->String_Password == $_POST["password"])
	{
	  //登陆成功
	  $_SESSION['userid'] = $info->getCoachID();
	  echo $info->String_Name . "登陆成功!";
	  header("refresh:5;url=coach/index.html");
	  print('<br>正在加载,请稍等...五秒后自动跳转。');
	  exit;
     }
	 else
	 {
	 exit('登陆失败');
	 }
  }
  elseif( $userid == 2014711)
  {
      if($password == "123456")
	  {
	  //登陆成功
	  $_SESSION['userid'] = 2014711;
	  echo "管理员登陆成功!";
	  header("refresh:5;url=manager/index.html");
	  print('<br>正在加载,请稍等...五秒后自动跳转。');
	  exit;
      }
	  else
	  {
	  exit('登陆失败');
	  }
  }

?>