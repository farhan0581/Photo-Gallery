<?php 
	require_once('initialize.php');

	class Session
	{
		private $is_login=false;
		public $user_id;
		public $message;

		function __construct()
		{
			session_start();
			$this->check_login();
			$this->check_message();
		}

		public function is_logged_in()
		{
			return $this->is_login;
		}
		public function login($user)
		{
			if($user)
			{
				$this->user_id=$_SESSION['userid']=$user[0]['id'];
				$this->is_login=true;
			}
		}

		public function logout()
		{
			unset($this->user_id);
			unset($_SESSION['userid']);
			$this->is_login=false;
		}

		public function message($msg="")
		{
			if(!empty($msg))
			{
				$_SESSION['message']=$msg;
			}
			else
			{
				return $this->message;
			}
		}

		private function check_login()
		{
			if(isset($_SESSION['userid']))
			{
				$this->user_id=$_SESSION['userid'];
				$this->is_login=true;
			}
			//session not set so login first
			else
			{
				unset($this->user_id);
				$this->is_login=false;
				//redirect_to('../public/admin/login.php');
			}

		}

		private function check_message()
		{
			if(isset($_SESSION['message']))
			{
				$this->message=$_SESSION['message'];
				unset($_SESSION['message']);
			}
			else
			{
				$this->message="";
			}
		}
	}

	$session_obj=new Session();
	$mess=$session_obj->message();
 ?>