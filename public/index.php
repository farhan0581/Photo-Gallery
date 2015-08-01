<?php 
	
	require_once('../include/photograph.php');
	$p=new Photograph();
	$photos=$p->findall();

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
 	<body class="container">
 	<h1>Photo Gallery</h1>
 	<?php
 			foreach ($photos as $value) {
 				//echo $value['id'];
 				?>

 			 	<div style="float:left;margin-left:20px;">
 			 		<a href="photo.php?id=<?php echo $value['id']; ?>">
 			 		<img src="<?php echo 'images/'.$value['filename']; ?>" class="img-rounded" width="200" height="150px">
 			 		</a>
 			 		<br><p><?php echo $value['caption']; ?></p><br>
 			 	</div>


 			 	<?php
 			 } 
 	 ?>	

 </head>
 <body>
 		
 </body>
 </html>
