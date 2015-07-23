<?php
/**
* Person类
*/
class Person
{
	var $float_Identification_Number;
	var $String_Account;
	var $String_Name;
	var $String_Sex;
	var $String_Native;
	var $Date_Birth;
	var $String_Address;
	var $float_Constact;
	var $String_Email;
	var $String_Password;

	function __construct() {
		$this->float_Identification_Number = NULL;
		$this->String_Account = NULL;
		$this->String_Name = NULL;
		$this->String_Sex = NULL;
		$this->String_Native = NULL;
		$this->Date_Birth = NULL;
		$this->String_Address = NULL;
		$this->float_Constact = NULL;
		$this->String_Email = NULL;
		$this->String_Password = NULL;
	}
}


?>