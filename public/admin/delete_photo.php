<?php 
	require_once('../../include/initialize.php');
	if(empty($_GET['id']))
	{
		echo "no id";
	}

	$p= new Photograph();
	$photo=$p->findbyid($_GET['id']);
	// foreach ($photo as $value) {
	// 	$p->id=$value['id'];
	// 	$p->filename=$value['filename'];
	// }

	$p->id=$photo[0]['id'];
	$p->filename=$photo[0]['filename'];
	
	if($photo && $p->destroyphoto())
	{
		echo 'photo deleted';
		redirect_to('list_photo.php');
	}
	else
	{
		echo 'photo not deleted';
	}


 ?>