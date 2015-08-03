<?php require_once('../../include/initialize.php');
require_once('../css/admin_header.php'); ?>

<!DOCTYPE html>
<html>
<head>
<!-- <link rel="stylesheet" type="text/css" href="../css/admin_header.php"> -->
	<title></title>
</head>
<body class="container">
<h3>Log Details</h3>
<ul class="list-group">
<?php 

  $logfile="../../logs/log.txt";


  if(!$session_obj->is_logged_in())
  {
    redirect_to('login_admin.php');
  }

  if(isset($_GET['clear'])=='true')
  {
    //$logfile='/opt/lampp/htdocs/gallery/logs/log.txt';
    file_put_contents($logfile, '');
    log_action("Logs Cleared","Logs cleared by user id= {$session_obj->user_id}");
    redirect_to('logfile.php');

  }



	if(file_exists($logfile) && is_readable($logfile) && $handle=fopen($logfile, 'r'))
	{

		while(!feof($handle))
		{
      $entry=fgets($handle);
      //echo $entry;
      if(trim($entry)!="")
      {
        ?>
          <li class="list-group-item"><?php echo $entry; ?></li>
        
        <?php
      }
	
		}	
				
	}
	else
	{
		echo "could not open the file!!";
	}


 ?>
  </ul>
  
  <a href="logfile.php?clear=true">Clear Log</a>
 </body>
</html>