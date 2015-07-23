<?php
require_once("head.php");
require_once("db.php");
$database = new DB();
$result="@%";
$coachinfo = $database->getAllCoach();
 /* $manager = new Manager();
  $courseinfo = $manager->SearchCourse();*/
   foreach($coachinfo as $value)
    {
    	$id = $value->getCoachID();
       $str_info = $id."@&".$value->String_Name."@&".$value->String_Sex."@&".$value->float_Constact;
	   $result = "$result"."$str_info"."@%";
	   
    }
    //echo $result;
    echo $result;
?>