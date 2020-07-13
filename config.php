<?php
require_once "vendor/autoload.php";
include "db.php";
 
use Omnipay\Omnipay;
 
define('CLIENT_ID', 'AT-SVDOy6ZccOCBi0Fhice3bDrPRIbnEkyYNaTPx0gzdLVZ6GUrNtvy5wKrnJ9ZT3ypGC6tzGkLQ08Lv');
define('CLIENT_SECRET', 'EElWuWLF--RsFT2BMGxzx5lMdKlOPRPg73DT5_6utqoNTJd9YdBqu7whEyb-4Zl2W-45l6zwAF_6m-PE');
 
define('PAYPAL_RETURN_URL', 'http://localhost/online/success.php');
define('PAYPAL_CANCEL_URL', 'http://localhost/online/cancel.php');
define('PAYPAL_CURRENCY', 'USD'); // set your currency here
 
// Connect with the database 

 
$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(true); //set it to 'false' when go live