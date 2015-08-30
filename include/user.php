<?php 

require_once('database.php');

class user Extends database
{
	protected static $table_name='users';
	protected static $dbfds=array('username','password','firstname','lastname');
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
			//echo "user exists";
			return self::instantiate($result);
		}
		else
		{
			//echo "no user found";
			return false;
		}

	}
	public static function findbyid($id=0)
	{
		global $db;
		$sql="select * from users where id=".$db->mysqlready($id);
		$result=$db->query($sql);
		if(mysqli_num_rows($result)>=1)
		{
			//echo "user exists";
			return self::instantiate($result);
		}
		else
		{
			//echo "no!!";
			return false;
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

	private static function instantiate($result)
	{
		$object=array();
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$object[]=$row;
		}
		return $object;
	}

	public function create($user)
	{
		global $db;
		$count=0;
		$attr=$this->cleanattributes();
		$sql="INSERT INTO ".self::$table_name."(";
		$sql.=join(", ",array_keys($attr));
		$sql.=") SELECT * FROM ( SELECT ";
		foreach ($attr as $value) {
			$count=$count+1;
			$sql.=" '{$value}' as a{$count},";
		}
		$fsql=substr($sql, 0,-1);
		//$sql.=")"
		//$sql.=") SELECT * FROM (SELECT '".join("', '",array_values($attr));
		$fsql.=") AS temp WHERE NOT EXISTS(SELECT * FROM users WHERE username='{$user}')";
		//$sql.=") values('".join("', '",array_values($attr));
		//$sql.="')";
		$db->query($fsql);
		$this->id=$db->returnid();
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