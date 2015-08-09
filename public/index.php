<?php 
	
	require_once('../include/photograph.php');
	require_once('css/general_header.php');
	$p=new Photograph();
	$photos=$p->findall();
	$count=0;

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> -->
 	<link rel="stylesheet" type="text/css" href="/gallery/public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/gallery/public/css/custom.css">
 	<body>
	<br><br>
	<div class="container">
		<div class="row">
		 	<?php
		 			foreach ($photos as $value) {

		 				
		 				?>

		 			 	<div  class="col-lg-3">

		 			 		<a href="photo.php?id=<?php echo $value['id']; ?>" >
		 			 		<img src="<?php echo 'images/'.$value['filename']; ?>" class="img-rounded" width="200" height="150px">
		 			 		</a>
		 			 		<br><p><?php echo $value['caption']; ?></p>
		 			 		
		 			 		<a href="#"><span class="glyphicon glyphicon-thumbs-up"></span></a>
		 			 		<a href=""><span class="glyphicon glyphicon-thumbs-down gadjust"></span></a>
		 			 		<div class="sep"></div>
		 			 	</div>




		 			 	<?php
	// 	 			 	$count=$count+1;
	// 	 			 	if($count!=0 && $count%4==0 )
	// 	 				{
	// 	 					echo '<div class="row">
 // 	<div class="sep"></div>
 // </div>';
	// 	 				}
		 			 } 
			 ?>	
		</div>
 	</div>
 	<!--cript type="text/javascript" src="/gallery/public/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/gallery/public/js/bootstrap.min.js"></script-->
 		
 </body>
 </html>
 



