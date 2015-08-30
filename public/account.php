
<?php 
	require_once('../include/initialize.php');
	require_once('css/general_header.php');
	if(isset($_POST['submit']))
	{
		//$name=$_POST['name'];
		$obj=new User();
		$user=$obj->username=trim($_POST['username']);
		$obj->lastname=trim($_POST['lname']);
		$obj->firstname=trim($_POST['fname']);
		$pass=$obj->password=trim($_POST['password']);
		if($obj->create(trim($_POST['username'])))
		{
 			echo '<script type="text/javascript">alert("Account created");</script>';
 			$usr_obj=new User();
			$user=$usr_obj->authenticate($user,$pass);
			if($user)
			{
				$session_obj->login($user);
				log_action('Login',"User {$_POST['username']} logged-in");
				redirect_to('index.php');
			}
 			

		}
		else
		{
			echo '<script type="text/javascript">alert("Account created");</script>'; 
		}

	}

 ?>
 <!DOCTYPE html>
<!--required till here-->
 <html>
 <head>
 	<title>Register</title>
 </head>
 <body class="back">
 	<div class="col-lg-4 col-lg-offset-4">
 	<br>
 	<div class="jumbotron row">
 			<h2 class="register_head">User Registration</h2>
 			<div class="col-lg-8 col-lg-offset-2">
 			<form method="POST" action="account.php">
 				<input type="text" class="form-control" placeholder="First name" required name="fname">
 				<br>
 				<input required type="text" class="form-control" placeholder="Last name" name="lname">
 				<br>
 				<input required type="text" class="form-control" placeholder="User name" name="username">
 				<br>
 				<input required type="password" class="form-control" placeholder="Password" name="password">
 				<br>
 				<input type="submit" class="btn btn-primary" value="Register" name="submit">
 			</form>
 			</div> 
 	</div>
 	</div>
 </body>
 </html>
