<?php
require('stripe-php-master/init.php');

$publishableKey="pk_test_51PD39T017GGa7fivNhIgPN0NC7JuNkItdCjMiJK4QBc3kV5TIIILkluq63ev3WMR3Ed1LRv6OjhZHL6VPsiKzS7O00UnP56eHC";

$secretKey="sk_test_51PD39T017GGa7fivJl1JxXFcfT32rs9wl805GaMkG3GEWbxkA2wuE6l54PygjUb6xwGVHXuMuHAWIzq6SrAwoqi2002Dey8VB4";

\Stripe\Stripe::setApiKey($secretKey);

?>