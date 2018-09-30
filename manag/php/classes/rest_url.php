<?php
require_once('classes/DBConnect.php');

$db = new DBConnect();
$con = $db->getDBConnection();
$st = $con->prepare("SELECT id,name from restaurants") or die(print_r($st->errorInfo()));	
$st->execute();
echo $st->rowCount()." restaurants available<br/>";
while($ft = $st->fetch())
{
	$str = $ft['name'];
	echo $str;
	$str = strtolower($str);
	$str = str_replace('&', 'and', $str);
	$str = preg_replace('/[-\'.)(\/\\s]/',"-", $str);
	//$str = preg_replace('/\'\&-/', '-', $str);
	$str = preg_replace('/[-]+/', '-', $str);
	$stp = $con->prepare("UPDATE restaurants set rest_url = ? where id= ?") or die(print_r($st->errorInfo()));	
	$stp->execute(array($str,$ft['id']));
	echo " -------- ".$str."<br/>";
}

echo "<br/><br/>";
	$str = strtolower("!#!#$!#$#!$str#%");
	echo $str;
	$str = preg_replace('/[^a-zA-Z0-9]/', '-', $str);
	$str = preg_replace('/[-]+/', '-', $str);
	echo " **** ".$str."<br/>";


?>