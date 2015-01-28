<?php

/*
	PREPARED BY 
						MICHAEL FASIPE	- E:fasipemichael@yahoo.com; T:07438354219
						SIMON JOLLEY 	- T:07595743844
						Red Tag Team
*/

class User
{
	#define status
	const STATUS_INACTIVE = 0;
	const STATUS_ACTIVE = 1;
	const STATUS_PENDING = 2;
	const STATUS_SUSPENDED = 3;
	const STATUS_DELETED = 9;
			
	#define class attribute
	private $isAuthenticated = false;
	private $safePassword = "";
	
	private $userID;
	private $familyMemberID;
	
	private $firstName = "";
	private $middleName = "";
	private $lastName = "";
	private $sex = "";
	private $dobD = "";
	private $dobM = "";
	private $dobY = "";
	private $maritalStatus = "";
	
	private $phone = "";
	private $email = "";
	private $address1 = "";
	private $address2 = "";
	private $postcode = "";
	private $stateID = "";
	private $countryID = "";
	
	private $dateCreated = "";
	private $createdBy = "";
	private $dateUpdated = "";
	private $updatedBy;
	private $status = "";
		
	
	//begin constructor
	function getProperty($propName)
	{
		return $this->$propName;	
	}
	
	function setProperty($propName,$propValue)
	{
		$this->$propName = $propValue;	
	}
	// end constructor
	
	function register()
	{
		$this->dateCreated = @strtotime('now');
		
		$query= "
					INSERT INTO
						
						`familymembers`
						
					SET
					
						`firstName` = '".mysql_real_escape_string($this->firstName)."',
						`lastName` = '".mysql_real_escape_string($this->lastName)."',
						`sex` = '".mysql_real_escape_string($this->sex)."',
						`maritalStatus` = '".mysql_real_escape_string($this->maritalStatus)."',
						`email` = '".mysql_real_escape_string($this->email)."',
						`dateCreated` = '".mysql_real_escape_string($this->dateCreated)."',
						`status` = '".mysql_real_escape_string(self::STATUS_PENDING)."'
				";
		#echo "<pre>".$query."</pre>";	die;
		
		$result = mysql_query($query) or die("SQL Error Occured: ".mysql_error());
		
		$familyMemberID = mysql_insert_id();
		if(!$result)
		{
			return array("errNo"=>mysql_errno(),"errMsg"=>mysql_error());
		}
		else
		{
			$insertUser =   "
								INSERT INTO
										`users`
								SET
										`familyMemberID` = '".mysql_real_escape_string($familyMemberID)."',
										`password` = '".mysql_real_escape_string(md5($this->password))."',
										`dateCreated` = '".mysql_real_escape_string($this->dateCreated)."',
										`status` = '".mysql_real_escape_string(self::STATUS_PENDING)."'
							";
			$userRes = mysql_query($insertUser) or die("SQL Error Occured: ".mysql_error());
			$userID = mysql_insert_id();
		}
		
		return $this->userID = $userID;
	}
	
	function checkAuth($accountHandle = "",$plainPassword = "")
	{
		$this->safePassword = md5($plainPassword);
		$this->isAuthenticated = false;
	
		$checkSQL = 
		"
			SELECT *
					FROM  `users` a
					JOIN  `familymembers` b ON a.familyMemberID = b.id
			
			WHERE 
				b.`email` = '".mysql_real_escape_string($accountHandle)."' AND 
				a.`password` = '".mysql_real_escape_string($this->safePassword)."' AND 
				a.`status` <> '0' AND 
				a.`status` <> '9'
		";
		#echo "<pre>".$checkSQL."</pre>";
		
		$result = mysql_query($checkSQL) or die("SQL Error Occured: ".mysql_error()) ;
	
		if($result && mysql_num_rows($result) == 1)
		{
			#authentication successful!
			$userDetails = mysql_fetch_assoc($result);
			
			$this->familyMemberID = $userDetails['familyMemberID'];
		
			$this->safePassword = $userDetails['password'];
			
			$this->firstName = $userDetails['firstName'];
			$this->middleName = $userDetails['middleName'];
			$this->lastName = $userDetails['lastName'];
			
			$this->sex = $userDetails['sex'];
			$this->dobD = $userDetails['dobD'];
			$this->dobM = $userDetails['dobM'];
			$this->dobY = $userDetails['dobY'];
			$this->maritalStatus = $userDetails['maritalStatus'];
			
			$this->phone = $userDetails['phone'];
			$this->email = $userDetails['email'];
			$this->address1 = $userDetails['address1'];
			$this->address2 = $userDetails['address2'];
			$this->postcode = $userDetails['postcode'];
			$this->stateID = $userDetails['stateID'];
			$this->countryID = $userDetails['countryID'];
			
			$this->dateCreated = $userDetails['dateCreated'];
			
			$this->dateUpdated = $userDetails['dateUpdated'];
			$this->updatedBy = $userDetails['updatedBy'];
			
			$this->status = $userDetails['status'];
			
			$this->isAuthenticated = true;
			
		}	
		else
		{	
			$this->isAuthenticated = false;
		}//end if
	}
	
	function load($userID)
	{
		$query = 
				"
					SELECT *,b.dateCreated as 'bDateCreated',b.updatedBy as 'bUpdatedBy',b.dateUpdated as 'bDateUpdated',b.status as 'bStatus' 
					FROM  `users` a
					JOIN  `familymembers` b ON a.familyMemberID = b.id
					WHERE
						a.`id` = ".mysql_real_escape_string($userID)."
				";
		#echo "<pre>".$query."</pre>";
			
		$result_set = mysql_query($query) or die("<STRONG>SQL Error Occured</STRONG>: ".mysql_error());
		
		$result = mysql_fetch_assoc($result_set);
		
		$this->familyMemberID = $result['familyMemberID'];
		
		$this->safePassword = $result['password'];
		
		$this->firstName = $result['firstName'];
		$this->middleName = $result['middleName'];
		$this->lastName = $result['lastName'];
		
		$this->sex = $result['sex'];
		$this->dobD = $result['dobD'];
		$this->dobM = $result['dobM'];
		$this->dobY = $result['dobY'];
		$this->maritalStatus = $result['maritalStatus'];
		
		$this->phone = $result['phone'];
		$this->email = $result['email'];
		$this->address1 = $result['address1'];
		$this->address2 = $result['address2'];
		$this->postcode = $result['postcode'];
		$this->stateID = $result['stateID'];
		$this->countryID = $result['countryID'];
		
		$this->dateCreated = $result['dateCreated'];
		
		$this->dateUpdated = $result['dateUpdated'];
		$this->updatedBy = $result['updatedBy'];
		
		$this->status = $result['status'];
		
		$this->isAuthenticated = true;
		
		return $result;
	}
	/*
		
	function update()
	{
		$this->lastUpdated = @strtotime("now");
		
		#default status
		$this->status = self::STATUS_ACTIVE;
		
		$query = 
		"
			UPDATE
				
				`users`
				
			SET
			
				`username` = '".mysql_real_escape_string($this->username)."',
				`password` = '".mysql_real_escape_string($this->safePassword)."',
				
				`firstName` = '".mysql_real_escape_string($this->firstName)."',
				`lastName` = '".mysql_real_escape_string($this->lastName)."',
				
				`phone` = '".mysql_real_escape_string($this->phone)."',
				`email` = '".mysql_real_escape_string($this->email)."',
				
				`lastUpdated` = '".mysql_real_escape_string($this->lastUpdated)."',
				`lastUpdatedBy` = '".mysql_real_escape_string($this->lastUpdatedBy)."',
				
				`status` = '".mysql_real_escape_string($this->status)."'
				
			WHERE
			
				`ID` = '".mysql_real_escape_string($this->ID)."'
		";
		
		#echo "<pre>".$query."</pre>";	
				
		$result = mysql_query($query) or die("SQL Error Occured: ".mysql_error());
		
		return $this->ID;
	}
	
	*/
}
?>