<?php 
	
	require_once('../css/admin_header.php');
	require_once('../../include/initialize.php');
	if(!$session_obj->is_logged_in())
	{
		redirect_to('login_admin.php');
	}
	$max_size=10485760;
	if(isset($_POST['submit']))
	{
		$photo=new Photograph();
		$photo->caption=$_POST['caption'];
		if($photo->attachfile($_FILES['file_upload']))
		{
			echo 'true';
		}
		else
		{
			echo "false";
		}
		if($photo->savephoto())
		{
			echo 'success';
		}
		else
		{
			echo "failure";
		}
	}


 ?>
 <!DOCTYPE html>
 <html>
 <head>
 </head>
 <body>

 	<div class="jumbotron col-lg-8">
 		<h4>Upload Photos</h4>
 		<div class="col-lg-4">
 		<form action="upload_photo.php" method="POST" enctype="multipart/form-data">
 			<input  type="file" name="file_upload">
 			<br>
 			<input class="form-control" placeholder="Caption" name="caption">
 			<br>
 			<input type="submit" class="btn btn-primary" name="submit" value="upload">
 		</form>
 		</div>
 	</div>
 
 </body>
 </html>

