<?php
require_once("head.php");
require_once("db.php");
$database = new DB();
$result="@%";
$courseinfo = new Course(NULL);
$courseinfo = $database->getAllCourse();
 /* $manager = new Manager();
  $courseinfo = $manager->SearchCourse();*/
   foreach($courseinfo as $value)
    {
	   $id = $value->getCourseID();
       $str_info = $id."@&".$value->string_Type."@&".$value->int_Times."@&".$value->float_Price."@&".$value->float_CoachID;
	   $result = "$result"."$str_info"."@%";
	   
    }
    echo $result;
?>