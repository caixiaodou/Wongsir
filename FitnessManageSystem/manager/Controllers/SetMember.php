<?php
require_once("head.php");
require_once("db.php");

$info = new Member(NULL);
$info->float_Identification_Number = $_POST["IdentifyNumber"];
$info->String_Account = $_POST["Account"];
$info->String_Name = $_POST["Name"];
// echo  $info->String_Name;
$info->String_Sex = $_POST["Sex"];
$info->String_Native = $_POST["Native"];
$info->Date_Birth = $_POST["Birth"]; 
 // echo $info->Date_Birth;
$info->String_Address = $_POST["Address"];
$info->float_Constact = $_POST["Contact"];
$info->String_Email = $_POST["Email"];
 // echo $info->String_Email ;
$info->String_Password = $_POST["Password"];
$setmember = new manager();
$feedback = $setmember->setMember($info);
echo $feedback;

?>