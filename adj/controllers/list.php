<?php
include ROOT . '/user.class.php';

$user = new User();
$list = $user->getList();

global $smarty;
$smarty->assign('list', $list);
$smarty->display('list.phtml');
