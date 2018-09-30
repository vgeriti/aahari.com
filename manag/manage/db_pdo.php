<?php
try{
$db = new PDO('mysql:host=localhost;dbname=royalpatron;charset=utf8', 'root', '');
//$db = new PDO('mysql:host=itsmywish.db.11086612.hostedresource.com;dbname=itsmywish;charset=utf8', 'itsmywish', 'Its3yw!sh');
}
catch(Exception $e)
{
	echo $e->getMessage();
}
function clean($var)
	{
		if (get_magic_quotes_gpc()) {
		    return stripslashes($var);
			}
		else {
		    return $var;
			}
	}
?>