<?php

/**
*Course类
*/
class Course
{   
    private $float_CourseID;
    var $float_Price;
    var $int_Times;
    var $string_Type;
    var $string_Introduction;
	var $arr_date_CourseTime;
	var $string_Location;
	var $int_CourseMark;
	var $arr_Member;
	var $float_CoachID;
  
    function __construct($courseid)
	{   
	    $this->float_CourseID = $courseid;
	    $this->float_Price = NULL;
	    $this->int_Times = NULL;
		$this->string_Type = NULL;
		$this->string_Introduction = NULL;  
		$this->arr_date_CourseTime = NULL;
		$this->string_Location = NULL;
		$this->int_CourseMark = NULL;
		$this->arr_Member = NULL;
		$this->float_CoachID = NULL;
	}
	
	function getCourseID()
	{
	    return $this->float_CourseID;
	}
}

?>