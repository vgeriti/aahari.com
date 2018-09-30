<?php
require_once('db_pdo.php');
$what_you_want = basename($_SERVER['PHP_SELF']);
if($_SERVER['SERVER_NAME'] == "localhost")
	define("HTTP_URL",$_SERVER['SERVER_NAME']."/aahari/");
else
	define("HTTP_URL",$_SERVER['SERVER_NAME']."/");
	
$query="SELECT userid,firstname,email,password from users where email= ?";
$rg=$db->prepare($query);
$rg->execute(array($_REQUEST['loginName']));
while($row=$rg->fetch())
{
	if($_REQUEST['loginName'] == $row['email'])
	{
		if(sha1($_REQUEST['loginPassword']) == $row['password'])
		{
			session_start();
			$_SESSION['userid']=$row['userid'];
			$_SESSION['name']=$row['firstname'];
//			echo "****".$_SERVER['SERVER_NAME']."*****$$$$$$$$$".HTTP_URL."$$$$$$444";
		header('location:http://'.HTTP_URL.'manage.php');
		}
		else
			echo "wrong password";
	}
	else
		echo "Check your email";
}

?>