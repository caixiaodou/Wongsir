
<?php 
require_once('head.php');

class DB{
	private $db_UserName;
	private $db_Password;
	private $db_Host;
	private $db_DBName;
	
	function __construct(){		
	
		$this->db_UserName='root';
		$this->db_Password='root';
		$this->db_Host='localhost';
		$this->db_DBName='php';
	}
	
	function __destruct(){}
	
	function getMemberIDByAccount($String_Account){
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno()){
				//	echo "Error";
				return NULL;
			}
			//echo $String_Account;
			
			$query="select MemberID from Member where Member.Account='$String_Account'";	
			$db->query("SET NAMES UTF8");			
			$result=$db->query($query);
			if (!isset($result)) 
				return NULL;
	
			
			$row=$result->fetch_assoc();

			$id= stripslashes($row['MemberID']);
			return $id;
			
	}
	
	function getCourse($float_CourseID){
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno()){
				return NULL;
			}
			$query="select * from course where course.CourseID='$float_CourseID'";	// get the basic inforamtion
			$db->query("SET NAMES GBK");			
			$result=$db->query($query);
			if (!isset($result)) 
				return NULL;
			
			$result_num=$result->num_rows;
			
			$row=$result->fetch_assoc();
			
			$Course_info=new Course(stripslashes($row['CourseID']));
			
			$Course_info->float_Price=stripslashes($row['Price']);
			$Course_info->int_Times=stripslashes($row['Times']);
			$Course_info->string_Type=stripslashes($row['Type']);
			$Course_info->string_Introduction=stripslashes($row['Introduction']);
			$Course_info->string_Location=stripslashes($row['Location']);
			$Course_info->float_CoachID=stripslashes($row['CoachID']);
			
			$query="select Coursetime from coursetime where CourseID='$float_CourseID'";	//	get the information about CardID
			$db->query("SET NAMES GBK");			
			$result=$db->query($query);
		
			if (isset($result)) 
			{
				$result_num=$result->num_rows;
				for($i=0;$i<$result_num;$i++){
					$row=$result->fetch_assoc();
					$Course_info->arr_date_CourseTime[$i]=stripslashes($row['Coursetime']);	
				}
			}
			
			$query="select MemberID from choosing where CourseID='$float_CourseID'";	//	get the information about CardID
			$db->query("SET NAMES GBK");			
			$result=$db->query($query);
		
			if (isset($result)) 
			{
				$result_num=$result->num_rows;
				for($i=0;$i<$result_num;$i++){
					$row=$result->fetch_assoc();
					$Course_info->arr_Member[$i]=stripslashes($row['MemberID']);	
				}
			}
			
			$db->close();	
			return $Course_info;
			

	}
	
	function getMember($float_MemberID){
	
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno()){
				//	echo "Error";
				return NULL;
			}
			//	echo "Success to connect";
			
			$query="select * from Member where Member.MemberID='$float_MemberID'";	// get the basic inforamtion
			$db->query("SET NAMES GBK");			
			$result=$db->query($query);
			if (!isset($result)) 
				return NULL;
			
			$result_num=$result->num_rows;

			//echo "The total rows of result: $result_num <br />";

			//for($i=0;$i<$result_num;$i++){
			//	$row=$result->fetch_assoc();
				//echo stripslashes($row['MemberID'])."  ".stripslashes($row['Name'])."  ".stripslashes($row['Birth'])."  ".stripslashes($row['Email'])."  ".stripslashes($row['Sex']);
				//echo '<br />';
				
			//}
			
			$row=$result->fetch_assoc();
			
			$Member_info=new Member(stripslashes($row['MemberID']));
			
			$Member_info->String_Name=stripslashes($row['Name']);
			$Member_info->String_Account=stripslashes($row['Account']);
			$Member_info->float_Identification_Number=stripslashes($row['IdentificationNumber']);
			$Member_info->String_Sex=stripslashes($row['Sex']);
			$Member_info->String_Native=stripslashes($row['Native']);
			$Member_info->Date_Birth=stripslashes($row['Birth']);
			$Member_info->String_Address=stripslashes($row['Address']);
			$Member_info->float_Constact=stripslashes($row['Constact']);
			$Member_info->String_Email=stripslashes($row['Email']);
			$Member_info->String_Password=stripslashes($row['Password']);
			$Member_info->int_ApplicationMark=stripslashes($row['ApplicationMark']);
			$Member_info->String_StateInformation=stripslashes($row['StateInformation']);
			
			//	$query="select CardID from membercardchanging where MemberID='$float_MemberID'";	//	get the information about CardID
			$query="select CardID from membercard where MemberID='$float_MemberID'";	//	get the information about CardID
			$db->query("SET NAMES GBK");			
			$result=$db->query($query);
		
			if (isset($result)) 
			{
				$result_num=$result->num_rows;
				for($i=0;$i<$result_num;$i++){
					$row=$result->fetch_assoc();
					$Member_info->arr_MemberCard_mc[$i]=$this->getMemberCard(stripslashes($row['CardID']));	
				}
			}
			
			$query="select CourseID from choosing where MemberID='$float_MemberID'";	//	get the information about CourseID
			$db->query("SET NAMES GBK");			
			$result=$db->query($query);
			
			if (isset($result)) 
			{		
				$result_num=$result->num_rows;
				for($i=0;$i<$result_num;$i++){
					$row=$result->fetch_assoc();
					$Member_info->arr_CourseID[$i]=stripslashes($row['CourseID']);	
				}
			}
			
			$query="select CoachID from teaching where MemberID='$float_MemberID'";	//	get the information about CoachID
			$db->query("SET NAMES GBK");			
			$result=$db->query($query);
			
			if (isset($result)) 
			{		
				$result_num=$result->num_rows;
				for($i=0;$i<$result_num;$i++){
					$row=$result->fetch_assoc();
					$Member_info->arr_CoachID[$i]=stripslashes($row['CoachID']);	
				}
			}
			
			$query="select CourseID from wanttochoose where MemberID='$float_MemberID'";	//	get the information about Course that the Member want to choose
			$db->query("SET NAMES GBK");			
			$result=$db->query($query);
		
			if (isset($result)) 
			{
				$result_num=$result->num_rows;
				for($i=0;$i<$result_num;$i++){
					$row=$result->fetch_assoc();
					$Member_info->arr_ChooseCourseID[$i]=stripslashes($row['CourseID']);	
				}
			}
			
			//$result->free();
			$db->close();


			
			return $Member_info;

	}
		
				
	function getAllMember(){
	
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno()){
				//	echo "Error";
				return NULL;
			}
			//	echo "Success to connect";
			
			$query="select MemberID from Member" ;	// get all MemberID
			$db->query("SET NAMES GBK");			
			$result=$db->query($query);
			if (!isset($result)) 
				return NULL;
			
			$result_num=$result->num_rows;
			
			//echo "$result_num";
			
			$arr_MemID=NULL;
			for($i=0;$i<$result_num;$i++){
				$row=$result->fetch_assoc();
				$arr_MemID[$i]=stripslashes($row['MemberID']);	
			}	
			
			//$result->free();
			$db->close();
			
			$arr_Member=NULL;	//	get all Member information
			for($i=0;$i<$result_num;$i++){
				$arr_Member[$i]=$this->getMember($arr_MemID[$i]);	
			}
			
			return $arr_Member;
			
	}
	
	
	function getCoach($float_CoachID){
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno()){
				//	echo "Error";
				return NULL;
			}
			//	echo "Success to connect";
			
			$query="select * from Coach where CoachID='$float_CoachID'";	// get the basic inforamtion
			$db->query("SET NAMES GBK");			
			$result=$db->query($query);
			if (!isset($result)) 
				return NULL;
			
			$result_num=$result->num_rows;


			
			$row=$result->fetch_assoc();
			
			$Coach_Info=new Coach(stripslashes($row['CoachID']));
			
			$Coach_Info->String_Name=stripslashes($row['Name']);
			$Coach_Info->String_Account=stripslashes($row['Account']);
			$Coach_Info->float_Identification_Number=stripslashes($row['IdentificationNumber']);
			$Coach_Info->String_Sex=stripslashes($row['Sex']);
			$Coach_Info->String_Native=stripslashes($row['Native']);
			$Coach_Info->Date_Birth=stripslashes($row['Birth']);
			$Coach_Info->String_Address=stripslashes($row['Address']);
			$Coach_Info->float_Constact=stripslashes($row['Constact']);
			$Coach_Info->String_Email=stripslashes($row['Email']);
			$Coach_Info->String_Password=stripslashes($row['Password']);
			$Coach_Info->String_Introduction=stripslashes($row['Introduction']);
			
			$query="select MemberID from teaching where CoachID='$float_CoachID'";	//	get the information about MemberID
			$db->query("SET NAMES GBK");			
			$result=$db->query($query);
		
			if (isset($result)) 
			{
				$result_num=$result->num_rows;
				for($i=0;$i<$result_num;$i++){
					$row=$result->fetch_assoc();
					$Coach_Info->arr_Member[$i]=stripslashes($row['MemberID']);	
				}
			}
			
			$query="select CourseID from course where CoachID='$float_CoachID'";	//	get the information about CourseID
			$db->query("SET NAMES GBK");			
			$result=$db->query($query);
		
			if (isset($result)) 
			{
				$result_num=$result->num_rows;
				for($i=0;$i<$result_num;$i++){
					$row=$result->fetch_assoc();
					$Coach_Info->arr_CourseID[$i]=stripslashes($row['CourseID']);	
				}
			}
			
			//$result->free();
			$db->close();


			
			return $Coach_Info;
			

	
	}
	
	
	function getAllCoach(){
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno()){
				//	echo "Error";
				return NULL;
			}
			//	echo "Success to connect";
			
			$query="select CoachID from Coach" ;	// get all CoachID
			$db->query("SET NAMES GBK");			
			$result=$db->query($query);
			if (!isset($result)) 
				return NULL;
			
			$result_num=$result->num_rows;
			
			//echo "$result_num";
			
			$arr_CoaID=NULL;
			for($i=0;$i<$result_num;$i++){
				$row=$result->fetch_assoc();
				$arr_CoaID[$i]=stripslashes($row['CoachID']);	
			}	
			
			$result->free();
			$db->close();
			
			$arr_Coach=NULL;	//	get all Member information
			for($i=0;$i<$result_num;$i++){
				$arr_Coach[$i]=$this->getCoach($arr_CoaID[$i]);	
			}
			
			return $arr_Coach;	
	}

	function getMemberCard($float_CardID){
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno()){
				return NULL;
			}
			
			$query="select * from MemberCard where MemberCard.CardID='$float_CardID'";	// get the basic inforamtion
			$db->query("SET NAMES GBK");			
			$result=$db->query($query);
			if (!isset($result)) 
				return NULL;
			
			$result_num=$result->num_rows;	
			
			$row=$result->fetch_assoc();
			
			$Card_info=new MemberCard(stripslashes($row['CardID']));
			
			$Card_info->int_Level=stripslashes($row['Level']);
			$Card_info->date_Validity=stripslashes($row['Validity']);
			$Card_info->float_MemberID=stripslashes($row['MemberID']);
			$Card_info->float_DesMemberID=stripslashes($row['Des_MemberID']);
			
			//$result->free();
			$db->close();

			return $Card_info;
	
	}
	
	function addMember($Member_info){
			if($Member_info->float_Identification_Number==NULL||$Member_info->String_Account==NULL||$Member_info->String_Password==NULL||$Member_info->String_Name==NULL||$Member_info->String_Sex==NULL||
			$Member_info->String_Native==NULL||$Member_info->Date_Birth==NULL||$Member_info->String_Address==NULL||$Member_info->float_Constact==NULL||$Member_info->String_Email==NULL||
			$Member_info->int_ApplicationMark==NULL||$Member_info->int_StateInformation==NULL)	//	check if it is legal
			{
				echo 'False!';
				return false;
			}
				
	
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno())
				return false;
			
			echo "$Member_info->String_Address";
			
			$query="insert into Member(IdentificationNumber,Account,Name,Sex,Native,Birth,Address,Constact,Email,Password,
			StateInformation,ApplicationMark) values($Member_info->float_Identification_Number,'$Member_info->String_Account',
			'$Member_info->String_Name','$Member_info->String_Sex','$Member_info->String_Native','$Member_info->Date_Birth',
			'$Member_info->String_Address',$Member_info->float_Constact,'$Member_info->String_Email',
			'$Member_info->String_Password','$Member_info->int_StateInformation',$Member_info->int_ApplicationMark)";		// Add the basic inforamtion
			
			$db->query("SET NAMES UTF8");			
			$result=$db->query($query);
			
			$query="select MemberID from Member where Member.IdentificationNumber='$Member_info->float_Identification_Number'";	// get the MemberID
			$db->query("SET NAMES GBK");			
			$result=$db->query($query);
			if (!isset($result)) 
				return NULL;
			
			$row=$result->fetch_assoc();
			
			$MemberID=stripslashes($row['MemberID']);
			
			//echo 'MemberID'.$MemberID;
			if($Member_info->arr_MemberCard_mc!=NULL){			//	add the MemberCard
				foreach($Member_info->arr_MemberCard_mc as $value){
					$value->float_MemberID=$MemberID;
					$this->addMemberCard($value);
					//echo $value;
					//$query="insert into membercardchanging(MemberID,CardID) values($MemberID,$value)";
					//$db->query("SET NAMES UTF8");			
					//$result=$db->query($query);
				}

			}
			
			if($Member_info->arr_CourseID!=NULL){		// add the Course
				foreach($Member_info->arr_CourseID as $value){
					//echo $value;
					$query="insert into choosing(MemberID,CourseID) values($MemberID,$value)";
					$db->query("SET NAMES UTF8");			
					$result=$db->query($query);
				}

			}

			if($Member_info->arr_CoachID!=NULL){		//	add the Coach
				foreach($Member_info->arr_Coach as $value){
					//echo $value;
					$query="insert into teaching(MemberID,CoachID) values($MemberID,$value)";
					$db->query("SET NAMES UTF8");			
					$result=$db->query($query);
				}

			}			
			
			//$result->free();
			$db->close();
			//echo "Success!";
			return true;
			
	
	
	}

	function addCoach($Coach_info){
			if($Coach_info->float_Identification_Number==NULL||$Coach_info->String_Account==NULL||
			$Coach_info->String_Password==NULL||$Coach_info->String_Name==NULL||$Coach_info->String_Sex==NULL||
			$Coach_info->String_Native==NULL||$Coach_info->Date_Birth==NULL||$Coach_info->String_Address==NULL||
			$Coach_info->float_Constact==NULL||$Coach_info->String_Email==NULL||
			$Coach_info->String_Introduction==NULL)	//	check if it is legal
			{
				//echo 'False!';
				return false;
			}
				
	
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno())
				return false;
				
			
			$query="insert into Coach(IdentificationNumber,Account,Introduction,Name,Sex,Native,Birth,Address,Constact,Email,Password) 
			values($Coach_info->float_Identification_Number,'$Coach_info->String_Account','$Coach_info->String_Introduction',
			'$Coach_info->String_Name','$Coach_info->String_Sex','$Coach_info->String_Native','$Coach_info->Date_Birth',
			'$Coach_info->String_Address',$Coach_info->float_Constact,'$Coach_info->String_Email',
			'$Coach_info->String_Password')";		// Add the basic inforamtion
			
			
			//$query="insert into Coach(IdentificationNumber,Account) values($Coach_info->float_Identification_Number,'$Coach_info->String_Account')";
			$db->query("SET NAMES UTF8");			
			$result=$db->query($query);	
			
			echo $db->error;

			//$result->free();
			$db->close();

			return true;


	}
	
	function addCourse($Course_info){		
			if($Course_info->float_Price==NULL||			//	check if it is legal
				$Course_info->int_Times==NULL||
				$Course_info->string_Type==NULL||
				$Course_info->string_Introduction==NULL||
				$Course_info->arr_date_CourseTime==NULL||
				$Course_info->string_Location==NULL||
				//$Course_info->int_CourseMark==NULL||
				$Course_info->float_CoachID==NULL)
					return false;
		
		
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno())
				return false;
				
			
			//echo "query";
			$query="insert into Course(Price,Times,Type,Introduction,Location,CoachID) 
			values($Course_info->float_Price,'$Course_info->int_Times','$Course_info->string_Type',
			'$Course_info->string_Introduction','$Course_info->string_Location','$Course_info->float_CoachID')";		// Add the basic inforamtion
			
			
			$db->query("SET NAMES UTF8");			
			$result=$db->query($query);	
			
			$query="select @@IDENTITY AS 'CourseID'";	// get the CourseID
			$db->query("SET NAMES GBK");			
			$result=$db->query($query);
			if (!isset($result)) 
				return NULL;
			
			$row=$result->fetch_assoc();
			
			$CourseID=stripslashes($row['CourseID']);
			
			
			
			
			foreach($Course_info->arr_date_CourseTime as $value){
				echo $CourseID;
			
				$query="insert into coursetime(CourseID,CourseTime) values($CourseID,'$value')";
				$db->query("SET NAMES UTF8");			
				$result=$db->query($query);
			}
			
			
			//$result->free();
			$db->close();

			return true;		
	
	}
	
	function addMemberCard($MemberCard_info){
			if($MemberCard_info->int_Level==NULL||			//	check if it is legal
				$MemberCard_info->date_Validity==NULL||
				$MemberCard_info->float_MemberID==NULL)
					return false;
		
		
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno())
				return false;
				
			
			//echo "query";
			$query="insert into MemberCard(MemberID,Level,Validity) 
			values($MemberCard_info->float_MemberID,$MemberCard_info->int_Level,'$MemberCard_info->date_Validity')";		// Add the basic inforamtion
			
			
			$db->query("SET NAMES UTF8");			
			$result=$db->query($query);	
			
			
			
			//$result->free();
			$db->close();

			return true;	
	}

	function delMember($float_MemberID){
			if($float_MemberID==NULL)
				return false;
			
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno())
				return false;
			
			$query="delete from Member where MemberID=$float_MemberID";		//	delete information in Member
			$db->query("SET NAMES UTF8");
			$result=$db->query($query);
			
			$query="delete from teaching where MemberID=$float_MemberID";	//	delete information in other table
			$db->query("SET NAMES UTF8");
			$result=$db->query($query);
			
			$query="delete from choosing where MemberID=$float_MemberID";
			$db->query("SET NAMES UTF8");
			$result=$db->query($query);
			
			$query="delete from wanttochoose where MemberID=$float_MemberID";
			$db->query("SET NAMES UTF8");
			$result=$db->query($query);
			
			$query="delete from membercard where MemberID=$float_MemberID";
			$db->query("SET NAMES UTF8");
			$result=$db->query($query);
			
			$query="update membercard set Des_MemberID=NULL where Des_MemberID=$float_MemberID";
			$db->query("SET NAMES UTF8");
			$result=$db->query($query);
			
			$db->close();

			return true;
	}
	
	function delCoach($float_CoachID){
			if($float_CoachID==NULL)
				return false;
			
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno())
				return false;
			
			$query="delete from Coach where CoachID=$float_CoachID";		//	delete information in Coach
			$db->query("SET NAMES UTF8");
			$result=$db->query($query);
			
			$query="delete from teaching where CoachID=$float_CoachID";	//	delete information in other table
			$db->query("SET NAMES UTF8");
			$result=$db->query($query);
			
			
			$query="update course set CoachID=NULL where CoachID=$float_CoachID";
			$db->query("SET NAMES UTF8");
			$result=$db->query($query);
			
			$db->close();

			return true;
	
	}

	function delCourse($float_CourseID){
			if($float_CourseID==NULL)
				return false;
			
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno())
				return false;
			
			$query="delete from Course where CourseID=$float_CourseID";		//	delete information in Course
			$db->query("SET NAMES UTF8");
			$result=$db->query($query);
			
			$query="delete from coursetime where CourseID=$float_CourseID";	//	delete information in other table
			$db->query("SET NAMES UTF8");
			$result=$db->query($query);
			
			$query="delete from wanttochoose where CourseID=$float_CourseID";	
			$db->query("SET NAMES UTF8");
			$result=$db->query($query);
			
			$query="delete from choosing where CourseID=$float_CourseID";	
			$db->query("SET NAMES UTF8");
			$result=$db->query($query);
			

			
			$db->close();

			return true;
	
	}
	
	function delMemberCard($float_CardID){
	
			if($float_CardID==NULL)
				return false;
			
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno())
				return false;
			
			$query="delete from membercard where CardID=$float_CardID";		//	delete information in MemberCard
			$db->query("SET NAMES UTF8");
			$result=$db->query($query);

			
			$db->close();

			return true;
	}
	
	function setMember($Member_info){
			if($Member_info->float_Identification_Number==NULL||$Member_info->String_Account==NULL||$Member_info->String_Password==NULL||$Member_info->String_Name==NULL||$Member_info->String_Sex==NULL||
			$Member_info->String_Native==NULL||$Member_info->Date_Birth==NULL||$Member_info->String_Address==NULL||$Member_info->float_Constact==NULL||$Member_info->String_Email==NULL||
			$Member_info->int_ApplicationMark==NULL||$Member_info->int_StateInformation==NULL)	//	check if it is legal
			{
				//echo 'False!';
				return false;
			}
				
	
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno())
				return false;
			
			$MemberID=$Member_info->getMemberID();
			$query="update Member set IdentificationNumber=$Member_info->float_Identification_Number,Account='$Member_info->String_Account',
			Name='$Member_info->String_Name',Sex='$Member_info->String_Sex',Native='$Member_info->String_Native',
			Birth='$Member_info->Date_Birth',Address='$Member_info->String_Address',Constact=$Member_info->float_Constact,
			Email='$Member_info->String_Email',Password='$Member_info->String_Password',StateInformation='$Member_info->int_StateInformation',
			ApplicationMark=$Member_info->int_ApplicationMark where MemberID=$MemberID";		// Set the basic inforamtion
			
			$db->query("SET NAMES UTF8");			
			$result=$db->query($query);
			
			
			if($Member_info->arr_MemberCard_mc!=NULL){			//	Set the MemberCard
				foreach($Member_info->arr_MemberCard_mc as $value){
					$value->float_MemberID=$MemberID;
					$this->setMemberCard($value);
					//echo $value;
					//$query="insert into membercardchanging(MemberID,CardID) values($MemberID,$value)";
					//$db->query("SET NAMES UTF8");			
					//$result=$db->query($query);
				}

			}
			
			
			if($Member_info->arr_CourseID!=NULL){		// Set the Course
				foreach($Member_info->arr_CourseID as $value){
					$query="delete from choosing where MemberID=$MemberID";
					$db->query("SET NAMES UTF8");
					$result=$db->query($query);			
					
					$query="insert into choosing(MemberID,CourseID) values($MemberID,$value)";	
					$db->query("SET NAMES UTF8");
					$result=$db->query($query);
				}


			}

			if($Member_info->arr_CoachID!=NULL){		//	Set the Coach
				foreach($Member_info->arr_CoachID as $value){
					//echo $value;
					$query="delete from teaching where MemberID=$MemberID";
					$db->query("SET NAMES UTF8");
					$result=$db->query($query);			
					
					$query="insert into teaching(MemberID,CoachID) values($MemberID,$value)";	
					$db->query("SET NAMES UTF8");
					$result=$db->query($query);
				}
				

			}			
			
			//$result->free();
			$db->close();
			//echo "Success!";
			return true;
			
	}
	
	function setCoach($Coach_info){
			if($Coach_info->float_Identification_Number==NULL||$Coach_info->String_Account==NULL||
			$Coach_info->String_Password==NULL||$Coach_info->String_Name==NULL||$Coach_info->String_Sex==NULL||
			$Coach_info->String_Native==NULL||$Coach_info->Date_Birth==NULL||$Coach_info->String_Address==NULL||
			$Coach_info->float_Constact==NULL||$Coach_info->String_Email==NULL||
			$Coach_info->String_Introduction==NULL)	//	check if it is legal
			{
				//echo 'False!';
				return false;
			}
				
			$CoachID=$Coach_info->getCoachID();
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno())
				return false;
				
			
			$query="update Coach set IdentificationNumber=$Coach_info->float_Identification_Number,Account='$Coach_info->String_Account',
			Introduction='$Coach_info->String_Introduction',Name=$Coach_info->String_Name,Sex='$Coach_info->String_Sex',
			Native='$Coach_info->String_Native',Birth='$Coach_info->Date_Birth',Address='$Coach_info->String_Address',
			Constact=$Coach_info->float_Constact,Email='$Coach_info->String_Email',Password='$Coach_info->String_Password')
			where CoachID=$CoachID)";		// Set the basic inforamtion
			
			
			$db->query("SET NAMES UTF8");			
			$result=$db->query($query);	
			
			if($Coach_info->arr_Member!=NULL){
					$query="delete from teaching where CoachID=$CoachID";
					$db->query("SET NAMES UTF8");
					$result=$db->query($query);	
			foreach($Coach_info->arr_Member as $value){
					$query="insert into teaching(MemberID,CoachID) values($value,$CoachID)";	
					$db->query("SET NAMES UTF8");
					$result=$db->query($query);
					}
			}
			
			if($Coach_info->arr_CourseID!=NULL){
			foreach($Coach_info->arr_CourseID as $value){
					$query="update Course set CoachID=$CoachID where $CourseID=$value)";	
					$db->query("SET NAMES UTF8");
					$result=$db->query($query);
					}
			}
			
			//$result->free();
			$db->close();

			return true;
	
	}
	
	function setCourse($Course_info){
				if($Course_info->float_Price==NULL||			//	check if it is legal
				$Course_info->int_Times==NULL||
				$Course_info->string_Type==NULL||
				$Course_info->string_Introduction==NULL||
				$Course_info->arr_date_CourseTime==NULL||
				$Course_info->string_Location==NULL||
				//$Course_info->int_CourseMark==NULL||
				$Course_info->float_CoachID==NULL)
					return false;
		
		
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno())
				return false;
				
			$CourseID=$Course_info->getCourseID();
			//echo "query";
			$query="update Course set Price=$Course_info->float_Price,Times=$Course_info->int_Times,Type='$Course_info->string_Type',
			Introduction='$Course_info->string_Introduction',Location='$Course_info->string_Location',
			CoachID='$Course_info->float_CoachID' where CourseID=$CourseID";		// Add the basic inforamtion
			
			
			$db->query("SET NAMES UTF8");			
			$result=$db->query($query);	
			
			$query="select @@IDENTITY AS 'CourseID'";	// get the CourseID
			$db->query("SET NAMES GBK");			
			$result=$db->query($query);
			if (!isset($result)) 
				return NULL;
			
			$row=$result->fetch_assoc();
			
			$CourseID=stripslashes($row['CourseID']);
			
			
			
			if($Course_info->arr_date_CourseTime!=NULL){
					$query="delete from coursetime where CourseID=$CourseID";
					$db->query("SET NAMES UTF8");
					$result=$db->query($query);	
			foreach($Course_info->arr_date_CourseTime as $value){
					$query="insert into coursetime(CourseTime,CourseID) values($value,$CourseID)";	
					$db->query("SET NAMES UTF8");
					$result=$db->query($query);
					}
			}
			
			if($Course_info->arr_Member!=NULL){
					$query="delete from choosing where CourseID=$CourseID";
					$db->query("SET NAMES UTF8");
					$result=$db->query($query);	
			foreach($Course_info->arr_Member as $value){
					$query="insert into choosing(MemberID,CourseID) values($value,$CourseID)";	
					$db->query("SET NAMES UTF8");
					$result=$db->query($query);
					}
			}
			
			//$result->free();
			$db->close();

			return true;
	}
	
	function setMemberCard($MemberCard_info){
			if($MemberCard_info->int_Level==NULL||			//	check if it is legal
				$MemberCard_info->date_Validity==NULL||
				$MemberCard_info->float_MemberID==NULL)
					return false;
		
		
			@ $db=new mysqli($this->db_Host,$this->db_UserName,$this->db_Password,$this->db_DBName);
			
			if(mysqli_connect_errno())
				return false;
				
			
			
			$CardID=$MemberCard_info->getCardID();
			//echo $CardID;

			
			if($MemberCard_info->float_DesMemberID!=NULL)
			{
				$query="update membercard set MemberID=$MemberCard_info->float_MemberID,Level=$MemberCard_info->int_Level,
				Validity='$MemberCard_info->date_Validity',Des_MemberID=$MemberCard_info->float_DesMemberID where CardID=$CardID";		// Set the basic inforamtion
				
				$db->query("SET NAMES UTF8");			
				$result=$db->query($query);	
			}
			else
			{
				$query="update membercard set MemberID=$MemberCard_info->float_MemberID,Level=$MemberCard_info->int_Level,
				Validity='$MemberCard_info->date_Validity',Des_MemberID=NULL where CardID=$CardID";		// Set the basic inforamtion
				
				$db->query("SET NAMES UTF8");			
				$result=$db->query($query);		
			}

			echo $db->error;
			
			$db->close();

			return true;
	
	}
	
}







$dbobj=new DB();
/*
$Member_info=$dbobj->getCourse(4002);

		echo	$Member_info->float_CoachID;
		echo	$Member_info->float_Price;
		echo	$Member_info->int_Times;
		echo	$Member_info->string_Location;
		echo	$Member_info->string_Type;
		echo	$Member_info->string_Introduction;

		echo '<br />';


*/


/*
$Member_info=$dbobj->getMember(100);

		echo	$Member_info->String_Name;
		echo	$Member_info->String_Account;
		echo	$Member_info->float_Identification_Number;
		echo	$Member_info->String_Sex;
		echo	$Member_info->String_Native;
		echo	$Member_info->Date_Birth;
		echo	$Member_info->String_Address;
		echo	$Member_info->float_Constact;
		echo	$Member_info->String_Email;
		echo	$Member_info->String_Password;
		echo '<br />';
		
		if($Member_info->arr_CourseID!=NULL){
			foreach ($Member_info->arr_MemberCard_mc as $value)
			{
				echo $value . "<br />";
			}
		}
		
		if($Member_info->arr_CourseID!=NULL){
			foreach ($Member_info->arr_CourseID as $value)
			{
			  echo $value . "<br />";
			}
		}
		
		if($Member_info->arr_CoachID!=NULL){
			foreach ($Member_info->arr_CoachID as $value)
			{
			  echo $value . "<br />";
			}
		}
		
		if($Member_info->arr_ChooseCourseID!=NULL){
			foreach ($Member_info->arr_ChooseCourseID as $value)
			{
			  echo $value . "<br />";
			}
		}
		
		*/
		
		/*
		$arr_Mem=$dbobj->getAllMember();
		foreach ($arr_Mem as $Member_info)
		{
			echo	$Member_info->String_Name;
			echo	$Member_info->String_Account;
			echo	$Member_info->float_Identification_Number;
			echo	$Member_info->String_Sex;
			echo	$Member_info->String_Native;
			echo	$Member_info->Date_Birth;
			echo	$Member_info->String_Address;
			echo	$Member_info->float_Constact;
			echo	$Member_info->String_Email;
			echo	$Member_info->String_Password;
			echo '<br />';
			
			if($Member_info->arr_MemberCard_mc!=NULL){
				foreach ($Member_info->arr_MemberCard_mc as $value)
				{
				  echo $value->getCardID() . "<br />";
				}
			}
			
			if($Member_info->arr_CourseID!=NULL){
				foreach ($Member_info->arr_CourseID as $value)
				{
				  echo $value . "<br />";
				}
			}
			
			if($Member_info->arr_CoachID!=NULL){
				foreach ($Member_info->arr_CoachID as $value)
				{
				  echo $value . "<br />";
				}
			}
		}
		*/
		
		
		/*
		$Member_info=$dbobj->getCoach(20003);

		echo	$Member_info->String_Name;
		echo	$Member_info->String_Account;
		echo	$Member_info->float_Identification_Number;
		echo	$Member_info->String_Sex;
		echo	$Member_info->String_Native;
		echo	$Member_info->Date_Birth;
		echo	$Member_info->String_Address;
		echo	$Member_info->float_Constact;
		echo	$Member_info->String_Email;
		echo	$Member_info->String_Password;
		echo '<br />';
		
		if($Member_info->arr_CourseID!=NULL){
			foreach ($Member_info->arr_CourseID as $value)
			{
				echo $value . "<br />";
			}
		}
		
		if($Member_info->arr_Member!=NULL){
			foreach ($Member_info->arr_Member as $value)
			{
			  echo $value . "<br />";
			}
		}
		*/
		
	/*
	$arr_Mem=$dbobj->getAllCoach();
		foreach ($arr_Mem as $Member_info)
		{
			echo	$Member_info->String_Name;
			echo	$Member_info->String_Account;
			echo	$Member_info->float_Identification_Number;
			echo	$Member_info->String_Sex;
			echo	$Member_info->String_Native;
			echo	$Member_info->Date_Birth;
			echo	$Member_info->String_Address;
			echo	$Member_info->float_Constact;
			echo	$Member_info->String_Email;
			echo	$Member_info->String_Password;
			echo '<br />';
			
			if($Member_info->arr_CourseID!=NULL){
				foreach ($Member_info->arr_CourseID as $value)
				{
					echo $value . "<br />";
				}
			}
			
			if($Member_info->arr_Member!=NULL){
				foreach ($Member_info->arr_Member as $value)
				{
				  echo $value . "<br />";
				}
			}
		}
		*/		
	
	/*
	$Card_info=$dbobj->getMemberCard(6699);	
	echo	$Card_info->int_Level;
	echo	$Card_info->date_Validity;
	echo	$Card_info->float_MemberID;
	*/
	
	/*
	$Member_info=new Member(NULL);
	$Member_info->float_Identification_Number=412312312;
	$Member_info->String_Account='京客隆';
	$Member_info->String_Password='qwer';
	$Member_info->String_Name='莫立恒二号';
	$Member_info->String_Sex='男';
	$Member_info->String_Native='澳大利亚';
	$Member_info->Date_Birth=date("Y-m-d", time());
	$Member_info->String_Address='v刹徐朝鲜族';
	$Member_info->float_Constact=33331;
	$Member_info->String_Email='231@3123.com';
	$Member_info->int_ApplicationMark=1;
	$Member_info->int_StateInformation=1;
	
	$Card_info=new MemberCard(NULL);
	$Card_info->int_Level=1;
	$Card_info->date_Validity='2020-3-28';
	
	$Member_info->arr_MemberCard_mc[0]=$Card_info;
	$Member_info->arr_CourseID[0]=2345;
	
	$dbobj->addMember($Member_info);
	
	*/
	
	/*
	
	$Member_info=new Coach(NULL);
	$Member_info->float_Identification_Number=412312312;
	$Member_info->String_Account='京客隆';
	$Member_info->String_Password='qwer';
	$Member_info->String_Name='莫立恒二号';
	$Member_info->String_Sex='男';
	$Member_info->String_Native='澳大利亚';
	//$Member_info->Date_Birth=date("Y-m-d", time());
	$Member_info->Date_Birth=date("1993-10-10");
	$Member_info->String_Address='v刹徐朝鲜族';
	$Member_info->float_Constact=33331;
	$Member_info->String_Email='231@3123.com';
	$Member_info->String_Introduction='在笼子里在泷泽萝拉';

	
	$dbobj->addCoach($Member_info);
	*/
	
	
	/*
	$Course_info=new Course(NULL);
	$Course_info->float_Price=21;	
	$Course_info->int_Times=10;
	$Course_info->string_Type="健美";
	$Course_info->string_Introduction="沙发撒旦法撒旦法撒旦法撒旦法撒旦法打撒";
	$Course_info->arr_date_CourseTime[0]=date("Y-m-d h:i:s" ,mktime(0,0,0,1,1,2014));
	$Course_info->arr_date_CourseTime[0]='2009-9-9 23:22:11';
	echo $Course_info->arr_date_CourseTime[0];
	$Course_info->string_Location="sk11";
	//$Course_info->arr_Member==NULL||
	$Course_info->float_CoachID=4242422244242;


	
	$dbobj->addCourse($Course_info);
	*/

	/*
	$MemberCard_info=new MemberCard(NULL);
	$MemberCard_info->int_Level=11;		//	check if it is legal
	$MemberCard_info->date_Validity='2016-2-22';
	$MemberCard_info->float_MemberID=4211;


	
	$dbobj->addMemberCard($MemberCard_info);
	*/
	/*
	$dbobj->delMember(2005);
	*/
	
	/*
	$Member_info=new Member(2006);
	$Member_info->float_Identification_Number=412312312;
	$Member_info->String_Account='京客隆';
	$Member_info->String_Password='qwer';
	$Member_info->String_Name='莫立恒三号';
	$Member_info->String_Sex='女';
	$Member_info->String_Native='美国';
	$Member_info->Date_Birth=date("Y-m-d", time());
	$Member_info->String_Address='v刹徐朝鲜族';
	$Member_info->float_Constact=33331;
	$Member_info->String_Email='231@qq3123.com';
	$Member_info->int_ApplicationMark=1;
	$Member_info->int_StateInformation=1;
	
	$Card_info=new MemberCard(NULL);
	$Card_info->int_Level=1;
	$Card_info->date_Validity='2020-3-28';
	
	$Member_info->arr_MemberCard_mc[0]=$Card_info;
	$Member_info->arr_CourseID[0]=2346;
	
	$dbobj->setMember($Member_info);
	
	*/
	
	/*
	$MemberCard_info=new MemberCard(6703);
	$MemberCard_info->int_Level=11;		//	check if it is legal
	$MemberCard_info->date_Validity='2016-2-22';
	$MemberCard_info->float_MemberID=4211;
	//$MemberCard_info->float_DesMemberID=9090;


	
	$dbobj->setMemberCard($MemberCard_info);
	*/
	
	/*
	echo $dbobj->getMemberIDByAccount('尼玛');
	*/
	
	//echo "Operation";
	
	
	
	
	
	
	
	
	
	
	?>