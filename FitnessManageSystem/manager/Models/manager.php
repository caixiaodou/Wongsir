<?php
 /*
  action:管理员操作
  */
 require_once("db.php");
 require_once('Coach.php');
 require_once('Course.php');
 require_once('Member.php');
 require_once('MemberCard.php');

 class Manager 
 {  
    
    function __construct()
	{
    
	}
  function AddMember($Member_add_member)
  {
    $database = new DB();
    return $database->addMember($Member_add_member); 
  }
  function AddCourse($Course_add_course)
  {
    $database = new DB();
   $back = $database->addcourse($Course_add_course);
   return $back;
 
  }
  function AddCoach($Coach_add_coach)
  {
    $database = new DB();
    return $database->addCoach($Coach_add_coach);		
  }
  function AddMemberCard($MemberCard_add_membercard)
  {
    $database = new DB();
    return $database->addMemberCard($MemberCard_add_membercard);	
  }
  function ModifyMember($Member_modify_member)
  {
    $database = new DB();
    return $database->setMember($Member_modify_member);
  }  
  function ModifyCourse($Course_modify_course)
  {  
     $database = new DB();
     return $database->setCourse($Course_modify_course);
  }
  function ModifyCoach($Coach_modify_coach)
  { 
     $database = new DB();
     return $database->setCoach($Coach_modify_coach);
  }
  function ModifyMemberCard($MemberCard_modify_membercard)
  { 
     $database = new DB();
     return $database->setMemberCard($MemberCard_modify_membercard);
  }
  function DelMember($Member_del_member)
  {
     $database = new DB();
     $memberid = $Member_del_member->$float_MemberID;
	 return $database->delMember($memberid);
  }
  function DelCourse($Course_del_course)
  {
     $database = new DB();
     $courseid = $Course_del_course->$float_CourseID;
	 return $database->delCourse($courseid);
  }
  function DelCoach($Coach_del_coach)
  {
     $database = new DB();
     $coachid = $Coach_del_coach->$float_CoachID;
	 return $database->delCoach($coachid);
  }
  function DelMemberCard($MemberCard_del_membercard)
  {
     $database = new DB();
     $cardid = $MemberCard_del_membercard->$float_CardID;
	 return $database->delMemberCard($cardid);
  }
  function SearchMember()
  {  
     $database = new DB();
     $arr_member = $database->getAllMember();
	  foreach($arr_member as $value)
	  {
		     $arr_member_search[$i] = $value;
			 $i++;
	  }
	  
	  return $arr_member_search; 
  }
  function SearchCourse()
  {
     $database = new DB();
     $arr_course = $database->getAllCourse();
	 foreach($arr_course as $value)
	 {
		     $arr_course_search[$i] = $value;
			 $i++;
	 }
	 return $arr_course_search;
  }
  function SearchCoach()
  {
     $database = new DB();
     return $database->getAllCoach();
	 $arr_coach = $database->getAllCoach();
	 foreach($arr_course as $value)
	 {
		     $arr_coach_search[$i] = $value;
			 $i++;
	 }
	  return $arr_coach_search;
  }
  function AssessMember()
  {  
      $database = new DB();  
      $i = 0;
      $arr_member = $database->getAllMember();
	  foreach($arr_member as $value)
	  {
	     if($value->int_ApplicationMark == -1)
		 {
		     $arr_member_apply[$i] = $value;
			 $i++;
		 }
	  }
	  return $arr_member_apply;
  }
  function AssessCourse()
  {  
     $database = new DB();
     $i = 0;
     $arr_member = $database->getAllMember();
	 foreach($arr_member as $value)
	 {
		if($value->arr_ChooseCourseID != -1)
		{
		  $arr_member_chooseCourse[$i] = $value;
		  $i++;
		}
	 }
	 return $arr_member_chooseCourse;
  }
  
  function memberAssessing($arr2_member_apply)
  { 
     $database = new DB();
	 foreach($arr2_member_apply as $value)
	 {
	     $value->int_ApplicationMark == 1;
	 }
	 foreach($arr2_member_apply as $value1)
	 {
	     return $database->setMember($value1);
	 }
  }
  
  function courseAssessing($arr2_member)
  {
     $database = new DB();
     foreach($arr2_member as $value)
	 {
	     $value->arr_ChooseCourseID = $value->arr_CourseID;
		 $value->arr_ChooseCourseID = NULL;
	 }
	 foreach($arr2_member as $value1)
	 {
	     return $database->setMember($value1);
	 }
  }
  function DervieSchedule_member()
  {
  }
  function DervieSchedule_course()
  {
  }
  function MemberChange($Member_change_member)
  { 
     $database = new DB();
     return $database->setMember($Member_change_member);
  }
  
 }
 
?>