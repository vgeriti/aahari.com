<?php

$return=null;

if(isset($_REQUEST))
{
	
	if($_REQUEST['usern']=="" || empty($_REQUEST['usern']))
	{
		$ar['status']="Failed";
		$ar['description']="Username required";		
		$return=json_encode($ar);
	}
	else if($_REQUEST['uspaswd']=="" || empty($_REQUEST['uspaswd']))
	{
		$ar['status']="Failed";
		$ar['description']="Password required";		
		$return=json_encode($ar);
	}
	else	
	{
	$ar['status']="Success";
	$ar['description']="Your login was successful";	
	$return=json_encode($ar);
	}
}
else
{
	$ar['status']="Failed";
	$ar['description']="Invalid request";
	$return=json_encode($ar);
}
echo $return;
header("X-Sample-Test: foo");
header('Content-type: application/json');
?>