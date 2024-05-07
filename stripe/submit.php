<?php
require('config.php');
\Stripe\Stripe::setVerifySslCerts(false);

$token = $_POST['stripeToken'];
$amount = $_POST['amount']; // Retrieve the amount entered by the user

$data = \Stripe\Charge::create(array(
    "amount" => $amount * 100, // Stripe requires amount in cents
    "currency" => "usd",
    "description" => "Hostel fee payment",
    "source" => $token,
));

echo "<pre>";
print_r($data);
?>