<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<title></title>
</head>
<body>


<?php 
$flag=0;
	$logfile="../../logs/log.txt";
	if(file_exists($logfile) && is_readable($logfile) && $handle=fopen($logfile, 'r'))
	{

		while($a=fscanf($handle,"%s\t%s\t%s\t%s\t%s"))
		{
			$date=$a[0];
			$time=$a[1];
			$action=$a[3];
			$mes=$a[4];

             ?>

             <table class="table table-bordered table-hover">

             <?php 
             		if($flag==0)
             		{ $flag=1;
              ?>
            <tr>
            	  <th>Date</th>
                  <th>Time</th>
                  <th>Action</th>
                  <th>Message</th>              
            </tr>
        		
        		<?php 
        	        }
        		 ?>


             <tr>
              <td ><?php echo $date;?></td>
              <td><?php echo $time;?></td>
              <td><?php echo $action;?></td>
              <td><?php echo $mes;?></td>

			</tr>
            
          </table>

         <?php 
		}	
				
	}
	else
	{
		echo "could not open the file!!";
	}


 ?>

 </body>
</html>