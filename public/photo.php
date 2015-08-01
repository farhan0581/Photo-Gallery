<?php 

	require_once('../include/photograph.php');
	
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
	

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Photo</title>
 </head>
 <body>
 	<h2>Full Version...</h2>
 	<?php 
 		foreach ($photo as $value) {

 	?>
 	<img src="<?php echo 'images/'.$value['filename']; ?>">
 	<br>
 	<b>Caption::</b>
 	<span><?php echo $value['caption']; ?></span>

 	<?php 
 	} ?>	
 </body>
 </html>