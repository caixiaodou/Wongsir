<?php
include 'init.php';

$op = isset($_GET['op']) ? $_GET['op'] : 'caixiaodou';

$isLogin = isset($_SESSION['login']) && $_SESSION['login'] == true;

switch ($op){
	case 'caixiaodou':
    	/*if (!$isLogin) {
      		header('Location: index.php?op=login');
    	}*/
    	include 'controllers/caixiaodou.php';
    	break;
	case 'register':
    	/*if (!$isLogin) {
      		header('Location: main.php?op=login');
    	}*/
    	include 'controllers/register.php';
    	break;
		
	case 'login':
   		if ($isLogin) {
      		header('Location: index.php');
    	}
    	include 'controllers/login.php';
    	break;
    case 'loginout':
      $_SESSION['loginFlag'] = false;
      header('Location: index.php');
      break;
  	case 'member':
    	/*if (!$isLogin) {
      		header('Location: main.php?op=login');
    	}*/
    	include 'controllers/member.php';
    	break;
  	case 'help':
    	/*if (!$isLogin) {
      		header('Location: main.php?op=login');
    	}*/
    	include 'controllers/help.php';
    	break;
  	case 'caidou':
    	if (!$isLogin) {
      		header('Location: index.php?op=login');
    	}
    	include 'controllers/caidou.php';
    	break;
	/*case 'del':
    if (!$isLogin) {
      header('Location: main.php?op=login');
    }
    include 'controllers/del.php';
    break;
  case 'logout':
    $_SESSION['login'] = false;
    header('Location: main.php?op=login');
    // unset($_SESSION['login']);
    // session_destroy();
    break;*/
  default:
    echo '无效操作';
    exit;
}
