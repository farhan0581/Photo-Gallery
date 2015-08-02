<?php 

	function log_action($action,$message)
	{
		$logfile="../logs/log.txt";
		if(!file_exists($logfile))
		{
			echo "file does not exsist!!";
		}
		else
		{
			if($handle=fopen($logfile, 'a+'))
			{
				$time=strftime("%d-%m-%Y  %H:%M:%S",time());
				$content="{$time} | {$action} {$message}\n";
				fwrite($handle, $content);
				fclose($handle);
			}
			else
			{
				echo "could not open file!!!";
			}
		}

	}

	function redirect_to($location=NULL)
	{
		if($location!=NULL)
		{
			header("Location:{$location}");
			exit();
		}
	}

	function datetime_to_text($datetime)
	{
		$newtime=strtotime($datetime);
		return strftime("%B %d, %Y at %I:%M %p",$newtime);
	}

 ?>