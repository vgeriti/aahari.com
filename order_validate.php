<?php
session_start();
date_default_timezone_set('Asia/Calcutta');

function my_autoloader($class) {
    require 'manag/php/classes/' . $class . '.php';
}

spl_autoload_register('my_autoloader');

require dirname(__FILE__)."/payzippy-sdk/ChargingRequest.php";

if(isset($_POST['order_type']))
{

//echo "Order is ". $_POST['order_type'];
	$dob = new DBConnect();
	$util = new Utilities();
	$db = $dob->getDBConnection();
	$cok = $util->getSessionValue('_kps');
	$dish = $cok['dishes'];
	$dh = array_pop($dish);
    $bank = isset($_POST['inet_b'])?isset($_POST['inet_b']):"";
//	echo "#".$dh['restaurant']."#/#".$cok['total_price']."#";
//	echo "*".$util->getFullAmount($dh['orestnt'], $cok['total_price'])."*";
	$stmt = $db->prepare("INSERT into orders (restaurant_id, order_type, amount, delivery_time, items, name, email, mobile, alternate_mobile, delivery_address, area, special_request, payment_method, bank_code, order_status, user_id, useragent, dtime) values 
		(:restaurant_id, :order_type, :amount, :delivery_time, :items, :name, :email, :mobile, :alternate_mobile, :delivery_address, :area, :special_request, :payment_method, :bank_code, :order_status, :user_id, :useragent, :dtime)");
    //                                                                                                                       	 																			:delivery_time, :items, :name, :email, :mobile, :alternate_mobile, :delivery_address, :area, :special_request, :payment_method, :order_status, :user_id, :useragent, :dtimdate('Y-m-d H:i:s'),':user_id'=>$rating,':useragent'=>$_SERVER['HTTP_USER_AGENT']." REMOTE_ADDR:".$_SERVER['REMOTE_ADDR'])
	$var = $stmt->execute(array(':restaurant_id'=>$_POST['orestnt'],':order_type' => $_POST['order_type'], ':amount' => $util->getFullAmount($dh['restaurant'], $cok['total_price']), ':delivery_time' => $_POST['dorder_time'], ':items' => json_encode($cok['dishes']), ':name' => $_POST['oname'], ':email' => $_POST['oemail'], ':mobile' => $_POST['omobile'], ':alternate_mobile' => $_POST['oamobile'], ':delivery_address' => $_POST['oaddress'], ':area' => $_POST['oarea'], ':special_request' => $_POST['osrequest'], ':payment_method' => $_POST['opayment'], ':bank_code'=> $bank, ':order_status' => "OPEN", ':user_id' => $_POST['order_type'], ':useragent' => $_SERVER['HTTP_USER_AGENT']." REMOTE_ADDR:".$_SERVER['REMOTE_ADDR'], ':dtime' => date('Y-m-d H:i:s')))or die(print_r($stmt->errorInfo(),true));
	$_SESSION['order_id'] = $db->lastInsertId();
	$tran_amount = (int)$util->getFullAmount($dh["restaurant"], $cok["total_price"])*100;
    $items_total = 0;
    $items_vertical = '';
    $util->getItemsDetail($cok, $items_total, $items_vertical);
    //$items_vertical = $util->getItemsVertical();



//->set_bank_name($_POST["bank_name"])
	
//':title'=>$_POST['rev_name'],':review'=>$_POST['rev_message'],':rating'=>$_POST['rateng'],':dtime'=>date('Y-m-d H:i:s'),':user_id'=>$rating,':useragent'=>$_SERVER['HTTP_USER_AGENT']." REMOTE_ADDR:".$_SERVER['REMOTE_ADDR']
	if($var)
	{
		
		if($_POST['opayment'] == "CREDIT" || $_POST['opayment'] == "DEBIT")
		{
			//echo $db->lastInsertId()." Thanks for CC/DC"; 
            //echo $bank;
            $pz_charging = new ChargingRequest();   
            $pz_charging->set_buyer_email_address($_POST["oemail"])
            ->set_merchant_transaction_id($_SESSION['order_id'])
            ->set_transaction_amount($tran_amount)
            ->set_payment_method($_POST["opayment"])
            ->set_ui_mode("REDIRECT")
            ->set_callback_url("http://aahari.com/postp_order.php")            
            ->set_item_total($items_total)
            ->set_item_vertical($items_vertical)
            ->set_buyer_phone_no($_POST['omobile'])
            ->set_bank_name($_POST['inet_b']);

            $charging_object = $pz_charging->charge();
           // var_dump(is_int($util->getFullAmount($dh['restaurant'], $cok['total_price'])*100));
            if ($charging_object["status"] != "OK"){
            echo '<p>Error: ', $charging_object["error_message"], "</p>";
            exit();
            }

		}
		else if($_POST['opayment'] == "COD")
            header('Location: order.php?order='.$_SESSION['order_id']);
			//echo $db->lastInsertId()." Thanks for your order. COD";

?>
<html>
    <head>
        <title>Payzippy Integration Example</title>
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
	<style>
            .main-info {
                background-color: #fcf8e3;
                border: 2px solid #fbeed5;
                color: #c09853;
                padding: 25px;
                width: 670px;
                -moz-border-radius: 10px;
                -webkit-border-radius: 10px;
                -ms-border-radius: 10px;
                border-radius: 10px;
                -moz-text-shadow: 0 1px 0 rgba(255,255,255,0.5);
                -webkit-text-shadow: 0 1px 0 rgba(255,255,255,0.5);
                -ms-text-shadow: 0 1px 0 rgba(255,255,255,0.5);
                text-shadow: 0 1px 0 rgba(255,255,255,0.5);
                margin: 120px auto 0 auto;
                text-align: center;
                font: 25px/110% "Lucida Grande","Lucida Sans Unicode",Helvetica,Arial,Verdana,sans-serif;
            }
            .progress {
                width: 400px;
                margin: 30px auto 0 auto;
            }
            .no-re-warn{
                margin: 0 auto;
                text-align: center;
                width: 670px;
                font: 18px/100% "Lucida Grande","Lucida Sans Unicode",Helvetica,Arial,Verdana,sans-serif;
                padding: 25px;
            }
    </style>
	<div class="container">
        <div class="wrap inter-content" id="detect-iframe" style="display: block;">
            <section class="main-info">
                Processing your payment request...
                <div class="progress progress-striped active">
                    <div class="bar" style="width: 100%;"></div>
                </div>
            </section>
            <p class="no-re-warn not">Please do not press stop, refresh or back button</p>
        </div>

        <!--
        For integration using RIDIRECT mode, create a new HTML form, with hidden elements.
        Set its "action" attribute to $charging_object["url"].
        Create hidden input elements for every key, value pair in $charging_object["params"].
        -->
        <form method="POST" action="<?php echo $charging_object["url"]?>" id="payzippyForm">
            <?php
            foreach($charging_object["params"] as $key => $value) {
                echo "<input type='hidden' name='{$key}' value='$value'>";
            }

        //    for($i=0;$i<=1000000;$i++)
          //      echo "";
           // echo "<h1>".$charging_object["url"]."</h1>";
            ?>
        </form>
    </div>
    <script>
        document.getElementById("payzippyForm").submit();
    </script>
</body>
</html>


<?php


		
	}
	else
	{
		$resp_msg['status'] = "Failed";		

	}	

}
else
header('Location:https://aahari.com');

?>