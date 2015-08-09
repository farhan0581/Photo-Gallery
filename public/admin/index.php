<?php 
	require_once('../../include/initialize.php');
	require_once('../css/admin_header.php');
	if(!$session_obj->is_logged_in())
	{
		redirect_to('login_admin.php');
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Home</title>
 </head>
 <body class="back">
 	<div class="container">
 		<h3>Menu</h3>
 		<br>
 		<h4><a href="list_photo.php" class="linkblack">List Photos</a></h4>
 		<h4><a href="upload_photo.php" class="linkblack">Upload new Photo</a></h4>
 		<h4><a href="logfile.php" class="linkblack">View Log file</a></h4>
 		<h4><a href="logout.php" class="linkblack">Logout</a></h4>
 	
 	</div>
 </body>
 </html>