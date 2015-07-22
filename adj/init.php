<?php
define('ROOT', dirname(__FILE__));
header("content-type:text/html;charset=utf-8");
// include 'config.php';

// global $db;
// $db = @mysql_connect($config['hostname'], $config['user'], $config['password']);
// if (!$db) {
//   echo '数据库连接失败';
//   exit;
// }
// mysql_select_db($config['name']);
// mysql_unbuffered_query('SET NAMES "' . $config['charset'] . '"');

include 'smarty/Smarty.class.php';

global $smarty;
$smarty = new Smarty();
$smarty->setTemplateDir(ROOT . '/views');
$smarty->setCompileDir('/tmp');

session_start();
