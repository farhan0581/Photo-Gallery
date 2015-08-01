<?php 
	
	require_once('database.php');

	class Photograph extends database
	{
		protected static $table_name="photographs";
		protected static $dbfields=array('id','filename','type','size','caption');
		public $id;
		public $filename;
		public $type;
		public $size;
		public $caption;

		private $temp_path;
		public $errors=array();
		protected $upload_errors=array(

				  UPLOAD_ERR_OK 				=> "No errors.",
				  UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
				  UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
				  UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
				  UPLOAD_ERR_NO_FILE 		=> "No file.",
				  UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
				  UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
				  UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
			);

		public function attachfile($file)
		{
			if(!$file || empty($file) || !is_array($file))
			{
				$this->errors[]="No file uploaded or not array...";
				return False;
			}
			else if($file['error']!=0)
			{
				$this->errors[]=$this->upload_errors[$file['error']];
				return false;
			}
			else
			{
				$this->temp_path=$file['tmp_name'];
				$this->filename   = basename($file['name']);
		  		$this->type       = $file['type'];
		  		$this->size       = $file['size'];
		  		return true;
			}
		}
		public function savephoto()
		{
			if(isset($this->id))
			{
				$this->update();
			}
			else
			{
				if(!empty($this->errors))
				{
					echo "1";
					return false;
				}
				if(strlen($this->caption)>255)
				{
					$this->errors[]="Size of caption exceeds the limit!!";
					echo "2";
					return false;
				}
				if(empty($this->filename) || empty($this->temp_path))
				{
					$this->errors[]="Filename or path not available!!";
					echo "3";
					return false;
				}
				$target_path='/opt/lampp/htdocs/gallery/public/images/'.$this->filename;

				if(file_exists($target_path))
				{
					$this->errors[]="filename alredy exsists!!";echo "4";
					return false;
				}

				if(move_uploaded_file($this->temp_path, $target_path))
				{
					if($this->create())
					{
						unset($this->temp_path);
						return true;
					}
				}
				else
				{
					$this->errors[]="File not uploaded!!";echo "5";
					return false;
				}
			}

		}//end function

		public function destroyphoto()
		{
			if($this->delete())
			{
				$target_path='/opt/lampp/htdocs/gallery/public/images/'.$this->filename;
				if(unlink($target_path))
				{
					echo "1";
				return true;
				}
				else
				{ echo "0";
					return false;
				}
			}
			else
			{
				return false;
			}
		}//end function
	



	//function copied from users


	public static function findbyid($id=0)
	{
		global $db;
		$sql="select * from ".self::$table_name." where id=".$db->mysqlready($id);
		$result=$db->query($sql);
		if(mysqli_num_rows($result)>=1)
		{
			return self::instantiate($result);
		}
		else
		{
			return false;
		}
	}

	public static function findall()
	{
		global $db;
		$sql="select * from ".self::$table_name;
		$result=$db->query($sql);
		return self::instantiate($result);
	}

	private static function instantiate($result)
	{
		$object=array();
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$object[]=$row;
		}
		return $object;
	}
	protected function getattributes()
	{
		$attributes=array();
		foreach (self::$dbfields as $fields) 
		{
			if(property_exists($this, $fields))
			{
				$attributes[$fields]=$this->$fields;
			}
		}
		return $attributes;
	}
	protected function cleanattributes()
	{
		global $db;
		$clean=array();
		$temp=$this->getattributes();
		foreach ($temp as $key => $value)
		 {
			$clean[$key]=$db->mysqlready($value);
		}
		return $clean;
	}

	public function create()
	{
		global $db;
		$attr=$this->cleanattributes();
		$sql="INSERT INTO ".self::$table_name."(";
		$sql.=join(", ",array_keys($attr));
		$sql.=") values('".join("', '",array_values($attr));
		$sql.="')";
		if($db->query($sql))
		{
			$this->id=$db->returnid();
		}
		if($db->returnid()==$this->id)
		{
			echo "\nsuccessfully inserted";
			return true;
		}
		else
		{
			echo "\nnot inserted";
			return false;
		}
	}
	public function update()
	{
		global $db;
		$attr=$this->cleanattributes();
		$attr_pairs=array();
		foreach ($attr as $key => $value)
		 {
			$attr_pairs[]="{$key}='{$value}'";
		}
		$sql="UPDATE ".self::$table_name." SET ";
		$sql.=join(", ",$attr_pairs);
		$sql.=" where id=".$db->mysqlready($this->id);
		$db->query($sql);
		if($db->affectedrows()==1)
		{
			echo "\nupdated";
		}
		else
		{
			echo "\nnot updated";
		}
	}
	public function delete()
	{
		global $db;
		$sql="DELETE FROM ".self::$table_name;
		$sql.=" WHERE id=".$db->mysqlready($this->id);
		$sql.=" LIMIT 1";
		$db->query($sql);
		if($db->affectedrows()==1)
		{
			echo "\nrecord deleted";
			return true;
		}
		else
		{
			echo "\n not deleted";
			return false;
		}
	}

}//endclass
 ?>
