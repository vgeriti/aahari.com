<?php
require_once 'DBConnect.php';
require_once 'Cart.php';
class Utilities
{

function createCookie($cookie_name)
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


}
?>
