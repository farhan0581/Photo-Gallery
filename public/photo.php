<?php 

	require_once('../include/initialize.php');
	
	if(empty($_GET['id']))
	{
		echo "no id";
	}
	$p=new Photograph();
	$photo=$p->findbyid($_GET['id']);
	if(!$photo)
	{
		echo 'no photo';
	}
	
	//comment

	if(isset($_POST['submit']))
	{
		$author=trim($_POST['author']);
		$comment=trim($_POST['comment']);

		$obj=Comment::make_comment($photo[0]['id'],$author,$comment);
		
		if($obj && $obj->save())
		{
			redirect_to("photo.php?id={$photo[0]['id']}");
		}
		else
		{
			echo "error";
		}
	}
	else
	{
		$author="";
		$comment="";
	}

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Photo</title>
 	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
 </head>
 <body class="container">
 	<h2>Full Version...</h2>
 	
 	<img src="<?php echo 'images/'.$photo[0]['filename']; ?>" height="600" width="600">
 	<br>
 	<b>Caption::</b>
 	<span><?php echo $photo[0]['caption']; ?></span>
 	<br>

 	<!-- new comment -->
 	<div class="col-lg-4">
 	<h3>NEW COMMENT</h3>
 	<form method="POST" action="photo.php?id=<?php echo $photo[0]['id']; ?>">
 	NAME:<input class="form-control" type="text" name="author" value="<?php echo $author; ?>">
 	<br>
 	COMMENT:
 	<br>
 	<textarea cols="40" rows="7" class="form-control" name="comment"><?php echo $comment; ?></textarea>
 	<br><br>
 	<input class="btn btn-primary"  type="submit" value="Submit comment" name="submit">
 	<br>	
 	</form>
 	</div>
 </body>
 </html>