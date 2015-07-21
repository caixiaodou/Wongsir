<?php
include 'init.php';

$op = isset($_GET['op']) ? $_GET['op'] : 'list';

$isLogin = isset($_SESSION['login']) && $_SESSION['login'] == true;

switch ($op) {
  case 'login':
    if ($isLogin) {
      header('Location: main.php');
    }
    include 'controllers/login.php';
    break;
  case 'list':
    if (!$isLogin) {
      header('Location: main.php?op=login');
    }
    include 'controllers/list.php';
    break;
  case 'add':
    if (!$isLogin) {
      header('Location: main.php?op=login');
    }
    include 'controllers/add.php';
    break;
  case 'edit':
    if (!$isLogin) {
      header('Location: main.php?op=login');
    }
    include 'controllers/edit.php';
    break;
  case 'del':
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
    break;
  default:
    echo '无效操作';
    exit;
}
