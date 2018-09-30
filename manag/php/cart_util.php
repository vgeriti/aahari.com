<?php

function my_autoloader($class) {
    include 'classes/' . $class . '.php';
}

spl_autoload_register('my_autoloader');

require_once 'classes/Cart.php';
if(isset($_POST['rest_id']) && isset($_POST['quant']))
{
	$cart = new Cart();
	$cart->add_dish_to_cart($_POST['rest_id'],$_POST['quant']);
	$val = $cart->display_cart();
	$dishes = $val['dishes'];
	$val['html'] = $cart->display_cart_widget($cart->getRestId());
	echo json_encode($val);
//	header('Content-type: application/json');
}

if(isset($_POST['dsh_rm']))
{
	$cart = new Cart();
	$cart->remove_dish_from_cart($_POST['dsh_rm']);
	$val = $cart->display_cart();
	$dishes = $val['dishes'];
	$val['html'] = $cart->display_cart_widget($cart->getRestId());
	echo json_encode($val);
//	header('Content-type: application/json');	
}

if(isset($_POST['dsh_inc']))
{
	$cart = new Cart();
	$cart->increase_quantity($_POST['dsh_inc']);
	$val = $cart->display_cart();
	$dishes = $val['dishes'];
	$val['html'] = $cart->display_cart_widget($cart->getRestId());
	echo json_encode($val);
//	header('Content-type: application/json');	
}

if(isset($_POST['dsh_dec']))
{
	$cart = new Cart();
	$cart->decrease_quantity($_POST['dsh_dec']);
	$val = $cart->display_cart();
	$dishes = $val['dishes'];
	$val['html'] = $cart->display_cart_widget($cart->getRestId());
	echo json_encode($val);
//	header('Content-type: application/json');	
}
?>