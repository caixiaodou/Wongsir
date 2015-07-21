<?php
include ROOT . '/user.class.php';

$user = new User();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $userId = $user->auth($username, $password);
  if ($userId) {
    $_SESSION['login'] = true;
    $_SESSION['userId'] = $userId;
    header('Location: main.php');
  } else {
    echo '<script>alert("登录失败")</script>';
  }
} else {
  global $smarty;
  $smarty->display('login.phtml');
}
