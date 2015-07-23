<?php

require_once 'manager.php';
        
		$info = new Coach(NULL);
		$info->String_Account = $_POST['Account'];
		$info->float_Identification_Number = $_POST['Identification'];
		$info->String_Name = $_POST['Name'];
		$info->String_Sex = $_POST['Sex'];
		$info->String_Native = $_POST['Native'];
		$info->Date_Birth = $_POST['Birth'];
		$info->String_Address = $_POST['Address'];
		$info->float_Constact = $_POST['Contact'];
		$info->String_Email = $_POST['Email'];
		$info->String_Password = $_POST['Password'];
		$info->String_Introduction = $_POST['Indroduction'];

		$coach = new Manager();
		$test = $coach->AddCoach($info);

?>