<?php
	include "Validation.php";
	include "DBhelper.php";
	class Users{
		private $userName;  //for store username
		private $userInfoAssoc; //for store user information
		private $validation; // for validate all user information
		private $dbHelper;   //for database works
		
		//constractor to initiate variables
		function __construct(){
			$dbHelper = new DBhelper();
			$validation = new ValidationUser();
		}
		
		
		
		//get user login to his account
		public function logInRegisterPage();
		
		
		//get register a new user
		public function register();
		
		//get all qustion for user
		public function getAllQsnForUser();
		
		//get own Question
		public function getOwnQuestion();
		
		
		//give quiz page
		public function giveQuiz();
		
		
		//logout
		public function logout();
	}
?>