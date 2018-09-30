<?php
session_start();
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

	$res->setServiceTax(Aahari_Constants::HD,$_POST['hd_ResServiceTax']);
	$res->setVatTax(Aahari_Constants::HD,$_POST['hd_ResVatTax']);
	$res->setDiscount(Aahari_Constants::HD,$_POST['hd_ResDiscount']);

	$res->setServiceTax(Aahari_Constants::TA,$_POST['ta_ResServiceTax']);
	$res->setVatTax(Aahari_Constants::TA,$_POST['ta_ResVatTax']);
	$res->setDiscount(Aahari_Constants::TA,$_POST['ta_ResDiscount']);

	$res->setServiceTax(Aahari_Constants::TB,$_POST['tb_ResServiceTax']);
	$res->setVatTax(Aahari_Constants::TB,$_POST['tb_ResVatTax']);
	$res->setDiscount(Aahari_Constants::TB,$_POST['tb_ResDiscount']);

	$res->setDeliveryCharges($_POST['ResDeliveryCharges']);
	$res->setRatesOnTax($_POST['ResMenuRatesTax']);
	$res->setAboutUs($_POST['ResAboutUs']);
	$res->setLatitude($_POST['ResLatitude']);
	$res->setLongitude($_POST['ResLongitude']);
	//print_r($res->getServices());
	
	if(isset($_POST['rest_stat']))
	{
		//echo "preparing the data in 2nd if";
	/*	id,name,area_id,doorNo,landmark,pincode, contact1, contact2, contact3, email, closedOn, edeliverytime, start_time, end_time, servicecharge, mindeliveryamount, menu_vat, deliveryCharges, time, useragent, ipaddr, inserted*/

		$ary=array(':name'=>$res->getName(), ':area_id'=>$res->getArea(), ':doorNo'=>$res->getDoorno(), ':landmark'=>$res->getLandmark(), ':pincode'=>$res->getPincode(),':contact1'=>$res->getContact1(),':contact2'=>$res->getContact2(),':contact3'=>$res->getContact3(),':email'=>$res->getOrderEmail(), ':feed_email'=>$res->getFeedbackEmail(), ':features'=>$res->getFeaturesJSON(), ':services'=>$res->getServicesJSON(), ':closedOn'=>$res->getClosedOnJSON(), ':deliver_distance'=>$res->getDeliverDistance(), ':edeliverytime'=>$res->getDeliveryTime(),':start_time'=>$res->getDeliveryFrom(),':end_time'=>$res->getDeliveryTo(), ':happyh_start'=>$res->getHHStart(), ':happyh_end'=>$res->getHHEnd(), ':servicecharge'=>json_encode($res->getServiceTax()), ':vat_tax'=>json_encode($res->getVatTax()), ':discount'=>json_encode($res->getDiscount()), ':mindeliveryamount'=>$res->getMinDeliveryAmount(), ':deliveryCharges'=>$res->getDeliveryCharges(), ':payment' =>$res->getPaymentJSON(), 'aboutus'=>$res->getAboutUs(), ':latitude'=>$res->getLatitude(), ':longitude'=>$res->getLongitude(), ':time'=>date('Y-m-d H:i:s'),':useragent'=>$_SERVER['HTTP_USER_AGENT'],':ipaddr'=>$_SERVER['REMOTE_ADDR'],':inserted'=>'1',':id'=>$res->getId());
		//echo $res->getArea();
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

if(isset($_POST['rest_areas']) || isset($_POST['rest_cuisines']))
{
	//echo var_dump($_POST['rest_areas']);
	//ini_set('display_errors', 'On');
	$dob = new DBConnect();
	$db = $dob->getDBConnection();	
	//echo $inQuery1."#".$inQuery2;
	if(isset($_POST['rest_areas']) && isset($_POST['rest_cuisines']))
	{
		$inQuery1 = implode(',', array_fill(0, count($_POST['rest_areas']), '?'));
		$inQuery2 = implode(',', array_fill(0, count($_POST['rest_cuisines']), '?'));
		$stmt = $db->prepare("SELECT DISTINCT r.id,r.name, r.rest_url, a.name as area_name from restaurants r, areas a, dishes d where r.area_id = a.id and r.id = d.restaurant_id and d.cuisine_id IN (".$inQuery2.") and r.area_id IN (".$inQuery1.") ") or die(print_r($stmt->errorInfo()));
		$stmt->execute(array_merge($_POST['rest_cuisines'],$_POST['rest_areas']));
	}else if(isset($_POST['rest_areas']))
	{
		$inQuery1 = implode(',', array_fill(0, count($_POST['rest_areas']), '?'));
		$stmt = $db->prepare("SELECT DISTINCT r.id,r.name, r.rest_url, a.name as area_name from restaurants r, areas a, dishes d where r.area_id = a.id and r.id = d.restaurant_id and r.area_id IN (".$inQuery1.") ") or die(print_r($stmt->errorInfo()));
		$stmt->execute($_POST['rest_areas']);
	}else if(isset($_POST['rest_cuisines']))
	{
		$inQuery2 = implode(',', array_fill(0, count($_POST['rest_cuisines']), '?'));
		$stmt = $db->prepare("SELECT DISTINCT r.id,r.name, r.rest_url, a.name as area_name from restaurants r, areas a, dishes d where r.area_id = a.id and r.id = d.restaurant_id and d.cuisine_id IN (".$inQuery2.") ") or die(print_r($stmt->errorInfo()));
		$stmt->execute($_POST['rest_cuisines']);
	}
	while ($pp = $stmt->fetch()) {

		$rest = new Restaurant();
		$rest->getRestaurant($pp['rest_url']);               
		echo "<div class='clear_40'></div>
		<div class='restro_info'>";
		date_default_timezone_set('Asia/Calcutta');
		$date = date('H:i:s');
		if($rest->isOpen($date))
			echo "<div class='open'>Open Now</div>";
		else
			echo "<div class='open' style='background-color:#FF6E6E;'>Closed Now</div>";
                //$name=str_replace('-',' ',$name);
                //urlencode(str_replace(' ', '-', $rp['rest_name']))

		echo "<div class='clear_10'></div>
		<div class='heading'><a href='view.php?page=info&name=".$rest->getRestURL()."'>".$rest->getName()."</a><font size='-1'>, ".$pp['area_name']."</font> &nbsp;
		<br />
		<img src='images/star.png' width='23' height='23' />
		<img src='images/star.png' width='23' height='23' />
		<img src='images/star.png' width='23' height='23' />
		<img src='images/star.png' width='23' height='23' />
		</div>                
		<div class='restro_middle'>

		<div class='clear_10'></div>";               
		try{
			$prt = $db->prepare("SELECT DISTINCT c.name from cuisines c, dishes d,restaurants r where d.restaurant_id=r.id and d.cuisine_id=c.id and r.id=? order by name ASC");
			$prt->execute(array($pp['id']))or die(print_r($prt->errorInfo(),true));
                            //echo $prt->rowCount();
			echo "<b>";
			while($pt = $prt->fetch())
			{
				echo $pt['name'].", ";                          
			}
			echo "</b>";
		}
		catch(Exception $e)
		{
			$e->getMessage();
			print_r($e->getTraceAsString());
		}

		echo "<br /><div class='clear_10'></div><div class='clear_10'></div>
		Minimum Delivery Amount : <div class='coin'><font color='#333333' ><b>&#x20B9; ".$rest->getMinDeliveryAmount()."</b></font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| Open time : ".$rest->getDeliveryFrom12()."  to ".$rest->getDeliveryTo12()."</div> 
		</div>
		<div class='restro_right'>
		<div class='restro_right_fade'>";
		if($rest->findServices("DD",$rp['id']))                    
			echo "<img src='images/home_delivery.png' width='30' height='30' />&nbsp;&nbsp;";
		else
			echo "<img src='images/home_delivery.png' class='not_available' width='30' height='30' />&nbsp;&nbsp;";
		if($rest->findServices("TB",$rp['id']))                    
			echo "<img src='images/table_booking_2.png' width='30' height='30' />&nbsp;&nbsp;";
		else
			echo "<img src='images/table_booking_2.png' class='not_available' width='30' height='30' />&nbsp;&nbsp;";
		if($rest->findServices("TA",$rp['id']))                    
			echo "<img src='images/take_away_2.png' width='30' height='30' />";
		else
			echo "<img src='images/take_away_2.png' class='not_available' width='30' height='30' />";


		echo "</div>
		<div class='clear_40'></div>
		<a href=>Where we Deliver?</a><br />
		<a href='view.php?page=map&name=".$rest->getRestURL()."'>Locate Us</a><br />                    
		<a href=''>Offers and Coupons</a>
		</div>                   

		</div>";
		//echo $pp['name']." $ ";
	}
	//echo var_dump($pp);
}

if(isset($_POST['rev_name']) && isset($_POST['rev_message']))
{
	$resp_msg = array();
	$dob = new DBConnect();
	$rev = new Reviews();
	$db = $dob->getDBConnection();
	$rating = 5;
	//rev_rest_id;
	if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != null && !empty($_SESSION['user_id']))
	{
		$stmt = $db->prepare("INSERT into reviews (restaurant_id,title,review,rating,dtime,user_id,useragent) values (:restaurant_id,:title, :review, :rating, :dtime, :user_id, :useragent)");
		$var = $stmt->execute(array('restaurant_id'=>$_POST['rev_rest_id'],':title'=>$_POST['rev_name'],':review'=>$_POST['rev_message'],':rating'=>$_POST['rateng'],':dtime'=>date('Y-m-d H:i:s'),':user_id'=>$_SESSION['user_id'],':useragent'=>$_SERVER['HTTP_USER_AGENT']." REMOTE_ADDR:".$_SERVER['REMOTE_ADDR']))or die(print_r($stmt->errorInfo(),true));

		if($var)
		{
			$resp_msg['status'] = "Success";
			$resp_msg['message'] = "Your review is posted successfully";
			$resp_msg['data'] = $rev->getRestReviews($_POST['rev_rest_id']);
		}
		else
		{
			$resp_msg['status'] = "Failed";
			$resp_msg['message'] = "Please enter valid data";

		}
	}
	else
	{
		$resp_msg['status'] = "Denied";
		$resp_msg['message'] = "Please login to post your review";
	}
 echo json_encode($resp_msg);
}


if(isset($_POST['oemail']) && isset($_POST['opayment']) && isset($_POST['oaddress']))
{
	$resp_msg = array();
	$dob = new DBConnect();
	$util = new Utilities();
	$db = $dob->getDBConnection();
	//$rating = 5;
	//rev_rest_id;
	$cok = $util->getSessionValue('_kps');
	$dish = $cok['dishes'];
	$dh = array_pop($dish);
//	echo "#".$dh['restaurant']."#/#".$cok['total_price']."#";
//	echo "*".$util->getFullAmount($dh['orestnt'], $cok['total_price'])."*";
	$stmt = $db->prepare("INSERT into orders (restaurant_id, order_type, amount, delivery_time, items, name, email, mobile, alternate_mobile, delivery_address, area, special_request, payment_method, order_status, user_id, useragent, dtime) values 
		(:restaurant_id, :order_type, :amount, :delivery_time, :items, :name, :email, :mobile, :alternate_mobile, :delivery_address, :area, :special_request, :payment_method, :order_status, :user_id, :useragent, :dtime)");
    //                                                                                                                       	 																			:delivery_time, :items, :name, :email, :mobile, :alternate_mobile, :delivery_address, :area, :special_request, :payment_method, :order_status, :user_id, :useragent, :dtimdate('Y-m-d H:i:s'),':user_id'=>$rating,':useragent'=>$_SERVER['HTTP_USER_AGENT']." REMOTE_ADDR:".$_SERVER['REMOTE_ADDR'])
	$var = $stmt->execute(array('restaurant_id'=>$_POST['orestnt'],':order_type' => $_POST['order_type'], ':amount' => $util->getFullAmount($dh['restaurant'], $cok['total_price']), ':delivery_time' => $_POST['dorder_time'], ':items' => json_encode($cok['dishes']), ':name' => $_POST['oname'], ':email' => $_POST['oemail'], ':mobile' => $_POST['omobile'], ':alternate_mobile' => $_POST['oamobile'], ':delivery_address' => $_POST['oaddress'], ':area' => $_POST['oarea'], ':special_request' => $_POST['osrequest'], ':payment_method' => $_POST['opayment'], ':order_status' => "OPEN", ':user_id' => $_POST['order_type'], ':useragent' => $_SERVER['HTTP_USER_AGENT']." REMOTE_ADDR:".$_SERVER['REMOTE_ADDR'], ':dtime' => date('Y-m-d H:i:s')))or die(print_r($stmt->errorInfo(),true));

	//print $db->lastInsertId(); 


//':title'=>$_POST['rev_name'],':review'=>$_POST['rev_message'],':rating'=>$_POST['rateng'],':dtime'=>date('Y-m-d H:i:s'),':user_id'=>$rating,':useragent'=>$_SERVER['HTTP_USER_AGENT']." REMOTE_ADDR:".$_SERVER['REMOTE_ADDR']
	if($var)
	{
		$resp_msg['status'] = "Success";
		$resp_msg['message'] = "Your order has placed successfully";
		//$resp_msg['data'] = $rev->getRestReviews($_POST['rev_rest_id']);
	}
	else
	{
		$resp_msg['status'] = "Failed";
		$resp_msg['message'] = "Please enter valid data";

	}
 echo json_encode($resp_msg);
}



?>