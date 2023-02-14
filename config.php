<?php

// Product Details
// Minimum amount is $0.50 US
$productName = "Demo Product";
$productID = "DP12345";
$productPrice = 500;
$currency = "usd";

/*
 * Stripe API configuration
 * Remember to switch to your live publishable and secret key in production!
 * See your keys here: https://dashboard.stripe.com/account/apikeys
 */
define('STRIPE_API_KEY', 'sk_test_51Mb6f5D7BV4eABuKozCCTLrvZ5HXELtGX8ouypMUa76pQLVs6escXfNC9w7vNylT5ScAA2RRYzOcsVLXtVACVdUA00TSjdCXpL');
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51Mb6f5D7BV4eABuKNtymF1noAioq0vEE9fdUrrtWylBVxO3oO2LSVGRJRoHD2dQkX9mxGmQEEWGeAv85ofRtforR00t69TeQ7a');
define('STRIPE_SUCCESS_URL', 'http://localhost/W-Clsopenbox/payment-success.php'); //Payment success URL
define('STRIPE_CANCEL_URL', 'http://localhost/W-Clsopenbox/payment-cancel.php'); //Payment cancel URL

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'clsopenbox');

