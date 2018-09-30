<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once 'DBConnect.php';
require_once 'Cart.php';
class Utilities
{

	function createCookie($cookie_name, $res_id)
	{
		if(!isset($_COOKIE[$cookie_name]))
		{
			$cok_val = sha1(uniqid(""));
			setcookie($cookie_name, $cok_val, time()+3600*24*30, "/");	
			$db = new DBConnect;
			$con = $db->getDBConnection();
			$st = $con->prepare("INSERT into cart(session) values (:session)");
			$arpy = array(':session' => $cok_val);
			$st->execute($arpy) or die($st->errorInfo());				
		}
		else 
		{	//if (sizeof($_COOKIE[$cookie_name])<1)
			//var_dump($_COOKIE[$cookie_name]);
			$session = $_COOKIE[$cookie_name];
			$db = new DBConnect;
			$con = $db->getDBConnection();
			$st = $con->prepare("SELECT items from cart where session=:session");
			$st->execute(array(':session'=>$session));
			$rp = $st->fetch();
			if($st->rowCount() > 0)
			{
	//			echo $_COOKIE[$cookie_name]."/";
	//echo "cookie already there ";
				//file_put_contents("cookie_val.txt", $this->getItemsTotal($cookie_name));
				$items = json_decode($rp['items'],true);
				//echo "items size-".sizeof($items);
				if(sizeof($items)>0)
				{
					//echo "has dishes ";
					$dishes = $items['dishes'];					
					$rest = array_shift(array_values($dishes));
					//echo "/ ".$rest['restaurant']." / ".$res_id." ";
					if($rest['restaurant'] != $res_id)
					{
					//echo "same cookie";
						//echo " order and cookie does not match";
						$cok_val = sha1(uniqid(""));
						setcookie($cookie_name, $cok_val, time()+3600*24*30, "/");						
						$st = $con->prepare("INSERT into cart(session) values (:session)");
						$arpy = array(':session' => $cok_val);
						$st->execute($arpy) or die($st->errorInfo());
					}
				}
				//echo "rest id is ".$rest_id;
			}

		}
	}

	function getRestaurantFromCookie($cookie_name)
	{
		$session = $_COOKIE[$cookie_name];
		$db = new DBConnect;
		$con = $db->getDBConnection();
		$st = $con->prepare("SELECT items from cart where session=:session");
		$st->execute(array(':session'=>$_COOKIE[$cookie_name]));
		$rp = $st->fetch();
		if($st->rowCount() > 0)
		{
	//			echo $_COOKIE[$cookie_name]."/";
	//echo "cookie already there ";
			file_put_contents("cookie_val.txt", $rp['items']);
			//$_SERVER['SCRIPT_FILENAME']
			$items = json_decode($rp['items'],true);
				//echo "items size-".sizeof($items);
			if(sizeof($items)>0)
			{
					
				$dishes = $items['dishes'];					
				$rest = reset($dishes);
					//var_dump($rest);
					//echo "/ ".$rest['restaurant']." / ".$res_id." ";
				return $rest['restaurant'];
			}
				//echo "rest id is ".$rest_id;
		}
	}

	function getSessionValue($cookie_name)
	{

		$session = $_COOKIE[$cookie_name];
		$db = new DBConnect;
		$con = $db->getDBConnection();
		$st = $con->prepare("SELECT items from cart where session=:session");
		$st->execute(array('session'=>$_COOKIE[$cookie_name]));
		$rp = $st->fetch();
		if($st->rowCount() > 0)
		{
			$items = json_decode($rp['items'],true);
			//$item = serialize($items);
			$dish = $items['dishes'];
			$dh = array_pop($dish);
			//var_dump($dish);
			//$items = "Price ".$items['total_price']." / Total_price".$this->getFullAmount($dh['restaurant'], $items['total_price']);
			echo $_SERVER['SCRIPT_FILENAME'];
			file_put_contents("cookie_val.txt", $_SERVER['SCRIPT_FILENAME']);
			return $items;
		}
	}


	/*
	
	array(2) { 
	["dishes"]=> array(2) {
	 [231]=> array(6) {
	  ["dish_id"]=> int(231) 
	  ["dish_name"]=> string(5) "Meals" 
	  ["dish_price"]=> int(70) 
	  ["restaurant"]=> int(3) 
	  ["category"]=> int(27) 
	  ["quantity"]=> int(8) } 
	 [232]=> array(6) { 
	  ["dish_id"]=> int(232) 
	  ["dish_name"]=> string(19) "South Indian Meals " 
	  ["dish_price"]=> int(80) 
	  ["restaurant"]=> int(3) 
	  ["category"]=> int(27) 
	  ["quantity"]=> int(2) } } 
	["total_price"]=> int(720) }
	*/

	function getFullAmount($rest_id, $total_price)
	{
		$db = new DBConnect;
		$con = $db->getDBConnection();
		$st = $con->prepare("SELECT servicecharge,vat_tax,deliveryCharges from restaurants where id = ?");
		$st->execute(array($rest_id));
		$prt = $st->fetch();
		if($st->rowCount() > 0)
		{
			$service_tax_amount = round(($prt['servicecharge']*$total_price)/100,2); //$prt['servicecharge']
			$vat_tax_amount = round(($prt['vat_tax']*$total_price)/100,2); //$prt['vat_tax']
			$total_amount = $total_price+$service_tax_amount+$vat_tax_amount+$prt['deliveryCharges'];
		}

		return $total_amount;

	}

	function getItemsDetail($cookie_name, &$items_total, &$items_vartical)
	{
		$session = $_COOKIE[$cookie_name];
		$db = new DBConnect;
		$con = $db->getDBConnection();
		$st = $con->prepare("SELECT items from cart where session=:session");
		$st->execute(array('session'=>$_COOKIE[$cookie_name]));
		$rp = $st->fetch();
		$dish = array();
		if($st->rowCount() > 0)
		{
			$items = json_decode($rp['items'],true);
			//$item = serialize($items);
			$dish = $items['dishes'];
			$count = 0;
			$items = array();
			foreach ($dish as $key => $value) {
				$count = $count + $value['quantity'];
				array_push($items, $value['dish_name']);
			}
			$items_vartical = implode(',', $items);
			$items_total = $count;
		}

	}	

	function getAreasForSearchbox()
	{

		$db= new DBConnect();
		$con = $db->getDBConnection();
		$st = $con->prepare("SELECT DISTINCT a.name from areas a, restaurants r where r.area_id=a.id") or die(print_r($st->errorInfo()));
		$st->execute();
	//echo "<script type='text/javascript'>console.log('count is :'+".$st->rowCount().");</script>";
		while ($rw= $st->fetch()) {
			echo "<option value='".$rw['name']."'>".$rw['name']."</option>";
		//echo "ddd ".$rw['name'];
		}
	//echo "<script type='text/javascript'>console.log('hiii');</script>";

	}

	function getDishesForRestaurantOld($id)
	{

		$db = new DBConnect();
		$con = $db->getDBConnection();

		$st = $con->prepare("SELECT d.name as dish_name,c.name as cuisine_name,d.price as dish_price, d.id as dish_id, d.category as cat from cuisines c, dishes d where d.cuisine_id=c.id and d.restaurant_id = ? order by cat ") or die(print_r($st->errorInfo()));

		$st->execute(array($id));
//echo $st->rowCount()."<br/>";
		$cuisines =array();
		$old_cus = "***";
		$i = 0;
		$dishes = array();
		while($rp=$st->fetch())
		{
//	echo $rp['dish_name']."/".$rp['cuisine_name']."<br/>";
//	$dis = $rp['dish_name'];
//	$dishes[$rp['dish_name']]=$rp['cuisine_name'];
			$i++;
//echo "round# ".$i;
			$cus_nam = $rp['cuisine_name'];
			if ($old_cus == $cus_nam)
			{
//		echo "same cuisine ".$cus_nam."<br/>";
				$dish_det =array();
				$dish_det['dish_name'] = $rp['dish_name'];
				$dish_det['dish_price'] = $rp['dish_price'];
				$dishes[$rp['dish_id']] = $dish_det;

			}
			else
			{
//		echo "different cuisine ".$cus_nam."<br/>";
				if($old_cus !="***")
				{
					$cuisines[$old_cus] = $dishes;
					$dishes =array();
				}
				$dish_det['dish_name'] = $rp['dish_name'];
				$dish_det['dish_price'] = $rp['dish_price'];
				$dishes[$rp['dish_id']] = $dish_det;
			}

			$old_cus = $cus_nam;	
		}
		$cuisines[$old_cus]=$dishes;

		return $cuisines;
//echo "******".$dishes['Tatyana Forbes']."******";
//echo print_r($rp);
//echo "<br/><br/><br/>";
//var_dump($dishes);
	}

	function getDishesForRestaurant($id)
	{

		$db = new DBConnect();
		$con = $db->getDBConnection();

		$st = $con->prepare("SELECT d.name as dish_name,cat.name as category, cat.updated_at as cat_order,c.name as cuisine_name,d.price as dish_price, d.id as dish_id, d.category as cat, d.updated as d_order from dish_category cat, cuisines c, dishes d where d.cuisine_id=c.id and d.category=cat.id and d.restaurant_id = ? order by cat_order,d_order") or die(print_r($st->errorInfo()));
//echo $st->rowCount();
//SELECT d.name as dish_name,c.name as cuisine_name,d.price as dish_price, d.id as dish_id, d.category as cat from cuisines c, dishes d where d.cuisine_id=c.id and d.restaurant_id = ? order by cat 
////SELECT d.name as dish_name,cat.name as category, cat.updated_at as cat_order,c.name as cuisine_name,d.price as dish_price, d.id as dish_id, d.category as cat from cuisines c, dishes d where d.cuisine_id=c.id and d.category=cat.id and d.restaurant_id = ? order by cat_order
		$st->execute(array($id));
//echo $st->rowCount()."<br/>";
		$categories =array();
		$old_cat = "***";
		$i = 0;
		$dishes = array();
		while($rp=$st->fetch())
		{
	//echo $rp['dish_id']."\n";
//	echo $rp['dish_name']."/".$rp['cuisine_name']."<br/>";
//	$dis = $rp['dish_name'];
//	$dishes[$rp['dish_name']]=$rp['cuisine_name'];
			$i++;
//echo "round# ".$i;
			$cat_nam = $rp['category'];
			if ($old_cat == $cat_nam)
			{
//		echo "same cuisine ".$cus_nam."<br/>";
				$dish_det =array();
				$dish_det['dish_name'] = $rp['dish_name'];
				$dish_det['dish_price'] = $rp['dish_price'];
				$dishes[$rp['dish_id']] = $dish_det;

			}
			else
			{
//		echo "different cuisine ".$cus_nam."<br/>";
				if($old_cat !="***")
				{
					$cuisines[$old_cat] = $dishes;
					$dishes =array();
				}
				$dish_det['dish_name'] = $rp['dish_name'];
				$dish_det['dish_price'] = $rp['dish_price'];
				$dishes[$rp['dish_id']] = $dish_det;
			}

			$old_cat = $cat_nam;	
		}
		$cuisines[$old_cat]=$dishes;

		return $cuisines;
//echo "******".$dishes['Tatyana Forbes']."******";
//echo print_r($rp);
//echo "<br/><br/><br/>";
//var_dump($dishes);
	}
/*function getDishesForRestaurant($id)
{

$db = new DBConnect();
$con = $db->getDBConnection();

$st = $con->prepare("SELECT d.name as dish_name,cat.name as category,cat.id as catid, cat.updated_at as cat_order, d.veg as veg, c.name as cuisine_name,d.price as dish_price, d.id as dish_id, d.category as cat, d.updated as d_order from dish_category cat, cuisines c, dishes d where d.cuisine_id=c.id and d.category=cat.id and d.restaurant_id = ? order by cat_order,d_order") or die(print_r($st->errorInfo()));
//echo $st->rowCount();
//SELECT d.name as dish_name,c.name as cuisine_name,d.price as dish_price, d.id as dish_id, d.category as cat from cuisines c, dishes d where d.cuisine_id=c.id and d.restaurant_id = ? order by cat 
////SELECT d.name as dish_name,cat.name as category, cat.updated_at as cat_order,c.name as cuisine_name,d.price as dish_price, d.id as dish_id, d.category as cat from cuisines c, dishes d where d.cuisine_id=c.id and d.category=cat.id and d.restaurant_id = ? order by cat_order
$st->execute(array($id));
//echo $st->rowCount()."<br/>";
	$categories =array();
	$old_cat = "***";
	$old_cat_name = '';
	$old_cat_veg = '';
	$i = 0;
	$dishes = array();
	$cat_a= array();
while($rp=$st->fetch())
{
$i++;
//echo "round# ".$i;
	$cat_name = $rp['category'];
	$cat_id = $rp['catid'];
	$cat_veg = $rp['veg'];
	if ($old_cat == $cat_id)
	{
//		echo "same cuisine ".$cus_nam."<br/>";
		$dish_det =array();
		$dish_det['dish_name'] = $rp['dish_name'];
		$dish_det['dish_price'] = $rp['dish_price'];
		$dishes[$rp['dish_id']] = $dish_det;
	}
	else
	{
//		echo "different cuisine ".$cus_nam."<br/>";
		if($old_cat !="***")
		{
			$cats['cat_name'] = $old_cat_name;
			$cats['dishes'] = $dishes;
			$cats['veg'] = $old_cat_veg;
			$cuisines[$old_cat] = $cats;
			$dishes =array();
			$cats = array();
		}
		$dish_det['dish_name'] = $rp['dish_name'];
		$dish_det['dish_price'] = $rp['dish_price'];
		$dishes[$rp['dish_id']] = $dish_det;
	}
	
	$old_cat = $cat_id;	
	$old_cat_name = $cat_name;
	$old_cat_veg = $cat_veg;
}
$cats['cat_name'] = $old_cat_name;
$cats['dishes'] = $dishes;
$cats['veg'] = $old_cat_veg;
$cuisines[$old_cat]=$cats;

//echo var_dump($cuisines);
return $cuisines;
//echo "******".$dishes['Tatyana Forbes']."******";
//echo print_r($rp);
//echo "<br/><br/><br/>";
//var_dump($dishes);
}*/

function getCategoriesForRestaurant($rest_id)
{
	$db = new DBConnect();
	$con = $db->getDBConnection();
	$st = $con->prepare("SELECT DISTINCT cat.name as category,cat.updated_at as cat_order, d.veg as veg, cat.id as id from dish_category cat, dishes d where cat.id=d.category and d.restaurant_id=:restaurant_id order by veg,cat_order ") or die(print_r($st->errorInfo()));	
//cat.name as category,cat.type as type,cat.updated_at as cat_order, d.veg as veg
//GROUP BY veg, order by cat_order
//$st = $con->prepare("SELECT cat.name as category,cat.type as type,cat.updated_at as cat_order, d.veg as veg from dish_category cat, dishes d where restaurant_id=:restaurant_id and cat.id=d.category GROUP BY veg, order by cat_order") or die(print_r($st->errorInfo()));	
//echo $rest_id;
	$st->execute(array(':restaurant_id'=>$rest_id));
//echo $st->rowCount();
	$veg_prev = "**";
	$cat_ary = array();
	while($ft = $st->fetch())
	{
		$veg = $ft['veg'];
		$id = $ft['id'];
		//if($veg == $veg_prev)
		$cat_ary[$veg][$id] = $ft['category'];
		//echo "* ".$ft['category']." * ".$ft['cat_order']." * ".$ft['veg']."<br/>";
	}
	return $cat_ary;
}

function getRestaurants()
{
	$db = new DBConnect();
	$con = $db->getDBConnection();
	$st = $con->prepare("SELECT DISTINCT r.name,r.id from restaurants r") or die(print_r($st->errorInfo()));
	$st->execute();
	$arp = array();
	while($rp = $st->fetch())
	{
		//$arp[$rp['id']] = $rp['name'];
		echo "<option value='".$rp['id']."'>".$rp['name']."</option>";
	}

	//return $arp;
}

function getAreas()
{
	$db = new DBConnect();
	$con = $db->getDBConnection();
	$st = $con->prepare("SELECT DISTINCT a.name, a.id from areas a, restaurants r where r.area_id=a.id") or die(print_r($st->errorInfo()));
	$st->execute();
	$arp = array();
	while($rp = $st->fetch())
	{
		$arp[$rp['id']] = $rp['name'];
	}

	return $arp;
}

function getCuisines()
{
	$db = new DBConnect();
	$con = $db->getDBConnection();
	$st = $con->prepare("SELECT c.name, c.id from cuisines c, dishes d where c.id = d.cuisine_id") or die(print_r($st->errorInfo()));
	$st->execute();
	$arp = array();
	while($rp = $st->fetch())
	{
		$arp[$rp['id']] = $rp['name'];
	}

	return $arp;
}



function getAreaURL($cuisines, $areas, $deliver_type, $features, $current)
{
	$url = '';
	$two = false;
	$one = false;
	$key = '';
	$are_ary = array();
	
	$are_ary = explode(',', $areas);
	$key = array_search($current, $are_ary);

	if($key!== false)
	{
		unset($are_ary[$key]);
		$two = true;
	}					

	$areas = implode(',', $are_ary);

	if(empty($areas) && !$two)
		$areas = $current;
	else if(!empty($areas) && !$two)
		$areas = $areas.",".$current;	
	else if(!empty($areas) && $two)
		$areas = $areas;
	//echo $areas."<br/>";

	if(!empty($areas) && !empty($cuisines) && !empty($deliver_type) && !empty($features))
		$url = "?cuisine=".$cuisines."&area=".$areas."&ft=".$deliver_type."&fr=".$features;
	else if(!empty($areas) && !empty($cuisines) && !empty($deliver_type))
		$url = "?cuisine=".$cuisines."&area=".$areas."&ft=".$deliver_type;
	else if(!empty($cuisines) && !empty($deliver_type) && !empty($features))
		$url = "?cuisine=".$cuisines."&ft=".$deliver_type."&fr=".$features;
	else if(!empty($areas) && !empty($deliver_type) && !empty($features))
		$url = "?area=".$areas."&ft=".$deliver_type."&fr=".$features;
	else if(!empty($areas) && !empty($cuisines) && !empty($features))
		$url = "?cuisine=".$cuisines."&area=".$areas."&fr=".$features;
	else if(!empty($areas) && !empty($cuisines))
		$url = "?cuisine=".$cuisines."&area=".$areas;
	else if(!empty($cuisines) && !empty($deliver_type))
		$url = "?cuisine=".$cuisines."&ft=".$deliver_type;
	else if(!empty($areas) && !empty($deliver_type))
		$url = "?area=".$areas."&ft=".$deliver_type;
	else if(!empty($areas) && !empty($features))
		$url = "?area=".$areas."&fr=".$features;
	else if(!empty($cuisines) && !empty($features))
		$url = "?cuisine=".$cuisines."&fr=".$features;
	else if(!empty($deliver_type) && !empty($features))
		$url = "?ft=".$deliver_type."&fr=".$features;
	else if(!empty($cuisines))
		$url = "?cuisine=".$cuisines;
	else if(!empty($areas))
		$url = "?area=".$areas;
	else if(!empty($deliver_type))
		$url = "?ft=".$deliver_type;
	else if(!empty($features))
		$url = "?fr=".$features;	

	return $url;
}

function getCuisineURL($cuisines, $areas, $deliver_type, $features, $current)
{
	$url = '';
	$two = false;
	$one = false;
	$key = '';
	$cui_ary = array();
	
	$cui_ary = explode(',', $cuisines);
	$key = array_search($current, $cui_ary);

	if($key!== false)
	{
		unset($cui_ary[$key]);
		$two = true;
	}					

	$cuisines = implode(',', $cui_ary);
	
	if(empty($cuisines) && !$two)
		$cuisines = $current;
	else if(!empty($cuisines) && !$two)
		$cuisines = $cuisines.",".$current;	
	else if(!empty($cuisines) && $two)
		$cuisines = $cuisines;	
	//echo $cuisines."<br/>";

	if(!empty($areas) && !empty($cuisines) && !empty($deliver_type) && !empty($features))
		$url = "?cuisine=".$cuisines."&area=".$areas."&ft=".$deliver_type."&fr=".$features;
	else if(!empty($areas) && !empty($cuisines) && !empty($deliver_type))
		$url = "?cuisine=".$cuisines."&area=".$areas."&ft=".$deliver_type;
	else if(!empty($cuisines) && !empty($deliver_type) && !empty($features))
		$url = "?cuisine=".$cuisines."&ft=".$deliver_type."&fr=".$features;
	else if(!empty($areas) && !empty($deliver_type) && !empty($features))
		$url = "?area=".$areas."&ft=".$deliver_type."&fr=".$features;
	else if(!empty($areas) && !empty($cuisines) && !empty($features))
		$url = "?cuisine=".$cuisines."&area=".$areas."&fr=".$features;
	else if(!empty($areas) && !empty($cuisines))
		$url = "?cuisine=".$cuisines."&area=".$areas;
	else if(!empty($cuisines) && !empty($deliver_type))
		$url = "?cuisine=".$cuisines."&ft=".$deliver_type;
	else if(!empty($areas) && !empty($deliver_type))
		$url = "?area=".$areas."&ft=".$deliver_type;
	else if(!empty($areas) && !empty($features))
		$url = "?area=".$areas."&fr=".$features;
	else if(!empty($cuisines) && !empty($features))
		$url = "?cuisine=".$cuisines."&fr=".$features;
	else if(!empty($deliver_type) && !empty($features))
		$url = "?ft=".$deliver_type."&fr=".$features;
	else if(!empty($cuisines))
		$url = "?cuisine=".$cuisines;
	else if(!empty($areas))
		$url = "?area=".$areas;
	else if(!empty($deliver_type))
		$url = "?ft=".$deliver_type;
	else if(!empty($features))
		$url = "?fr=".$features;

	return $url;
}


function getDeliverTypeURL($cuisines, $areas, $deliver_type, $features, $current)
{
	$url = '';
	$two = false;
	$one = false;
	$key = '';
	$del_ary = array();
	
	$del_ary = explode(',', $deliver_type);
	$key = array_search($current, $del_ary);

	if($key!== false)
	{
		unset($del_ary[$key]);
		$two = true;
	}					

	$deliver_type = implode(',', $del_ary);

	if(empty($deliver_type) && !$two)
		$deliver_type = $current;
	else if(!empty($deliver_type) && !$two)
		$deliver_type = $deliver_type.",".$current;	
	else if(!empty($deliver_type) && $two)
		$deliver_type = $deliver_type;
//	echo $deliver_type."<br/>";

	if(!empty($areas) && !empty($cuisines) && !empty($deliver_type) && !empty($features))
		$url = "?cuisine=".$cuisines."&area=".$areas."&dt=".$deliver_type."&fr=".$features;
	else if(!empty($areas) && !empty($cuisines) && !empty($deliver_type))
		$url = "?cuisine=".$cuisines."&area=".$areas."&dt=".$deliver_type;
	else if(!empty($cuisines) && !empty($deliver_type) && !empty($features))
		$url = "?cuisine=".$cuisines."&dt=".$deliver_type."&fr=".$features;
	else if(!empty($areas) && !empty($deliver_type) && !empty($features))
		$url = "?area=".$areas."&dt=".$deliver_type."&fr=".$features;
	else if(!empty($areas) && !empty($cuisines) && !empty($features))
		$url = "?cuisine=".$cuisines."&area=".$areas."&fr=".$features;
	else if(!empty($areas) && !empty($cuisines))
		$url = "?cuisine=".$cuisines."&area=".$areas;
	else if(!empty($cuisines) && !empty($deliver_type))
		$url = "?cuisine=".$cuisines."&dt=".$deliver_type;
	else if(!empty($areas) && !empty($deliver_type))
		$url = "?area=".$areas."&dt=".$deliver_type;
	else if(!empty($areas) && !empty($features))
		$url = "?area=".$areas."&fr=".$features;
	else if(!empty($cuisines) && !empty($features))
		$url = "?cuisine=".$cuisines."&fr=".$features;
	else if(!empty($deliver_type) && !empty($features))
		$url = "?dt=".$deliver_type."&fr=".$features;
	else if(!empty($cuisines))
		$url = "?cuisine=".$cuisines;
	else if(!empty($areas))
		$url = "?area=".$areas;
	else if(!empty($deliver_type))
		$url = "?dt=".$deliver_type;
	else if(!empty($features))
		$url = "?fr=".$features;

	return $url;
}

function getFoodTypeURL($cuisines, $areas, $food_type, $features, $current)
{
	$url = '';
	$two = false;
	$one = false;
	$key = '';
	$food_ary = array();
	
	$food_ary = explode(',', $food_type);
	$key = array_search($current, $food_ary);

	if($key!== false)
	{
		unset($food_ary[$key]);
		$two = true;
	}					

	$food_type = implode(',', $food_ary);

	if(empty($food_type) && !$two)
		$food_type = $current;
	else if(!empty($food_type) && !$two)
		$food_type = $food_type.",".$current;	
	else if(!empty($food_type) && $two)
		$food_type = $food_type;
//	echo $deliver_type."<br/>";

	if(!empty($areas) && !empty($cuisines) && !empty($food_type) && !empty($features))
		$url = "?cuisine=".$cuisines."&area=".$areas."&ft=".$food_type."&fr=".$features;
	else if(!empty($areas) && !empty($cuisines) && !empty($food_type))
		$url = "?cuisine=".$cuisines."&area=".$areas."&ft=".$food_type;
	else if(!empty($cuisines) && !empty($food_type) && !empty($features))
		$url = "?cuisine=".$cuisines."&ft=".$food_type."&fr=".$features;
	else if(!empty($areas) && !empty($food_type) && !empty($features))
		$url = "?area=".$areas."&ft=".$food_type."&fr=".$features;
	else if(!empty($areas) && !empty($cuisines) && !empty($features))
		$url = "?cuisine=".$cuisines."&area=".$areas."&fr=".$features;
	else if(!empty($areas) && !empty($cuisines))
		$url = "?cuisine=".$cuisines."&area=".$areas;
	else if(!empty($cuisines) && !empty($food_type))
		$url = "?cuisine=".$cuisines."&ft=".$food_type;
	else if(!empty($areas) && !empty($food_type))
		$url = "?area=".$areas."&ft=".$food_type;
	else if(!empty($areas) && !empty($features))
		$url = "?area=".$areas."&fr=".$features;
	else if(!empty($cuisines) && !empty($features))
		$url = "?cuisine=".$cuisines."&fr=".$features;
	else if(!empty($food_type) && !empty($features))
		$url = "?ft=".$food_type."&fr=".$features;
	else if(!empty($cuisines))
		$url = "?cuisine=".$cuisines;
	else if(!empty($areas))
		$url = "?area=".$areas;
	else if(!empty($food_type))
		$url = "?ft=".$food_type;
	else if(!empty($features))
		$url = "?fr=".$features;

	return $url;
}

function getFeaturesURL($cuisines, $areas, $deliver_type, $features, $current)
{
	$url = '';
	$two = false;
	$one = false;
	$key = '';
	$feu_ary = array();
	
	$feu_ary = explode(',', $features);
	$key = array_search($current, $feu_ary);

	if($key!== false)
	{
		unset($feu_ary[$key]);
		$two = true;
	}					

	$features = implode(',', $feu_ary);

	if(empty($features) && !$two)
		$features = $current;
	else if(!empty($features) && !$two)
		$features = $features.",".$current;	
	else if(!empty($features) && $two)
		$features = $features;	
	//echo $features."<br/>";

	if(!empty($areas) && !empty($cuisines) && !empty($deliver_type) && !empty($features))
		$url = "?cuisine=".$cuisines."&area=".$areas."&ft=".$deliver_type."&fr=".$features;
	else if(!empty($areas) && !empty($cuisines) && !empty($deliver_type))
		$url = "?cuisine=".$cuisines."&area=".$areas."&ft=".$deliver_type;
	else if(!empty($cuisines) && !empty($deliver_type) && !empty($features))
		$url = "?cuisine=".$cuisines."&ft=".$deliver_type."&fr=".$features;
	else if(!empty($areas) && !empty($deliver_type) && !empty($features))
		$url = "?area=".$areas."&ft=".$deliver_type."&fr=".$features;
	else if(!empty($areas) && !empty($cuisines) && !empty($features))
		$url = "?cuisine=".$cuisines."&area=".$areas."&fr=".$features;
	else if(!empty($areas) && !empty($cuisines))
		$url = "?cuisine=".$cuisines."&area=".$areas;
	else if(!empty($cuisines) && !empty($deliver_type))
		$url = "?cuisine=".$cuisines."&ft=".$deliver_type;
	else if(!empty($areas) && !empty($deliver_type))
		$url = "?area=".$areas."&ft=".$deliver_type;
	else if(!empty($areas) && !empty($features))
		$url = "?area=".$areas."&fr=".$features;
	else if(!empty($cuisines) && !empty($features))
		$url = "?cuisine=".$cuisines."&fr=".$features;
	else if(!empty($deliver_type) && !empty($features))
		$url = "?ft=".$deliver_type."&fr=".$features;
	else if(!empty($cuisines))
		$url = "?cuisine=".$cuisines;
	else if(!empty($areas))
		$url = "?area=".$areas;
	else if(!empty($deliver_type))
		$url = "?ft=".$deliver_type;
	else if(!empty($features))
		$url = "?fr=".$features;

	return $url;
}


}
?>
