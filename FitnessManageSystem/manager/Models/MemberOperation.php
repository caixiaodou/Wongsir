<?php

/**
* MemberOperation类
*/
require_once("head.php");
require_once("db.php");

class MemberOperation
{  
   private $float_MemberID;
   //构造函数
   function __construct($memberid)
   {
       $this->float_MemberID = $memberid;
   }
   
   
   //查询信息
   function Message()
   {
       $database = new DB();
       $info = $database->getMember($float_MemberID);
	   return $info;
   }
   
   //新建会员卡
  function NewMemberCard()
   {
       $database = new DB();
       $info = new MemberCard(NULL);
	   //$info->int_Level = $_POST["level"];
       //$info->arr_data_Validity = $_POST[["validity"];
	   $info->float_MemberID = $float_MemberID;
       $bool_isSucess = $database->addMemberCard($info);
	   return $bool_isSucess;
   }
   
   //课程选择
   function CourseSelection()
   {
       $arr_course = $database->getAllCoahc();
	   return $arr_course;
   }
   
   //导出课程表
   function DeriveCourseScheduler()
   {
       $database = new DB();
       $info_member = $database->getMember($float_MemberID);
	   return $info_member;
   }
   
   //查询教练
   function Scan_Coach()
   {
       $database = new DB();
       $info_member = $database->getMember($float_MemberID);
	   return $info_member;
   }
   
   //申请入会
   function Join($infos)
   {
       $database = new DB();
	   $bool_isSucess = $database->addMember($infos);
	   return $bool_isSucess;
   }
   
   //修改信息
   function Modify()
   {
       $database = new DB();
       $Member_info = new Member($float_MemberID);
	   $bool_isSucess = $database->setMember($float_MemberID, $Member_info);
	   return $bool_isSucess;
   }
   
}

?>



