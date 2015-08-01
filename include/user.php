<?php 

require_once('database.php');

class user Extends database
{
	protected static $table_name='users';
	protected static $dbfds=array('id','username','password','firstname','lastname');
	public $firstname;
	public $lastname;
	public $id;
	public $username;
	public $password;

	public function full_name()
	{
		if(isset($this->firstname)&&isset($this->lastname))
		{
			return $this->firstname." ".$this->lastname;
		}
		else 
		{
			return " ";
		}
	}
	public static function authenticate($user,$pass)
	{
		global $db;
		$user=$db->mysqlready($user);
		$pass=$db->mysqlready($pass);
		$sql="select * from users where ";
		$sql.="username='{$user}'";
		$sql.=" and password='{$pass}' LIMIT 1";
		$result=$db->query($sql);

		if(mysqli_num_rows($result)>=1)
		{
			echo "user exists";
		}
		else
		{
			echo "no user found";
		}

	}
	public static function findbyid($id=0)
	{
		global $db;
		$sql="select * from users where id=".$db->mysqlready($id);
		$result=$db->query($sql);
		if(mysqli_num_rows($result)>=1)
		{
			echo "user exists";
		}
		else
		{
			echo "no!!";
		}
	}
	protected function getattributes()
	{
		$attributes=array();
		foreach (self::$dbfds as $fields) 
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
		$db->query($sql);
		if($db->returnid()==$this->id)
		{
			echo "\nsuccessfully inserted";
		}
		else
		{
			echo "\nnot inserted";
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
		}
		else
		{
			echo "\n not deleted";
		}
	}
}
$u=new user();
// $u->authenticate("farhan0581","gdg");
// $u->findbyid(67);
// $u->firstname="hj";
// $u->lastname="ff";
// $u->id=1;
// $u->password="pas";
// $u->username="user";
// $u->delete();

 ?>