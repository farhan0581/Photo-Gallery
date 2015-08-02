<?php 
	
	require_once('initialize.php');
	Class Comment extends Database
	{
		protected static $table_name="comments";
		protected static $dbfields=array('id','photo_id','created','author','comment');
		public $id;
		public $photo_id;
		public $created;
		public $author;
		public $comment;

		public static function make_comment($photo_id,$author="nobody",$comment="")
		{
			if(!empty($photo_id) && !empty($author) && !empty($comment))
			{
				$com=new Comment();
				$com->photo_id=$photo_id;
				$com->created=strftime("%Y-%m-%d %H:%M:%S",time());
				$com->author=$author;
				$com->comment=$comment;
				
				return $com;
			}
			else
			{
				return false;
			}
		}

		public function find_comment($photo_id)
		{
			global $db;
			$sql="select * from ".self::$table_name." where photo_id=";
			$sql.=$db->mysqlready($photo_id)." order by created ASC";
			$result=$db->query($sql);
			if($result)
			{
				return self::instantiate($result);
			}
			else
			{
				return false;
			}
		}

		public function save()
		{
			return isset($this->id)? $this->update():$this->create();
		}

			//copied from the users class
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
	}
 ?>