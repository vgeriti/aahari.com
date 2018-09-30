<?php
class DBConnect{
	
private $host;
private $username;
private $password;
private $database;

var $db;

public function connect($set_host, $set_username, $set_password, $set_database){
    $this->host = $set_host;
    $this->username = $set_username;
    $this->password = $set_password;
    $this->database = $set_database;
	try{	
	$this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->database.';charset=utf8', $this->username, $this->password);
	}
	catch(Exception $e)
	{
		$e->getMessage();
	}
	return $this->db;
  }
function getDBConnection()
{  
	$db = new DBConnect();
//	$con = $db->connect('localhost','root','','royalpatron');  
	$con = $db->connect('royalpatron.db.11086612.hostedresource.com','royalpatron','D@4t5vw3','royalpatron');  
	return $con;
}
}
?>