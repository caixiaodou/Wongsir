<?php
class DB
{
	private $db_UserName;
	private $db_Password;
	private $db_Host;
	private $db_DBName;
	
	function __construct()
	{
		$this->db_UserName='root';
		$this->db_Password='root';
		$this->db_Host='localhost';
		$this->db_DBName='caixiaodou';
	}
	
	function __destruct(){}
	
	function addUser($Info)
	{
		@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
		
		if(mysqli_connect_errno())
			return false;
			
		$query="insert into user(userTel,userPassword,userName,sex,email,regTime) 
			values('$Info->userTel','$Info->userPassword','$Info->userName','$Info->sex','$Info->email','$Info->regTime')";	

			// echo "<script>alert('测试');</script>";
		
		$db->query("SET NAMES UTF8");	
		
		$result=$db->query($query);	
			return $result;
			//$result->free();
			$db->close();
	}
	
	function getUser($userTel)
	{
		@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
		
		if(mysqli_connect_errno())
			return false;
			
			
			if (!isset($result)) 
			
		$query="select * from user where user.userTel=$userTel";
		$db->query("SET NAMES UTF8");
		
		$result=$db->query($query);
		
		if(!isset($result))
		{
			return NULL;	
		}
		
		$result_num=$result->num_rows;	
			
		$row=$result->fetch_array(MYSQLI_ASSOC);
		
		return $row;
			
	}
	
}
?>