<?php 

	require_once('../../include/initialize.php');
	$photos=Photograph::findall();
	if(empty($photos))
	{
		echo 'nothing to display';
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Admin photos</title>
 	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
 </head>
 <body>
 	<h2>All Photos</h2>
 		<table class="table table-hover">
 			<tr>
 				<th>Image</th>
 				<th>Filename</th>
 				<th>caption</th>
 				<th>Type</th>
 				<th>Size</th>
 				<th></th>
 			</tr>
 			<?php 

 				foreach ($photos as $value) {
 				?>
 				
 				<tr>
 					<td><img src="<?php echo '../images/'.$value['filename']; ?>" width="200" height="150"></td>
 					<td><?php echo $value['filename']; ?></td>
 					<td><?php echo $value['caption']; ?></td>
 					<td><?php echo $value['type']; ?></td>
 					<td><?php echo $value['size']; ?></td>
 					<td><a href="delete_photo.php?id=<?php echo $value['id']; ?>">Delete</a></td>
 				</tr>
 				<?php 
 				} ?>
 			
 		</table>
 		<br>
 		&nbsp;&nbsp;&nbsp;<b><a href="upload_photo.php">Upload More Photos...</a></b>
 
 </body>
 </html>