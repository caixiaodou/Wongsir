<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('class/user.php');

class searchUser extends MY_Controller
{
	function index()
	{
		 $this->ci_smarty->display('index.html');	
	}
}
