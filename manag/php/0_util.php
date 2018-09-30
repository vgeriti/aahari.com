<?php
date_default_timezone_set('Asia/Calcutta');

function my_autoloader($class) {
    include 'classes/' . $class . '.php';
}

spl_autoload_register('my_autoloader');

//echo "outside if in util";
if(isset($_POST['ResDispName']) && isset($_POST['action']) && $_POST['action'] == "save")
{
	include 'classes/Restaurant.php';
	echo "in 1st if on util";
	$res = new Restaurant();
	if($_POST['rest_stat']!='n')
	$res->setId($_POST['rest_stat']);
	$res->setName($_POST['ResDispName']);
	$res->setRestaurantDisplayName($_POST['ResDispName']);
	$res->setOrderEmail($_POST['ResOrdersEmail']);
	$res->setFeedbackEmail($_POST['ResFeedEmail']);
	$res->setArea($_POST['ResArea']);
	$res->setDoorNo($_POST['ResDoorNumber']);
	$res->setLandmark($_POST['ResLandmark']);
	$res->setPincode($_POST['ResPincode']);
	$res->setContact1($_POST['ResContact1']);
	$res->setContact2($_POST['ResContact2']);
	$res->setContact3($_POST['ResContact3']);
	$res->setFeatures($_POST['ResFeatures']);
	$res->setservices($_POST['ResServices']);
	$res->setClosedOn($_POST['ResClosedOn']);
//	$res->setDeliverPlaces($_POST['ResDeliver']);
	$res->setDeliverDistance($_POST['ResDeliver']);
	$res->setDeliveryTime($_POST['ResEstDeliverTime']);
	$res->setDeliveryFrom($_POST['ResDeliverFrom']);
	$res->setDeliveryTo($_POST['ResDeliverTo']);
	$res->setHHStart($_POST['HHStart']);
	$res->setHHEnd($_POST['HHEnd']);
	$res->setMinDeliveyAmount($_POST['ResMinDeliverAmount']);
	$res->setPayment($_POST['paymentOptions']);
	$res->setServiceTax($_POST['ResServiceTax']);
	$res->setVatTax($_POST['ResVatTax']);
	$res->setDeliveryCharges($_POST['ResDeliveryCharges']);
	$res->setRatesOnTax($_POST['ResMenuRatesTax']);
	$res->setAboutUs($_POST['ResAboutUs']);
	$res->setLatitude($_POST['ResLatitude']);
	$res->setLongitude($_POST['ResLongitude']);
	//print_r($res->getServices());
	
	if(isset($_POST['rest_stat']))
	{
		echo "preparing the data in 2nd if";
	/*	id,name,area_id,doorNo,landmark,pincode, contact1, contact2, contact3, email, closedOn, edeliverytime, start_time, end_time, servicecharge, mindeliveryamount, menu_vat, deliveryCharges, time, useragent, ipaddr, inserted*/

		$ary=array(':name'=>$res->getName(), ':area_id'=>$res->getArea(), ':doorNo'=>$res->getDoorno(), ':landmark'=>$res->getLandmark(), ':pincode'=>$res->getPincode(),':contact1'=>$res->getContact1(),':contact2'=>$res->getContact2(),':contact3'=>$res->getContact3(),':email'=>$res->getOrderEmail(), ':feed_email'=>$res->getFeedbackEmail(), ':features'=>$res->getFeaturesJSON(), ':services'=>$res->getServicesJSON(), ':closedOn'=>$res->getClosedOnJSON(), ':deliver_distance'=>$res->getDeliverDistance(), ':edeliverytime'=>$res->getDeliveryTime(),':start_time'=>$res->getDeliveryFrom(),':end_time'=>$res->getDeliveryTo(), ':happyh_start'=>$res->getHHStart(), ':happyh_end'=>$res->getHHEnd(), ':servicecharge'=>$res->getServiceTax(), ':vat_tax'=>$res->getVatTax(), ':mindeliveryamount'=>$res->getMinDeliveryAmount(), ':deliveryCharges'=>$res->getDeliveryCharges(), ':payment' =>$res->getPaymentJSON(), 'aboutus'=>$res->getAboutUs(), ':latitude'=>$res->getLatitude(), ':longitude'=>$res->getLongitude(), ':time'=>date('Y-m-d H:i:s'),':useragent'=>$_SERVER['HTTP_USER_AGENT'],':ipaddr'=>$_SERVER['REMOTE_ADDR'],':inserted'=>'1',':id'=>$res->getId());
		echo $res->getArea();
		$res->saveRestaurant($ary,$_POST['rest_stat']);		
	}
}
function getTime($tim)
{
	$time = DateTime::createFromFormat( 'H:i', $tim);
	//echo $time->format( 'H:i:s');
	return $time->format( 'H:i:s');
}

if(isset($_POST['dishName']))
{
	echo "*dish util*";
//	require_once 'classes/Dishes.php';
	echo "#dish util#";

try{
	$dish = new Dishes();

	if($_POST['rest_stat']!='n')
	{
		echo "*existing*";
	$dish->setDishId($_POST['rest_stat']);
	}
		
	$dish->setRestaurantId($_POST['rest_id']);	
	
	$dish->setCuisineId($_POST['cuisineName']);
	$dish->setDishName($_POST['dishName']);
	$dish->setDishPrice($_POST['dishPrice']);
	$dish->setDishType($_POST['dishType']);
	$dish->setDishCategory($_POST['dishCategory']);
	$ary=array(':name'=>$dish->getDishName(), ':veg'=>$dish->getDishType(), ':cuisine_id'=>$dish->getCuisineId(), ':price'=>$dish->getDishPrice(), ':category'=>$dish->getDishCategory(), ':restaurant_id'=>$dish->getRestaurantId(), ':updated'=>date('Y-m-d H:i:s'), ':id'=>$dish->getDishId());
	echo "^^^^^^^".$dish->getDishType()."^^^^^^^66";
	$dish->saveDish($ary,$_POST['rest_stat']);
	echo "~~~".is_array($ary)."!!";
}
catch(Exception $e)
{
	$e->getMessage();
}	
}

if(isset($_POST['catName']))
{
	$dob = new DBConnect();
	$db = $dob->getDBConnection();
	echo "cat_util";
	if(isset($_POST['catId']) && !empty($_POST['catId']))
	{
		echo "updating_old";
		$stmt = $db->prepare("UPDATE dish_category set name=:name,restaurant_id=:restaurant_id,updated_at=:updated_at,useragent=:useragent where id=:id");
		$stmt->execute(array(':name'=>$_POST['catName'],':restaurant_id'=>$_POST['restId'],':updated_at'=>date('Y-m-d H:i:s'),':useragent'=>$_SERVER['HTTP_USER_AGENT']." REMOTE_ADDR:".$_SERVER['REMOTE_ADDR'],':id'=>$_POST['catId']))or die(print_r($stmt->errorInfo(),true));
	}
	else
	{
		echo "inserting new one";
		$stmt = $db->prepare("INSERT into dish_category(name,restaurant_id,updated_at,useragent) values(:name,:restaurant_id,:updated_at,:useragent)");
		$stmt->execute(array(':name'=>$_POST['catName'],':restaurant_id'=>$_POST['restId'],':updated_at'=>date('Y-m-d H:i:s'),':useragent'=>$_SERVER['HTTP_USER_AGENT']." REMOTE_ADDR:".$_SERVER['REMOTE_ADDR']))or die(print_r($stmt->errorInfo(),true));
	}
		
}
?>