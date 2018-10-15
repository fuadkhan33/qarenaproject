<?php
	class DBhelper{
		private static $connection;
		static $HOST = "localhost";
		static $USER_NAME = "root"; 
		static $PASSWORD = "";
		static $POST = "";
		static $ERROR = "";
		static $DATABASE_NAME="qarena_db";
		//Constructor will initialize the database connection and if not connected return a error 
		function __construct(){
			if(DBhelper::$connection = mysqli_connect(DBhelper::$HOST,DBhelper::$USER_NAME,DBhelper::$PASSWORD,DBhelper::$DATABASE_NAME)){
				
			} else {
				$this->printError(DBhelper::$ERROR);
			}
			
		}
		//debug function
		//Print error in mysql by sending $ERROR static variable to paramiter
		private function printError(){
			DBhelper::$ERROR ="<p color:red>".mysqli_error(DBhelper::$connection)."</p>"; 
			echo(DBhelper::$ERROR);
		}
		//this function will make the query run easy (it will return a mysqli result variable)
		public function query($sql){
			$result = mysqli_query($sql,DBhelper::$connection);
			$this->printError();
			return($result);
		}
		//this function will give a query assoc to get query result
		public function getAssoc($sql){
			$result = $this->query($sql);
			$assoc = mysqli_fetch_assoc($result);
			return $assoc;
		}
		//this function will return true if any row found in the database
		public function isRowAvilable($sql){
			$result = $this->query($sql);
			if(mysqli_num_rows($result)>0){
				return true;
			} else {
				return false;
			}
		}
		//how many row avialble in a table ------retutn a int-----------
		public function numOfRow($sql){
			$result = $this->query($sql);
			$numberOfRow = mysqli_num_rows($result);
			return $numberOfRow;
		}
		
		//check user is avilable in the database   ------return true or false----
		private function checkUserIsAvilable($userName){
			$sql= "select * from users where user_name='$userName';";
			if($this->isRowAvilable($sql)){
				return true;
			} else {
				return false;
			}
		}
		
		
		//this function will insert a new user to database if avilable if not return flase variable ----return bool------
		public function insertNewNewUserIfNotAvialble($userName,$password){
			$sql = "insert into users(user_name,password) values('$userName','$password');";
			if(!$this->checkUserIsAvilable($userName)){
				$this->query($sql);
				return true;
			} else {
				return false;
			}
		}
		
		
		//this function will check if user previously updated his profile ------return bool-----
		private function isUpdatedBefore($userName){
			$sql= "select * from user_profile where user_name='$userName';";
			$result = $this->query($sql);
			if($this->isRowAvilable($sql)){
				return true;
			} else {
				return false;
			}

		}
		//get users assoc info by natural joining from database------------------------assoc------------------------------
		public function getAllUserAssoc($userName){
			$sql ="select * from users natural join users_profile where user_name='$userName'"; //get all user information
			$assoc = $this->getAssoc($sql);
			return $assoc;
		}
		
		
		//this function will update user profile if user avialable -----return bool--- if not return false                   ////Error in this function
		public function updateProfile($userName,$name,$email,$designation,$state,$country,$phoneNumber,$imagePath){
			if($this->checkUserIsAvilable($userName)){
				if(!$this->isUpdatedBefore()){ //if not updated before
					$sql="insert into users_profile(user_name,name,email,designation,state,country,phone_number,image_path) values('$userName','$name','$email','$designation','$state','$country','$phoneNumber','$imagePath');";
					$this->query($sql);
					return true;
				} else { //if updated before
					$sql="update users_profile(name,email,designation,state,country,phone_number,image_path) values('$name','$email','$designation','$state','$country','$phoneNumber','$imagePath') where user_name='$userName';";
					return true;
				}
			} else {
				return false;
			}
			
		}
		
		//insert qsn into database with image
		public function insertQustion($userName,$qsnHead,$qsnBody,$links,$image_path){
			$sql = "insert into question('user_name','qsn_head','qsn_body','link1','link2','link3','image_path') values('$userName','$qsnHead','$qsnBody','$links[0]','$links[2]','$links[3]','$image_path');";
			return $this->query($sql);
		}
		
		//insert answer into database with image
		public function insertAnswer($qsnId,$userName,$qsnHead,$qsnBody,$links,$image_path){
			$sql = "insert into question('qsn_id',user_name','qsn_head','qsn_body','link1','link2','link3','image_path') values('$qsnId',$userName','$qsnHead','$qsnBody','$links[0]','$links[2]','$links[3]','$image_path');";
			return $this->query($sql);
		}
		
		//like question by one perticular user
		public function likeQuestion($userName,$qsnId){
			$sql = "insert into like_question('user_name','qsn_id') values('$userName','$qsnId');";
			$this->query($sql);
		}
		
		//like answer by a perticular user
		public function likeAnswer($userName,$ansId){
			$sql = "insert into like_answer(user_name,ans_id) values('$userName','$ansId');";
			$this->query($sql);
		}
		
		//dislike answer
		public function dislikeQuestion($userName,$qsnId){
			$sql = "delete from like_question where user_name='$userName' and qsn_id='$qsnId'";
			$this->query($sql);
		}
		
		//dislike answer
		public function dislikeAnswer($userName,$ansId){
			$sql = "delete from like_answer where user_name='$userName' and ans_id='$ansId'";
			$this->query($sql);
		}
		
		//delete question
		public function deleteQustion($qsnId){
			$sql = "delete from question where qsn_id='$qsnId';";
			$this->query($sql);
		}
		
		//delete answer
		public function deleteAnswer($ansId){
			$sql = "delete from answer where ans_id='$ansId';";
			$this->query($sql);
		}
		
		//count question likes
		public function countQuestionLikes($qsnId){
			$sql = "select * from like_question where qsn_id='$qsnId';";
			return $this->numOfRow($sql);
		}
		//count answer likes
		public function countAnswerLikes($ansId){
			$sql = "select * from like_answer where qsn_id='$ansId';";
			return $this->numOfRow($sql);
		}
		//is the owner of question is this
		public function isQsnOwner($userName,$qsnId){
			$sql = "select * from question where user_name='$userName' and qsn_id='$qsnId';";
			if($this->isRowAvilable($sql)){
				return true;
			} else {
				return false;
			}
		}
		//is user is ans owner
		public function isAnsOwner($userId,$ansId){
			$sql = "select * from answer where user_name='$userName' and ans_id='$ansId';";
			if($this->isRowAvilable($sql)){
				return true;
			} else {
				return false;
			}
		}
		
		//can if user can login or not           --------------return bool---------------
		public function canLogin($userName,$password){
			$sql = "select * from users where user_name='$userName' and password='$password';";
			if($this->isRowAvilable($sql)){
				return true;
			} else {
				return false;
			}
		}
		
		
		//get user information  ----------return associative array-------------
		public function getUserInformation($userName){
			$sql = "select * from users_profile where user_name='$userName';";
			$assoc = $this->getAssoc($sql);
			return $assoc;
		}
		
		
		//get search question result    --------------return mysql result--------------
		public function getSearchResult($searchString){
			$sql = "select * from question where qsn_head=%'$searchString'%;";
			$result = $this->query($sql);
			return($result);
		}
		
		//for loop throw assoc get a assoc array every time    --------------return associative array----------------
		public function assocLoop($result){
			$assoc = mysqli_fetch_assoc($result);
			return $assoc;
		}
		
		//is qsn is liked    --------------return bool--------------------
		public function isLikedQuestion($userName,$qsnId){
			$sql = "select * from like_question where user_name='$userName' and qsn_id='$qsnId';";
			if($this->isRowAvilable($sql)){
				return true;
			} else {
				return false;
			}
		}
		
		//is ans is liked    --------------return bool--------------------
		public function isLikedAnswer($userName,$qsnId){
			$sql = "select * from like_answer where user_name='$userName' and ans_id='$qsnId';";
			if($this->isRowAvilable($sql)){
				return true;
			} else {
				return false;
			}
		}
		
		
		//get Random Question fro quiz examination   -------------return assocative assoc array----------------
		public function getRandomQuestionForQuiz(){
			
		}
		//insert into user xam history table ------update user examination hystory return void------
		public function insertUserExamHystory($userName,$marks){
			$sql = "insert into xam_hystory(user_name,marks) values('$userName','$marks');";
			$this->query($sql);
		}
		//check exam perticular ans is correct or not   --------------------return bool-----------
		public function isExamAnsCorrect($qsnId,$ans){
			$sql = "select * from question_for_xam where qsn_id='$qsnId';";
			$assoc = $this->getAssoc($sql);
			if($assoc['correct_ans']==$ans){
				return true;
			} else {
				return false;
			}
		}	
		
		//get users examination hystory    --------------------return mysqli query result variable -----------------
		public function getExamHystoryResult($userName){
			$sql = "select * from xam_hystory where user_name=$userName";
			$result = $this->query($sql);
			return $result;
		}
		
		//this function will help user to registration ----------
		public function registrationUser($userName,$password,$email){
			//insert user if not avilable to users table
			if($this->insertNewNewUserIfNotAvialble($userName,$password)){
				//then update user profile
				if($this->updateProfile($userName,"",$email,"","","","","")){
					return true;
				} else { //can't update user profile return false
					return false;
				}
				
			} else { //cant registraion user 
				return false;
			}
		}
		
		//destructor will close database connection
		function __destruct(){
			mysqli_close(DBhelper::$connection);
		}
	}
?>