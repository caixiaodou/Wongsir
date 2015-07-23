<?php
require_once("head.php");
require_once("db.php");

//$float_courseID = $_POST["id"];
$database = new DB();
//$float_courseID = 4008;
$course_info = $database->getCourse($float_courseID);
$str_info = $course_info->string_Type."@&".$course_info->int_Times."@&".$course_info->float_Price."@&".$course_info->float_CoachID."@&".$course_info->string_Location."@&".$course_info->string_Introduction;
//return $str_info;
echo $str_info;


?>