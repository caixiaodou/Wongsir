<?php
/**
 * Example Application
 *
 * @package Example-application
 */

require 'smarty/Smarty.class.php';
require_once 'DB/user.php';
$smarty = new Smarty;

$smarty->debugging = false;
$smarty->caching = false;
$smarty->cache_lifetime = 120;
$smarty->left_delimiter="{";
$smarty->right_delimiter="}";
//$smarty->template_dir="html";
//$smarty->compile_dir=false;
//$smarty->compile_dir="template_c";
//$smarty->cache_dir="cache";

$smarty->assign('jj','bb');


$smarty->display('caixiaodou.html');

?>
