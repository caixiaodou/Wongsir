<?php
/**
* CoachOperation
*/
require_once("head.php");
require_once("db.php");
class CoachOperation
{
	private $float_CoachID;
	
	function __construct($CoachID)
	{
		$this->float_CoachID = $CoachID;

	}

	function getCoachID()
	{
		return $this->float_CoachID;
	}

	public function DeriveCourseSchedule()
	{
		$database = new DB();
		$coach_course = $database->getCoach($this->float_CoachID);
		$arr_CourseID = $coach_course->arr_CourseID;

		return $arr_CourseID; //Course类数组
	}

	public function Message()
	{
	   $database = new DB();
       $info = $database->getCoach($float_CoachID);
	   return $info;
	}

	public function Modify()
	{
	   $database = new DB();
       $Coach_info = new Coach($float_CoachID);
	   $bool_isSucess = $database->setCoach($Coach_info);
	   return $bool_isSucess;
	}

	public function Sacn_Member()
	{

	   $database = new DB();
       $info_coach = $database->getCoach($float_CoachID);
	   return $info_coach;

	}

	public function Register_MemberState($Mark,$MemberID)
	{

		$database = new DB();
		$state_member = $database->getMember($MemberID);
		$state_member->int_StateInformation = $Mark;
		return true;
	}


	
}

?>