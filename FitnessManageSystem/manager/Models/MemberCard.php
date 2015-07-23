<?php

/**
* MemberCardÀà
*/
class MemberCard
{   private $float_CardID;
    var $int_Level;
    var $arr_date_Validity;
	var $float_MemberID;
	var $float_DesMemberID;
 
    function __construct($cardid)
	{   
	    $this->float_CardID = $cardid;
	    $this->int_Level = NULL;
	    $this->arr_date_Validity = NULL;
		$this->float_MemberID = NULL;
		$this->float_DesMemberID = NULL;
	}
	
	function getCardID()
	{
	    return $this->float_CardID;
	}
}


?>
