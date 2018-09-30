<?php
include 'php/classes/DBConnect.php';
class Restaurant{
private $restaurant_id;
private $name;
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
private $closedOn;
private $deliverTo;
private $deliveryTime;
private $deliveryFrom;
private $deliveryTo;
private $minDeliveyAmount;
private $serviceTax;
private $deliveryCharges;
private $ratesOnTax;

public function getName(){
	return $this->name; 
}
function setName($name){
	$this->name=$name;
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
function setRestaurantDisplayName($dispName){
	$this->restaurantDisplayName=$dispName;
}
function getRestaurantDisplayName(){
	return $this->restaurantDisplayName;
}
function setOrderEmail($orderEmail){
	$this->ordersEmail = $orderEmail;
	}
function setFeedbackEmail($feedbackEmail){
	$this->feedbackEmail = $feedbackEmail;
	}
function setDoorNo($doorNo){
	$this->doorNo = $doorNo;
	}
function setLandmark($landmark){
	$this->landmark = $landmark;
	}
function setPincode($pincode){
	$this->pincode = $pincode;
	}
function setContact1($contact1){
	$this->contact1 = $contact1;
	}
function setContact2($contact2){
	$this->contact2 = $contact2;
	}
function setContact3($contact3){
	$this->contact3 = $contact3;
	}
function setFeatures($features){
	$this->features = $features;
	}
function setservices($services){
	$this->services = $services;
	}
function setClosedOn($closedOn){
	$this->closedOn = $closedOn;
	}
function setDeliverTo($deliverTo){
	$this->deliverTo = $deliverTo;
	}
function setDeliveryTime($deliverTime){
	$this->deliveryTime = $deliverTime;
	}
function setDeliveryFrom($deliverFrom){
	$this->deliveryFrom = $deliverFrom;
	}
function setMinDeliveyAmount($minDeliveryAmount){
	$this->minDeliveyAmount = $minDeliveryAmount;
	}
function setServiceTax($servicesTax){
	$this->serviceTax = $servicesTax;
	}
function setDeliveryCharges($deliveryCharges){
	$this->deliveryCharges = $deliveryCharges;
	}
function setRatesOnTax($ratesOnTax){
	$this->ratesOnTax = $ratesOnTax;
	}
function getRestaurant($name){
	
	
}
}
?>