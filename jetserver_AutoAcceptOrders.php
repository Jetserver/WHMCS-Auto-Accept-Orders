<?php
/*
*
* Auto Accept Orders
* Created By Idan Ben-Ezra
*
* Copyrights @ Jetserver Web Hosting
* www.jetserver.net
*
* Hook version 1.0.1
*
**/
if (!defined("WHMCS"))
	die("This file cannot be accessed directly");

/*********************
 Auto Accept Orders Settings
*********************/
function jetserverAutoAcceptOrders_settings()
{
	return array(
		'apiuser'		=> '', // one of the admins username
		'autosetup' 		=> false, // determines whether product provisioning is performed
		'sendregistrar' 	=> false, // determines whether domain automation is performed
		'sendemail' 		=> false, // sets if welcome emails for products and registration confirmation emails for domains should be sent 
		'ispaid'		=> true, // set to true if you want to accept only paid orders
		'paymentmethod'		=> array(), // set the payment method you want to accept automaticly (leave empty to use all payment methods) * example array('paypal','amazonsimplepay')
	);
}
/********************/

function jetserverAutoAcceptOrders_accept($vars) 
{
	$settings = jetserverAutoAcceptOrders_settings();

	$ispaid = true;

	if($vars['InvoiceID'])
	{
		$result = localAPI('getinvoice', array(
			'invoiceid' 		=> $vars['InvoiceID'],
		), $settings['apiuser']);

		$ispaid = ($result['result'] == 'success' && $result['balance'] <= 0) ? true : false;
	}

	if((!sizeof($settings['paymentmethod']) || sizeof($settings['paymentmethod']) && in_array($vars['PaymentMethod'], $settings['paymentmethod'])) && (!$settings['ispaid'] || $settings['ispaid'] && $ispaid))
	{
		$result = localAPI('acceptorder', array(
			'orderid' 		=> $vars['OrderID'],
			'autosetup' 		=> $settings['autosetup'],
			'sendregistrar' 	=> $settings['sendregistrar'],
			'sendemail' 		=> $settings['sendemail'],
		), $settings['apiuser']);
	}
}

add_hook('AfterShoppingCartCheckout', 0, 'jetserverAutoAcceptOrders_accept');

?>
