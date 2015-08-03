<?php 
	
	class test
	{
		var $name;
		var $age;
		function hello()
		{
			echo "hello called by class ".get_class($this);
		}
		function disvalue()
		{
			echo $this->name."<br>".$this->age;
		}
	}
	$t=new test();
	$t->hello();
	$t->name="farhan";
	$t->age=22;
	$t->disvalue();

 ?>

 $date=$a[0];
			// $time=$a[1];
			// $action=$a[3];
			// $mes=$a[4];

   //           ?>

   //           <table class="table table-bordered table-hover">

   //           <?php 
   //           		if($flag==0)
   //           		{ $flag=1;
   //            ?>
   //          <tr>
   //          	  <th>Date</th>
   //                <th>Time</th>
   //                <th>Action</th>
   //                <th>Message</th>              
   //          </tr>
        		
   //      		<?php 
   //      	        }
   //      		 ?>


   //           <tr>
   //            <td ><?php echo $date;?></td>
   //            <td><?php echo $time;?></td>
   //            <td><?php echo $action;?></td>
   //            <td><?php echo $mes;?></td>

			// </tr>
            
   //        </table>

   //       <?php 