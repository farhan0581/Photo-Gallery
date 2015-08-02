<?php 

	require_once('../../include/initialize.php');
	require_once('../css/admin_header.php');

	if(isset($_GET['id']))
	{
		$obj=new Comment();
		$photo=new Photograph();
		$photo_exsist=$photo->findbyid($_GET['id']);
		if(!$photo)
		{
			echo "no photo";
			redirect_to('index.php');
		}
		$comments=$obj->find_comment($_GET['id']);


	}
	else
	{
		redirect_to('index.php');
	}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>comments</title>

 </head>
 <body class="container">
 <h3>Comments on <?php echo $photo_exsist[0]['filename']; ?></h3>
 <br>
 <br>
 	<div>
 		<table class="table table-hover">
 			<tr>
 				<th>User</th>
 				<th>Comment</th>
 				<th>Time</th>
 				<th></th>
 			</tr>
 			<?php 
 				foreach($comments as $comm)
 				{
 				 ?>
 		
 			<tr>
 				<td><?php echo $comm['author'] ?></td>
 				<td><?php echo $comm['comment']; ?></td>
 				<td><?php echo $comm['created']; ?></td>
 				<td><a href="delete_comment.php?id=<?php echo $comm['id']; ?>">delete</a></td>
 			</tr>

 			<?php } ?>
 		</table>
 	</div>
 
 </body>
 </html>