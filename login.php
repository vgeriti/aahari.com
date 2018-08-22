<?php
session_start();
if(!isset($_SESSION['robo']))
{
	if(isset($_POST))
	{
		require_once('manag/php/classes/DBConnect.php');	

		$d = new DBConnect();
		$response = array();
		$db = $d->getDBConnection();	
		$st = $db->prepare("SELECT userid,name,email,password from users where email=?");
		$st->execute(array($_REQUEST['uname']));
		$rw = $st->fetch();
		//echo $_REQUEST['uname'];
		if($st->rowCount()==1)
		{
			if($rw['password']===sha1($_REQUEST['upass']))
			{
				$session = sha1(uniqid(""));
				$_SESSION['session'] = $session;
				$_SESSION['name'] = $rw['name'];
				$_SESSION['user_id'] = $rw['userid'];
				date_default_timezone_set('Asia/Calcutta');
				$st = $db->prepare("INSERT into activity(session_id,http_ref,user_id,action,date_time,user_agent) values (:session_id,:http_ref,:user_id,:action,:date_time,:user_agent)");
				$arpy = array(':session_id' => $session, ':http_ref'=> $_SERVER["HTTP_REFERER"],':user_id'=>$rw["userid"],':action'=>"login_success",'date_time'=>date("Y-m-d H:i:s"),':user_agent'=>$_SERVER["REMOTE_ADDR"]."\/@#$/".$_SERVER["HTTP_USER_AGENT"]);
				$st->execute($arpy) or die($st->errorInfo());
				//header('Location:'.$_SERVER['HTTP_HOST']);
				$response['status'] = "Success";
				$response['message'] = "Thanks for registration. Welcome to Aahari.";
			}
			else{
				$response['status'] = "Failed";
				$response['message'] = "Username / Password is invalid.";
			}				
		}
		else
		{
			$response['status'] = "Failed";
			$response['message'] = "Username / Password is invalid.";
		}
	}
}
else{
	$response['status'] = "Failed";
	$response['message'] = "Username / Password is invalid.";

}

echo json_encode($response);

?>