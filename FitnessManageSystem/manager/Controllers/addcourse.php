<?php
require_once("head.php");
require_once("db.php");

$Course_info=new Course(NULL);
	$Course_info->float_Price=$_POST["Price"];	
	$Course_info->int_Times=$_POST["Times"];
	$Course_info->string_Type=$_POST["Type"];
	$Course_info->string_Introduction= $_POST["Introduction"];
	$Course_info->string_Location=$_POST["Location"];
	//$Course_info->arr_Member==NULL||
	$Course_info->float_CoachID= $_POST["CoachID"];
	$Course_info->arr_date_CourseTime[0]='2009-9-9 23:22:11';
	
$course = new Manager();
$feedback = $course->AddCourse($Course_info);
echo $feedback;
echo"add course sucessfully.";

header("refresh:3;url=index.html");
print('<br>Loading,Please wait...automatically refresh in 3 seconds.');

?>