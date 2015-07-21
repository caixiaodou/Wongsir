<?php
include ROOT . '/user.class.php';

$user = new User();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // TODO 输入容错
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $nickname = $_POST['nickname'];
  $sex = $_POST['sex'];
  $age = $_POST['age'];
  $userId = $user->insert($username, $password, $nickname, $sex, $age);
  if ($userId) {
    header('Location: main.php');
  } else {
    echo '<script>alert("插入失败")</script>';
  }
} else {
  global $smarty;
  $smarty->display('add.phtml');
}
