<?php
require_once("head.php");
require_once("db.php");

$database = new DB();
$result = "@%";
$info = $database->getAllMember();
    foreach($info as $value)
	{
	     $id = $value->getMemberID();
         $str_info = $id."@&".$value->String_Name."@&".$value->String_Sex."@&".$value->float_Constact."@&".$value->int_StateInformation;
		 $result = "$result"."$str_info"."@%";
	}
	echo $result;
?>

