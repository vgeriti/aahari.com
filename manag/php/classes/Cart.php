<?php
require_once 'DBConnect.php';
require_once 'Dishes.php';
class Cart
{
private $cart_id;
private $cart_session;
private $dish_id;
private $dish_name;
private $dish_price;
private $dish_quantity;
private $con;
private $cart_items;
private $total_price;
private $dish_items;
private $rest_id;

function getRestId()
{
	return $this->rest_id;
}
function __construct()
{
	$db = new DBConnect();
	
	$this->con = $db->getDBConnection();
	$con = $db->getDBConnection();
	if(isset($_COOKIE['_kps']) && $_COOKIE['_kps'] != '')
	{
		$this->cart_session = $_COOKIE["_kps"];
		$con = $db->getDBConnection();
		$st = $con->prepare("SELECT * from cart where session = ?");
		$st->execute(array($this->cart_session));
		if($st->rowCount() == 1)
		{
			while($rp = $st->fetch())
			{
//				var_dump($rp);
			}
		}
				
	}
/*	$this->cart_id = null;
	$this->cart_session = null;
	$this->dish_id = null;
	$this->dish_name = null;
	$this->dish_price = 0;
	$this->dish_quantity = 0;
	$this->cart_items = array();
	$this->total_price = 0;
	$this->dish_items = array();*/
	
}

function add_dish_to_cart($d_id,$quant)	
{
	$dishes = new Dishes();
	$dish_ary = $dishes->getDishById($d_id);
	if($dish_ary)
	{
		$this->cart_session = $_COOKIE['_kps'];
		//echo "in dish_array-yes";
		$dish_ary['quantity'] = $quant;
		$this->rest_id = $dish_ary['restaurant'];
		$this->dish_items[$dish_ary['dish_id']] = $dish_ary;
		//echo json_encode($this->dish_items);
		$this->total_price = ($quant*$dish_ary['dish_price']) + $this->total_price;
		$this->cart_items['dishes'] = $this->dish_items;
		$this->cart_items['total_price'] = $this->total_price;
//		 = $dish_ary['total_price'];
		$b = new DBConnect;
		$con = $b->getDBConnection();
		$stt = $con->prepare("SELECT items from cart where session = ?");
		$stt->execute(array($this->cart_session));
		$rtp = $stt->fetch();
		$artp = array();
		$old_items = array();
		if($rtp['items'] != "" and !empty($rtp['items']))
		{

			$old_items = json_decode($rtp['items'],true);				
//		echo " items fetch ";
			$this->add_items($this->cart_items,$old_items);
		}
		//echo $this->cart_session;
		//var_dump($this->dish_items);
		$this->display_cart();		
		$ap = array(':items' => json_encode($this->cart_items),':session'=> $this->cart_session);
		$st = $con->prepare("UPDATE cart set items=:items where session = :session");
		$st->execute($ap) or die(print_r($st->errorInfo()));

/*		$this->get_total_price();
		$this->cart_items['dishes'] = $this->dish_items;
		$this->cart_items['total_price'] = */
	}	
}

function add_items($new, $old)
{
//	echo "in add_items ";
	$dishes_new = $new['dishes'];
	$dishes_old = $old['dishes'];
//	var_dump($dishes_old);
//	echo " ******************* ";
	foreach($dishes_old as $key => &$value)
	{

		if(array_key_exists($key,$dishes_new))
		{
		//	echo " found match in array ";
			$n_q = $dishes_new[$key];
			$value['quantity'] = (int)$value['quantity'] + $n_q['quantity'];	
		//	echo "new quantity value is ".$value['quantity'];		
			unset($dishes_new[$key]);
		}
			
	}
	
	if(sizeof($dishes_new)>0)
	$dishes_up = $dishes_old + $dishes_new;
	else
	$dishes_up = $dishes_old;
	/*echo "@@Start of old dishes@@";
	var_dump($dishes_old);
	echo "@@end of old dishes@@";
	var_dump($this->dish_items);*/
	$this->dish_items = $dishes_up;
	$this->display_cart();
	
}

function remove_dish_from_cart($d_id)
{
	$b = new DBConnect;
		$con = $b->getDBConnection();
		$stt = $con->prepare("SELECT items from cart where session = ?");
		$stt->execute(array($this->cart_session));
		$rtp = $stt->fetch();
		$cart_items = json_decode($rtp['items'],true);
			
	$this->dish_items = $cart_items['dishes'];
//	var_dump($cart_items['dishes']);
	if(!empty($this->dish_items))
		{
			foreach($this->dish_items as $dis)
			{
					if($dis['dish_id'] == $d_id)
					unset($this->dish_items[$dis['dish_id']]);
			}
		$this->display_cart();		
		$ap = array(':items' => json_encode($this->cart_items),':session'=> $this->cart_session);
		$st = $con->prepare("UPDATE cart set items=:items where session = :session");
		$st->execute($ap) or die(print_r($st->errorInfo()));
			
		}
}

function decrease_quantity($d_id)
{
//	var_dump($this->dish_items);
	$b = new DBConnect;
		$con = $b->getDBConnection();
		$stt = $con->prepare("SELECT items from cart where session = ?");
		$stt->execute(array($this->cart_session));
		$rtp = $stt->fetch();
		$cart_items = json_decode($rtp['items'],true);
			
	$this->dish_items = $cart_items['dishes'];
//	var_dump($cart_items['dishes']);
	if(!empty($this->dish_items))
	{
		foreach($this->dish_items as $dis)
		{
				if($dis['dish_id'] == $d_id && $dis['quantity'] >= 0)
				{					
					$dis['quantity']=$dis['quantity'] -1;			
					if($dis['quantity'] == 0)
					return $this->remove_dish_from_cart($d_id);
				}
				$this->dish_items[$dis['dish_id']] = $dis;
		}
		$this->display_cart();		
		$ap = array(':items' => json_encode($this->cart_items),':session'=> $this->cart_session);
		$st = $con->prepare("UPDATE cart set items=:items where session = :session");
		$st->execute($ap) or die(print_r($st->errorInfo()));
	}
//		var_dump($this->dish_items);	
}

function increase_quantity($d_id)
{
	$b = new DBConnect;
		$con = $b->getDBConnection();
		$stt = $con->prepare("SELECT items from cart where session = ?");
		$stt->execute(array($this->cart_session));
		$rtp = $stt->fetch();
		$cart_items = json_decode($rtp['items'],true);
			
	$this->dish_items = $cart_items['dishes'];
//	var_dump($cart_items['dishes']);
	if(!empty($this->dish_items))
	{
	foreach($this->dish_items as $dis)
	{
			if($dis['dish_id'] == $d_id)
			{
				$dis['quantity']=$dis['quantity'] +1;			
			}
			$this->dish_items[$dis['dish_id']] = $dis;
	}
	$this->display_cart();		
		$ap = array(':items' => json_encode($this->cart_items),':session'=> $this->cart_session);
		$st = $con->prepare("UPDATE cart set items=:items where session = :session");
		$st->execute($ap) or die(print_r($st->errorInfo()));
	}
}

function display_cart_echo()
{	
	$this->cart_items['dishes'] = $this->dish_items;
	$this->calculate_total_price();
	echo var_dump($this->cart_items);
	echo "<br>";
	$_SESSION['cart'] = $this->cart_items;
//	echo $this->total_price;
}

function display_cart()
{
	$this->cart_items['dishes'] = $this->dish_items;
	if(!empty($this->dish_items))
	{
		$var = reset($this->dish_items);
	}
	$this->rest_id = $var['restaurant'];
	$this->calculate_total_price();
	return $this->cart_items;
}

function display_cart_widget($id)
{
		$b = new DBConnect;
		$con = $b->getDBConnection();
		$stt = $con->prepare("SELECT items from cart where session = ?");
		$stt->execute(array($this->cart_session));
		$rtp = $stt->fetch();
		$artp = array();
		$old_items = array();
		if($rtp['items'] != "" and !empty($rtp['items']))
		{
			$old_items = json_decode($rtp['items'],true);	
		}
		$items = $old_items['dishes'];
//		echo var_dump($items)."<br/>";
//		echo json_encode($items)."<br/>";
	$pst = $con->prepare("SELECT servicecharge,vat_tax,deliveryCharges from restaurants where id = ?");
	
	if($id =="") 
	$id = $this->rest_id;
	
	$pst->execute(array($id));
	$prt = $pst->fetch();
		$txt = '';
		if(!empty($items))
		{
/*$txt = "<b><center>Hydrabadi Biryani<br /><img src="images/plus.png" width="15" height="14" style="margin-bottom:-1px;" />2 × 200
<img src="images/minus.png" width="15" height="14" style="margin-bottom:-1px;" />&nbsp; <img src="images/cart.png" width="18" height="17" style="margin-bottom:-3px;" />
                    &nbsp; <img src="images/cross.png" width="15" height="14" style="margin-bottom:-1px;" />
                    </center>
                </b>";			*/
	foreach($items as $k => $v)
	{
//		echo $v['dish_id']."<br>";
		$txt = $txt."<b><center>".$v['dish_name']."<br/><a href='javascript:increase_quantity(".$v['dish_id'].");' ><img src='images/plus.png' width='15' height='14' style='margin-bottom:-1px;' /></a>".$v['quantity']." × ".$v['dish_price']."<a href='javascript:decrease_quantity(".$v['dish_id'].");' ><img src='images/minus.png' width='15' height='14' style='margin-bottom:-1px;' /></a>&nbsp; <img src='images/cart.png' width='18' height='17' style='margin-bottom:-3px;' />&nbsp; <a href='javascript:remove_from_cart(".$v['dish_id'].")'><img src='images/cross.png' width='15' height='14' style='margin-bottom:-1px;' /></a></center></b>";
	}
		}
		$service_tax_amount = round(($prt['servicecharge']*$old_items['total_price'])/100,2); //$prt['servicecharge']
		$vat_tax_amount = round(($prt['vat_tax']*$old_items['total_price'])/100,2); //$prt['vat_tax']
		$total_amount = round($old_items['total_price']+$service_tax_amount+$vat_tax_amount+$prt['deliveryCharges'],0, PHP_ROUND_HALF_UP);
		$cart_amount = "<div class='clear_10'></div><hr /><center><table><tr><td >Subtotal </td><td > : Rs. <span id='sub_total'>".$old_items['total_price']."</span></td></tr><tr><td >Service Tax</td><td > : Rs. <span id='service_tax'>".$service_tax_amount."</span></td></tr><tr><td >Vat Tax</td><td > : Rs. <span id='vat_tax'>".$vat_tax_amount."</span></td></tr><tr><td >Delivery Charges</td><td > : Rs. <span id='delivery_charges'>".$prt['deliveryCharges']."</span></td></tr><tr><td >Discount</td><td > : Rs. 0</td></tr></table><hr /><table><tr><td> Total &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp; </td><td> : Rs. <span id='total_cost'>".$total_amount."</span></td></tr></table></center>";
		return $txt.$cart_amount;
}

function calculate_total_price(){
	
	$ary =$this->dish_items;
	$tp_price = 0;
	$price = 0;
	foreach($ary as $ar )
	{
		$price = $ar['dish_price']*$ar['quantity'];		
		$tp_price += $price;				
		//echo "<br>*** For ".$ar['dish_id']." amount is ".$tp_price."***<br>";
	}
	$this->total_price = $tp_price;
	$this->cart_items['total_price'] = $this->total_price;
}
function get_total_price()
{
	return $this->total_price;
}

}

?>