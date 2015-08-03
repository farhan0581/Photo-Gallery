<?php 
	require_once('../../include/initialize.php');

	require_once('../css/admin_header.php');

	if($session_obj->is_logged_in())
	{
		redirect_to('index.php');
	}

	if(isset($_POST['submit']))
	{
		$user=trim($_POST['name']);
		$pass=trim($_POST['password']);
		$usr_obj=new User();

		$user=$usr_obj->authenticate($user,$pass);
		if($user)
		{
			$session_obj->login($user);
			log_action('Login',"User {$user[0]['username']} logged-in");
			redirect_to('index.php');

		}
		else
		{
			$mess="Username or Password is incorrect!!";	
		}
	}
	else
	{
		$user="";
		$pass="";
	}

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>login</title>
 </head>
 <body class="container">
 	
 	<div class="col-lg-4 col-lg-offset-4 jumbotron">
 		<h4>Admin Login</h4>
 		<br><br>

 		<?php echo display_message($mess); ?>

 		<form method="POST" action="login_admin.php">
 			<input type="text" name="name" placeholder="username" class="form-control" required>
 			<br>
 			<input type="password" name="password" placeholder="password" class="form-control" required>
 			<br>
 			<input type="submit" value="submit" name="submit" class="btn btn-primary">
 		</form>
 	</div>
 </body>
 </html>