<!DOCTYPE html>
<html>
<head>
	<title>public</title>
	<link rel="stylesheet" type="text/css" href="/gallery/public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/gallery/public/css/custom.css">

</head>
<body>
<?php 
		require_once('../include/initialize.php');
		if(!$session_obj->is_logged_in())
		{
 ?>
	<div class="admin_header">
		<p class="admin_text">Photo Gallery</p>
		<div class="dropdown adjust">
		  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		    Account
		    <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
			<li><a href="/gallery/public/index.php">Home</a></li>		  
		    <li><a href="/gallery/public/login.php">Login</a></li>
		    <li><a href="/gallery/public/account.php">Create Account</a></li>
		    <!-- <li><a href="../logout.php">Logout</a></li> -->
		    <!-- <li><a href="#">Separated link</a></li> -->
		  </ul>
		</div>
		
	</div>
	<?php }

		else if($session_obj->is_logged_in())
		{	
			$user=new User();
			$data=$user->findbyid($session_obj->user_id);

	 ?>
	 <div class="admin_header">
		<p class="admin_text">Photo Gallery</p>
		<div class="dropdown adjust">
		  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" 
		  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		    <?php echo $data[0]['username']; ?>
		    <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
		    <!-- <li><a href="#">Login</a></li> -->
		    <!-- <li><a href="#">Create Account</a></li> -->
		    <li><a href="/gallery/public/index.php">Home</a></li>
		    <li><a href="/gallery/public/logout.php">Logout</a></li>
		    <li><a href="/gallery/public/profile.php">View Profile</a></li>
		  </ul>
		</div>
		</div>

<?php } 
?>

	<!-- <h2>PHOTO GALLERY : Admin Panel</h2> -->
	<script type="text/javascript" src="/gallery/public/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/gallery/public/js/bootstrap.min.js"></script>

</body>
</html>