<?php
/**
* Member类
*/
require_once('Person.php');
class Member extends Person
{
	private $float_MemberID;
	var $int_StateInformation;
	var $int_ApplicationMark;
	var $arr_MemberCard_mc;
	var $arr_CourseID;
	var $arr_CoachID;
	var $arr_ChooseCourseID;
	
	
	function __construct($MemberID)
	{
		parent::__construct();
		$this->float_MemberID = $MemberID;
		$this->int_StateInformation = NULL;
		$this->arr_MemberCard_mc = NULL;
		$this->int_ApplicationMark = NULL;
		$this->arr_CourseID = NULL;
		$this->arr_CoachID = NULL;
		$this->arr_ChooseCourseID = NULL;
	}
	function getMemberID()
	{
		return $this->float_MemberID;
	}
}
?>