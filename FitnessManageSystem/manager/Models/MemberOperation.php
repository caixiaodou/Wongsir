<?php

/**
* MemberOperation��
*/
require_once("head.php");
require_once("db.php");

class MemberOperation
{  
   private $float_MemberID;
   //���캯��
   function __construct($memberid)
   {
       $this->float_MemberID = $memberid;
   }
   
   
   //��ѯ��Ϣ
   function Message()
   {
       $database = new DB();
       $info = $database->getMember($float_MemberID);
	   return $info;
   }
   
   //�½���Ա��
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
   
   //�γ�ѡ��
   function CourseSelection()
   {
       $arr_course = $database->getAllCoahc();
	   return $arr_course;
   }
   
   //�����γ̱�
   function DeriveCourseScheduler()
   {
       $database = new DB();
       $info_member = $database->getMember($float_MemberID);
	   return $info_member;
   }
   
   //��ѯ����
   function Scan_Coach()
   {
       $database = new DB();
       $info_member = $database->getMember($float_MemberID);
	   return $info_member;
   }
   
   //�������
   function Join($infos)
   {
       $database = new DB();
	   $bool_isSucess = $database->addMember($infos);
	   return $bool_isSucess;
   }
   
   //�޸���Ϣ
   function Modify()
   {
       $database = new DB();
       $Member_info = new Member($float_MemberID);
	   $bool_isSucess = $database->setMember($float_MemberID, $Member_info);
	   return $bool_isSucess;
   }
   
}

?>



