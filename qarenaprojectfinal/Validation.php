<?php
	include "DBhelper.php";


	class ValidationUser {
		//prvate variables
		private $dbHelper;
		private $error;
		private $success;  //bool variable for successfully work done case
		
		
		//constructor
		public function __construct(){
			$dbHelper = new DBhelper;
			$error = array();
		}
		
		
		//This can make errir as a red Paragraph----------------------return error as a red paragraph string----------------------
		private function setErrorToRedPara($errorText){
			return "<p color:red>".$errorText."</p>";
		}
		
		
		//This can make errir as a green paragraph Paragraph---------------return error as a gren paragraph string------------------
		private function setErrorToGreenPara($errorText){
			return "<p color:red>".$errorText."</p>";
		}
		
		//show error ----------------------return error-------------------
		public function showError(){
			return $this->error;
		}
		
		
		//Login form validation ------------------------return bool------------------------
		public function loginValidation($post){
			//then check if username or password is valid or Not
			$userName = $post['username'];
			$password = $post['password'];
			if(!$this->dbHelper->canLogin($userName,$password)){
				$this->error['login_error'] = $this->setErrorToRedPara("Username Or Password is Error");
			} 
			//if no error return true
			if(!$this->isError()){
				$this->success = true;
			} else {
				$this->success = false;
			}
		}
		
		//this function will check if there is any error--------------------bool----------------------
		public function isError(){
			if(count($this->error)==0){
				return false;
			} else {
				return true;
			}
		}
		
		
		//this function  will return every kind of validation error------------------return $error in a paragraph format----------------
		public  function getError(){
			return $this->error;
		}
		
		
		//is successfully done job-------------------------return bool------------------
		public function isSuccess(){
			return $this->success;
		}
		
		
		
		//Registration form Validation
		public function validateRegistration($userName,$post){
			
			//this will check both password and confirm password
			if(!empty($post['username']) && $post['username']!=$post['c_password']){
				$this->error['password'] = $this->setErrorToRedPara("Password and Confirm Should Be Same");
				$this->error['c_password'] = $this->setErrorToRedPara("Password and Confirm Should Be Same");
			}
			//get username password and email
			$userName=$post['username'];
			$password = $post['password'];
			$email = $post['email'];
			
			//if no error return true
			if(!$this->isError()){ //if there is any error 
				$dbHelper->registrationUser($userName,$password,$email);
				$this->success = true; //this variable is need for if successfully registered or not
				$this->error['success']=$this->setErrorToGreenPara("Successfully Registered"); // successfully registered message
			} else {
				$this->error = false;
			}
		}
		
		//this function will handle for question and ans make string of image file-----------------return image file string if avilable else return empty string--------------
		private function getImagePath($folder,$files){
			$path = "";
				if($files['images']['size']>1000){
					//now done coding for uploading image
					$path=$folder."/".$files['images']['name'];
					$fileName=$files['images']['tmp_name'];
					if(isset($files['images'])){
						if(file_exists($path)){
							$this->error["image"] = $this->setErrorToRedPara("Image File Already Exits");
							$this->success = false;
						} else {
							move_uploaded_file($fileName,$path);
						}

					}
				}
			return $path;
		}
		
		
		
		
		//login form validation 
		public function validateLoginForm($post){
			if($this->dbHelper->canLogin($userName,$password)){
				$this->error['login'] = true;
			} else {
				$this->error['login'] =$this->setErrorToRedPara("Username or Password Field Can Not Be Empty");
			}
		}
		
		//validate Question Form
		/*
			this function will validate answer form first we are going to try to validate all the field then we are going to
			try insert answer to database. if inserted with no error set success to true else false. 
		*/
		public function validateQuestionForm($userName,$post,$files){
			//initalize variable to empty string
			$links = array("","","");
			
			//check links by uneasy ways :)
			if(!empty($post["link1"])){
				$links[0] = $post['link1'];
			}
			if(!empty($post["link2"])){
				$links[1] = $post['link2'];
			}
			if(!empty($post["link3"])){
				$links[2] = $post['link3'];
			}
			//if not error then insert qsn
			if(!$this->isError()){     //check if there is a error
				$question = $post['question'];
				$questionHead = $post['qsn_head'];
				$questionBody = $post['qsn_body'];
				$imagePath =""; //Initial Image Path Is Empty
				$imagePath = getImagePath("Question_Image_Files"/*Folder Name to save Image to */,$files); //get path of image File if Avilable
				if($this->dbHelper->insertQustion($userName,$questionHead,$questionBody,$links,$imagePath)){ //insert qsn information to database
					$this->success = true; //if successfully insert to database set success to true
					$this->error = $this->setErrorToGreenPara("Question Saved Successfully");
				} else {
					$this->success = false; //set success to false
				}
				
			}
			
		}
		
		//validate Ans Form
		/*
			this function will validate answer form first we are going to try to validate all the field then we are going to
			try insert answer to database. if inserted with no error set success to true else false. 
		*/
		public function validateAnswerForm($qsnId,$userName,$post,$files){  //parameter are userName,post and files we also need $qsn id to know which question is this
			//initally initialize all links to empty string
			$links = array("","","");
			
			//check links by uneasy ways :)
			if(!empty($post["link1"]=="")){
				$links[0] = $post['link1'];
			}
			if(!empty($post["link2"]=="")){
				$links[1] = $post['link2'];
			}
			if(!empty($post["link3"]=="")){
				$links[2] = $post['link3'];
			}
			
			//if not error then insert questions
			if(!$this->isError()){     //check if there is a error
				$ansHead = $post['ans_head'];
				$ansBody = $post['ans_body'];
				$imagePath =""; //initial Image Path is Empty 
				$imagePath = getImagePath("Answer_Image_Files" /*Set Image Path Folder */,$files); //get path of image File if Avilable
				if($this->dbHelper->insertAnswer($qsnId,$userName,$ansHead,$ansBody,$links,$imagePath)){ //insert qsn information to database
					$this->success = true; //if successfully insert to database set success to true
					$this->error = $this->setErrorToGreenPara("Answer Submitted Saved Successfully");
				} else {
					$this->success = false; //set success to false
				}
			}
		}
		
		//validate update profile Form it's easy to validate every feild if not empty
		public function validateUpdateProfileForm($userName,$post,$files){ //just need user information which is in post and proile picture is in $files variable
			$imagePath = ""; //set initail image path to empty string 
			$imagePath = $this->getImagePath("User_Profile_Picture",$files);
			if($this->updateProfile($userName,$post['name'],$post['email'],$post['designation'],$post['state'],$post['country'],$post['phone'],$imagePath)){
				$this->success = true;
				$this->error = $this->setErrorToGreenPara("Profile Successfuly Updated");
			} else {
				$this->success = false;
			}
		}
	}
?>