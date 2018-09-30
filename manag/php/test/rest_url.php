<?php
require_once('../classes/DBConnect.php');
//date_default_timezone_set('Asia/Calcutta');
		$d = new DBConnect();
		$db = $d->getDBConnection();
		$st = $db->prepare("SELECT r.id, r.name as restaurant, a.name as area from restaurants r, areas a where r.area_id = a.id");
		$st->execute() or die(print_r($st->errorInfo(),true));
		while ($fr = $st->fetch()) {
			//echo $fr['rest_url']." @@@ ".createRestURL($fr['restaurant'])."-".createRestURL($fr['area'])."<br/>";
			$vr = createRestURL($fr['restaurant'])."-".createRestURL($fr['area']);
			#....
			$stp = $db->prepare("UPDATE restaurants set rest_url=? where id=?");
			$stp->execute(array($vr, $fr['id'])) or die(print_r($stp->errorInfo(),true));
			echo $vr."<br/>";
		}

function createRestURL($str)
	{
		$str = strtolower($str);
		$str = str_replace('&', 'and', $str);
		$str = preg_replace('/[-\'.)(\/\\s]/',"-", $str);
		$str = preg_replace('/[-]+/', '-', $str);
		return $str;
	}		
?>