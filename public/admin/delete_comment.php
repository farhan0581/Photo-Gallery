<?php 
	require_once('../../include/initialize.php');
	if(!$session_obj->is_logged_in())
	{
		redirect_to('login_admin.php');
	}
	if(isset($_GET['id']))
	{
		$obj=new Comment();
		$comment=$obj->findbyid($_GET['id']);
		$obj->id=$comment[0]['id'];
		if($comment && $obj->delete())
		{
			redirect_to("comments.php?id={$comment[0]['photo_id']}");
		}
	}
	else
	{
		redirect_to('index.php');
	}
 ?>