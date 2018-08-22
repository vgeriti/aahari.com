<?php

session_start();
date_default_timezone_set('Asia/Calcutta');
function my_autoloader($class) {
    require 'manag/php/classes/' . $class . '.php';
}

spl_autoload_register('my_autoloader');

require dirname(__FILE__)."/payzippy-sdk/ChargingResponse.php";

if(!empty($_REQUEST))
{

//var_dump($_REQUEST);

$cres = new ChargingResponse($_REQUEST);

//var_dump($cres->get_response_params());
	$dob = new DBConnect();	
	$db = $dob->getDBConnection();			
	
//	echo "#".$dh['restaurant']."#/#".$cok['total_price']."#";
//	echo "*".$util->getFullAmount($dh['orestnt'], $cok['total_price'])."*";
	$stmt = $db->prepare("INSERT into payments 
		(merchant_id, merchant_key_id, order_id,payment_id,transaction_amount,transaction_status,transaction_response_code,transaction_response_message,payment_method,payment_instrument,bank_name,emi_months,transaction_currency,transaction_time,fraud_action,fraud_details, is_international, version, udf1, udf2, udf3, udf4, udf5, hash_method, hash_populated, validated, date_time, useragent) values 
		(:merchant_id, :merchant_key_id, :order_id,:payment_id,:transaction_amount,:transaction_status,:transaction_response_code,:transaction_response_message,:payment_method,:payment_instrument,:bank_name,:emi_months,:transaction_currency,:transaction_time,:fraud_action,:fraud_details, :is_international, :version, :udf1, :udf2, :udf3, :udf4, :udf5, :hash_method, :hash_populated, :validated, :date_time, :useragent)");
    //                                                                                                                       	 																			:delivery_time, :items, :name, :email, :mobile, :alternate_mobile, :delivery_address, :area, :special_request, :payment_method, :order_status, :user_id, :useragent, :dtimdate('Y-m-d H:i:s'),':user_id'=>$rating,':useragent'=>$_SERVER['HTTP_USER_AGENT']." REMOTE_ADDR:".$_SERVER['REMOTE_ADDR'])
	$var = $stmt->execute(array('merchant_id' => $cres->get_merchant_id(), 'merchant_key_id' => $cres->get_merchant_key_id(), ':order_id' => $cres->get_merchant_transaction_id(),':payment_id' => $cres->get_payzippy_transaction_id(), ':transaction_amount' => $cres->get_transaction_amount(), ':transaction_status' => $cres->get_transaction_status(), ':transaction_response_code' => $cres->get_transaction_response_code(), ':transaction_response_message' => $cres->get_transaction_response_message(), ':payment_method'=> $cres->get_payment_method(), ':payment_instrument' => $cres->get_payment_instrument(), ':bank_name' => "BANK_NAME", ':emi_months' => $cres->get_emi_months(), ':transaction_currency' => $cres->get_transaction_currency(), ':transaction_time' => $cres->get_transaction_time(), ':fraud_action' => $cres->get_fraud_action(), ':fraud_details' => $cres->get_fraud_details(), ':is_international' => $cres->get_is_international(), ':version' => $cres->get_version(), ':udf1' => "UDF1", ':udf2' => "UDF2", ':udf3' => "UDF3", ':udf4' => "UDF5", ':udf5' => "UDF5", ':hash_method' => $cres->get_hash_method(), ':hash_populated' => $cres->get_hash(), ':validated' => $cres->validate(), ':date_time' => date('Y-m-d H:i:s'), ':useragent' => $_SERVER['HTTP_USER_AGENT']." REMOTE_ADDR:".$_SERVER['REMOTE_ADDR']))or die(print_r($stmt->errorInfo(),true));
	

	header('Location:order.php?order='.$cres->get_merchant_transaction_id());
}
?>