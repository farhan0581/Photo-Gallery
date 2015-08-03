<?php
	
	require_once('../../include/initialize.php');
	if(isset($_SESSION['userid']))
	{
		$session_obj->logout();
		$mess="You have successfully logged out!!";
		$session_obj->message($mess);
		redirect_to('login_admin.php');

	}
	else
	{
		redirect_to('login_admin.php');
	} 
 ?>