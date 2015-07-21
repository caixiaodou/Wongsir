<?php
include ROOT . '/user.class.php';

$user = new User();
$userId = $_GET['id'];

$userInfo = $user->get($userId);
if ($userInfo) {
  $user->delete($userId);
  header('Location: main.php');
} else {
  echo '<script>alert("无效用户")</script>';
}
