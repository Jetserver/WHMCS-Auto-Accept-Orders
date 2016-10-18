# WHMCS-Auto-Accept-Orders

This WHMCS Hook will auto accept orders. There is no need to manually accept them anymore !
No more “pending” orders…

Hook is highly customizable with a settings section that will let you set the following –

* Activate product provisioning (yes/no)
* Perform domain automation (yes/no)
* Send welcome email to client (yes/no)
* Accept only paid orders (yes/no)
* Set specific payment methods (i.e, “paypal”)

# Installation

Edit it with your favourite code editor (we recommend notepad++).

In the begining of the hook file, you will find our settings section –


	return array( 
		'apiuser'		=> 'apiuser',
		'autosetup' 		=> false,
		'sendregistrar' 	=> false, 
		'sendemail' 		=> false, 
		'ispaid'		=> true, 
		'paymentmethod'		=> array(''), 
	);


* apiuser – one of the admins username
* autosetup – determines whether product provisioning is performed
* sendregistrar – determines whether domain automation is performed
* sendemail – sets if welcome emails for products and registration confirmation emails for domains should be sent
* ispaid – set to true if you want to accept only paid orders
* paymentmethod – set the payment method you want to accept automaticly (leave empty to use all payment methods). Payment method should be exactly as it named in WHMCS (copy & paste the gateway name)

Once you finished the editing the settings, upload it to your WHMCS hooks folder (“includes/hooks“).

That’s all !
