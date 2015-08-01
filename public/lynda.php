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