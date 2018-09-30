<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once 'DBConnect.php';
require_once(dirname(__FILE__).'/Constants.php');
class Restaurant{
	private $restaurant_id;
	private $newOne;
	private $name;
	private $restURL;
	private $restaurantDisplayName;
	private $ordersEmail;
	private $feedbackEmail;
	private $area;
	private $doorNo;
	private $landmark;
	private $pincode;
	private $contact1;
	private $contact2;
	private $contact3;
	private $features;
	private $services;
	private $payment;
	private $closedOn;
	private $deliverPlaces;
	private $deliver_distance;
	private $deliveryTime;
	private $deliveryFrom;
	private $deliveryTo;
	private $discount;
	private $minDeliveyAmount;
	private $serviceTax;
	private $vatTax;
	private $deliveryCharges;
	private $ratesOnTax;
	private $hh_start;
	private $hh_end;
	private $aboutUs;
	private $latitude;
	private $longitude;

	function __construct(){
		$this->restaurant_id = null;
		$this->newOne = null;
		$this->name = null;
		$this->restURL = null;
		$this->restaurantDisplayName = null;
		$this->ordersEmail = null;
		$this->feedbackEmail = null;
		$this->area = null;
		$this->doorNo =null;
		$this->landmark =null;
		$this->pincode =null;
		$this->contact1 = null;
		$this->contact2 = null;
		$this->contact3 = null;
		$this->features = null;;
		$this->services = null;
		$this->payment = null;
		$this->closedOn = null;
		$this->deliverPlaces = null;
		$this->deliver_distance = null;
		$this->deliveryTime = null;
		$this->deliveryFrom = null;;
		$this->deliveryTo = null;
		$this->minDeliveyAmount = null;
		$this->serviceTax = array();
		$this->vatTax = array();
		$this->deliveryCharges = null;
		$this->discount = array();
		$this->ratesOnTax = null;
		$this->hh_start = null;
		$this->hh_end = null;
		$this->aboutUs = null;
		$this->latitude = null;
		$this->longitude = null;
	}
	function getName(){
		return $this->name; 
	}
	function setName($name){
		$this->name=$name;
	}
	function getRestURL(){
		return $this->restURL; 
	}
	function setRestURL($name){
		$this->restURL=$name;
	}
	function setNewOne(){
		$this->newOne = true;
	}
	function getNewOne(){
		return $this->newOne;
	}
	function getId(){
		return $this->restaurant_id;
	}
	function setId($id){
		$this->restaurant_id=$id;
	}
	function setArea($area){
		$this->area= $area;
	}
	function getArea(){
		return $this->area;
	}
	function getAreaName(){
		$d = new DBConnect();
		$con = $d->getDBConnection();
		$st = $con->prepare("SELECT name from areas where id = ?");	
		$st->execute(array($this->area));
		$rw=$st->fetch();
		return $rw['name'];
	}
	function setRestaurantDisplayName($dispName){
		$this->restaurantDisplayName=$dispName;
	}
	function getRestaurantDisplayName(){
		return $this->restaurantDisplayName;
	}
	function setOrderEmail($orderEmail){
		$this->ordersEmail = $orderEmail;
	}
	function getOrderEmail(){
		return $this->ordersEmail;
	}
	function setFeedbackEmail($feedbackEmail){
		$this->feedbackEmail = $feedbackEmail;
	}
	function getFeedbackEmail(){
		return $this->feedbackEmail;
	}
	function setDoorNo($doorNo){
		$this->doorNo = $doorNo;
	}
	function getDoorno(){
		return $this->doorNo;
	}
	function setLandmark($landmark){
		$this->landmark = $landmark;
	}
	function getLandmark(){
		return $this->landmark;
	}
	function setPincode($pincode){
		$this->pincode = $pincode;
	}
	function getPincode(){
		return $this->pincode;
	}
	function setContact1($contact1){
		$this->contact1 = $contact1;
	}
	function getContact1(){
		return $this->contact1;
	}
	function setContact2($contact2){
		$this->contact2 = $contact2;
	}
	function getContact2(){
		return $this->contact2;
	}
	function setContact3($contact3){
		$this->contact3 = $contact3;
	}
	function getContact3(){
		return $this->contact3;
	}
	function setFeatures($features){
		$this->features = $features;
	}
	function getFeatures(){
		return $this->features;
	}
	function getFeaturesJSON(){
		return json_encode($this->features);
	}
	function setServices($services){
		$this->services = $services;
	}
	function getServices(){
		return $this->services;
	}
	function getServicesJSON(){
		return json_encode($this->services);
	}
	function setClosedOn($closedOn){
		$this->closedOn = $closedOn;
	}
	function getClosedOn(){
		return $this->closedOn;
	}
	function getClosedOnJSON(){
		return json_encode($this->closedOn);
	}
	function setPayment($payment){
		$this->payment = $payment;
	}
	function getPayment(){
		return $this->payment;
	}
	function getPaymentJSON(){
		return json_encode($this->payment);
	}
	function setDeliverPlaces($deliverPlaces){
		$this->deliverPlaces = $deliverPlaces;
	}
	function getDeliverPlaces(){
		return $this->deliverPlaces;
	}
	function setDeliverDistance($deliverDistance){
		$this->deliver_distance = $deliverDistance;
	}
	function getDeliverDistance(){
		return $this->deliver_distance;
	}
	function setDeliveryTime($deliverTime){
		$this->deliveryTime = $deliverTime;
	}
	function getDeliveryTime(){
		return $this->deliveryTime;
	}
	function setHHStart($hhStart){
		$this->hh_start = $hhStart;
	}
	function getHHStart(){
		return $this->hh_start;
	}
	function setHHEnd($hhEnd){
		$this->hh_end = $hhEnd;
	}
	function getHHEnd(){
		return $this->hh_end;
	}
	function setDeliveryFrom($deliverFrom){
		$this->deliveryFrom = $deliverFrom;
	}
	function getDeliveryFrom(){
		return $this->deliveryFrom;
	}
	function getDeliveryFrom12(){
		return date("h:i A",strtotime($this->deliveryFrom));
	}
	function setDeliveryTo($deliveryTo){
		$this->deliveryTo = $deliveryTo;
	}
	function getDeliveryTo(){
		return $this->deliveryTo;
	}
	function getDeliveryTo12(){		
		return date("h:i A",strtotime($this->deliveryTo));
	}
	function setMinDeliveyAmount($minDeliveryAmount){
		$this->minDeliveyAmount = $minDeliveryAmount;
	}
	function getMinDeliveryAmount(){
		return $this->minDeliveyAmount;
	}
	function setServiceTax($serviceType, $servicesTax){
		$this->serviceTax[$serviceType] = $servicesTax;
	}
	function getServiceTax($serviceType = ''){
		if($serviceType != '')			
			return $this->serviceTax[$serviceType];
		else
			return $this->serviceTax;
	}
	function setDiscount($serviceType, $discount){
		$this->discount[$serviceType] = $discount;
	}
	function getDiscount($serviceType = ''){
		if($serviceType != '')			
			return $this->discount[$serviceType];
		else
			return $this->discount;
	}
	function setVatTax($serviceType, $vatTax)
	{
		$this->vatTax[$serviceType] = $vatTax;
	}
	function getVatTax($serviceType = ''){
		if($serviceType != '')			
			return $this->vatTax[$serviceType];
		else
			return $this->vatTax;
	}
	function setDeliveryCharges($deliveryCharges){
		$this->deliveryCharges = $deliveryCharges;
	}
	function getDeliveryCharges(){
		return $this->deliveryCharges;
	}
	function setRatesOnTax($ratesOnTax){
		$this->ratesOnTax = $ratesOnTax;
	}
	function getRatesOnTax(){
		return $this->ratesOnTax;
	}
	function setAboutUs($about_us){
		$this->aboutUs = $about_us;
	}
	function getAboutUs(){
		return $this->aboutUs;
	}
	function setLatitude($latitude){
		$this->latitude = $latitude;
	}
	function getLatitude(){
		return $this->latitude;
	}
	function setLongitude($longitude){
		$this->longitude = $longitude;
	}
	function getLongitude(){
		return $this->longitude;
	}
	function isOpen($current_time){				
		$date1 = strtotime($current_time);
		$date2 = strtotime($this->deliveryFrom);		
		$date3 = strtotime($this->deliveryTo);
		if ($date1 >= $date2 && $date1 <= $date3)
			return true;
		else
			return false;
	}
	function findServices($service,$prest_id){		
		$db = new DBConnect;
		$con = $db->getDBConnection();
		$st = $con->prepare("SELECT services from restaurants where id = ?");
		if(isset($this->restaurant_id) && $this->restaurant_id != null)
			$st->execute(array($this->restaurant_id));
		else
			$st->execute(array($prest_id));
		$rp = $st->fetch();
		return strpos($rp['services'],$service);
	}
	function findFeatures($features){		
		$db = new DBConnect;
		$con = $db->getDBConnection();
		$st = $con->prepare("SELECT features from restaurants where id = ?");
		$st->execute(array($this->restaurant_id));
		$rp = $st->fetch();
		return strpos($rp['features'],$features);
	}
	function findPayment($payment){
		$db = new DBConnect;
		$con = $db->getDBConnection();
		$st = $con->prepare("SELECT payment from restaurants where id = ?");
		$st->execute(array($this->restaurant_id));
		$rp = $st->fetch();
		return strpos($rp['payment'],$payment);
	}
	function getRestaurant($url){
		$db = new DBConnect();
		$con = $db->getDBConnection();
		try{
			//$name=str_replace('-',' ',$name);	
			if(is_numeric($url))
				$sql = "SELECT * from restaurants where id =?";
			else
				$sql = "SELECT * from restaurants where rest_url =?";

			$stmt = $con->prepare($sql);
			$stmt->execute(array($url))or die(print_r($stmt->errorInfo(),true));
			$row=$stmt->fetch();
			if($stmt->rowCount() == 1)
			{
				//echo "row id ".$row['name'];
				$this->restaurant_id=$row['id'];
				$this->restURL=$row['rest_url'];
				$this->name=$row['name'];
				$this->restURL = $row['rest_url'];
				$this->restaurantDisplayName = $row['name'];
				$this->ordersEmail = $row['email'];
				$this->feedbackEmail = $row['feed_email'];
				$this->area = $row['area_id'];
				$this->doorNo = $row['doorNo'];
				$this->landmark = $row['landmark'];
				$this->pincode = $row['pincode'];
				$this->contact1 = $row['contact1'];
				$this->contact2 = $row['contact2'];
				$this->contact3 = $row['contact3'];
				$this->features = $row['features'];
				$this->services = $row['services'];
				$this->payment = $row['payment'];
				//echo "*".$this->payment."*";
				$this->closedOn = $row['closedOn'];
				$this->deliver_distance = $row['deliver_distance'];
				$this->deliveryTime = $row['edeliverytime'];
				$this->deliveryTo = $row['end_time'];
				$this->deliveryFrom = $row['start_time'];
				$this->minDeliveyAmount = $row['mindeliveryamount'];
				$this->serviceTax = json_decode($row['servicecharge'], true);
				//echo json_decode($row['servicecharge'], true);
				$this->vatTax = json_decode($row['vat_tax'], true);
				$this->discount = json_decode($row['discount'], true);
				$this->deliveryCharges = $row['deliveryCharges'];
				$this->ratesOnTax = $row['ratesOnTax'];
				$this->hh_start = $row['happyh_start'];
				$this->hh_end = $row['happyh_end'];
				$this->aboutUs = $row['aboutus'];
				$this->latitude = $row['latitude'];
				$this->longitude = $row['longitude'];
			}	
		}
		catch(Exception $e)
		{
			$e->getMessage();
			$e->getTraceAsString();
		}
	}

	function getRestArea()
	{
		$db = new DBConnect();
		$con = $db->getDBConnection();
		$sql = "SELECT name from areas where id =?";

			$stmt = $con->prepare($sql);
			$stmt->execute(array($this->area))or die(print_r($stmt->errorInfo(),true));
			$row=$stmt->fetch();
			if($stmt->rowCount() == 1)
				return $row['name'];
	}
	
	function createRestURL($str)
	{
		$str = strtolower($str);
		$str = str_replace('&', 'and', $str);
		$str = preg_replace('/[-\'.)(\/\\s]/',"-", $str);		
		$str = preg_replace('/[-]+/', '-', $str);
		return $str;
	}
	function saveRestaurant($data,$rest_status)
	{
		$db = new DBConnect();
		$con = $db->getDBConnection();
		//echo "Restaurant_status ".$rest_status." /data_id ".$data[':id']."<br/>";
		echo "This rest area is ".$this->getRestArea();
		//$rest_url = 
		//$data[':rest_url'] = $this->createRestURL($data[':name']);
		if(isset($data[':rest_url']))
		echo "@#$ ".$data[':rest_url']." @#$";

		$c_rest_url = $this->createRestURL($data[':name'])."-".$this->createRestURL($this->getRestArea());
		$ary1 = array(':rest_url' => $c_rest_url);
		
		if($rest_status =='n' && !isset($data[':id']))
		{
			$data = $ary1+$data;
			echo "inserting new one";
			$stmt = $con->prepare("INSERT into restaurants(name, rest_url, area_id, doorNo, landmark, pincode, contact1, contact2, contact3, email, feed_email, features, services, closedOn, deliver_distance, edeliverytime, start_time, end_time, happyh_start, happyh_end, aboutus,latitude, longitude, servicecharge, vat_tax, discount, mindeliveryamount, deliveryCharges, payment, time, useragent, ipaddr, inserted) VALUES 
														 (:name, :rest_url, :area_id, :doorNo, :landmark, :pincode, :contact1, :contact2, :contact3, :email, :feed_email, :features, :services, :closedOn, :deliver_distance, :edeliverytime, :start_time, :end_time, :happyh_start, :happyh_end, :aboutus, :latitude, :longitude, :servicecharge, :vat_tax, :discount, :mindeliveryamount, :deliveryCharges, :payment, :time, :useragent, :ipaddr, :inserted)");
			echo "^^ ".array_pop($data);	
		}
		
		else if($rest_status!='n' && isset($data[':id']) && !empty($data[':id']))
		{
			echo "updating old value/".var_dump($data);
			$stmt = $con->prepare("UPDATE restaurants set name=:name, area_id=:area_id, doorNo=:doorNo, landmark=:landmark, pincode=:pincode, contact1=:contact1, contact2=:contact2, contact3=:contact3, email=:email, feed_email=:feed_email, features=:features, services=:services,  deliver_distance=:deliver_distance, closedOn=:closedOn, edeliverytime=:edeliverytime, start_time=:start_time, end_time=:end_time, happyh_start=:happyh_start, happyh_end=:happyh_end, aboutus=:aboutus, latitude=:latitude, longitude=:longitude, servicecharge=:servicecharge, vat_tax=:vat_tax, discount=:discount, mindeliveryamount=:mindeliveryamount, deliveryCharges=:deliveryCharges, payment=:payment, time=:time, useragent=:useragent, ipaddr=:ipaddr, inserted=:inserted where id=:id");
			//$stmt->execute(array($this->name));
		}
		$stmt->execute($data);
		print_r($stmt->errorInfo(),true);
	}
}
?>