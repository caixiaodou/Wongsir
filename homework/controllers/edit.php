<?php
include ROOT . '/user.class.php';

$user = new User();
$userId = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // TODO 输入容错
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $nickname = $_POST['nickname'];
  $sex = $_POST['sex'];
  $age = $_POST['age'];
  $user->update($userId, $username, $password, $nickname, $sex, $age);
  header('Location: main.php');
} else {
  $userInfo = $user->get($userId);
  if ($userInfo) {
    global $smarty;
    $smarty->assign('user', $userInfo);
    $smarty->display('edit.phtml');
  } else {
    echo '<script>alert("无效用户")</script>';
  }
}
