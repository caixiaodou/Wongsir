<?php
/**
* Coach类
*/
require_once('Person.php');
class Coach extends Person
{
	private $float_CoachID;
	var $String_Introduction;
	var $arr_Member;
	var $arr_CourseID;
	
	function __construct($CoachID)
	{	
		parent::__construct();
		$this->float_CoachID = $CoachID;
		$this->String_Introduction = NULL;
		$this->arr_Member = NULL;
		$this->arr_CourseID = NULL;
		
	}
	function getCoachID()
	{
		return $this->float_CoachID;
	}
}

?>