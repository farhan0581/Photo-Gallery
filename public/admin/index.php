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
 <body class="container">
 	<div>
 		<h3>Menu</h3>
 		<br>
 		<h4><a href="list_photo.php">List Photos</a></h4>
 		<h4><a href="upload_photo.php">Upload new Photo</a></h4>
 		<h4><a href="logfile.php">View Log file</a></h4>
 		<h4><a href="logout.php">Logout</a></h4>

 	</div>
 </body>
 </html>