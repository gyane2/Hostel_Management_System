<?php
require('config.php');
?>
<form action="submit.php" method="post">
    <input type="number" name="amount" placeholder="Enter Amount in USD" required>
    <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="<?php echo $publishableKey?>"
        data-amount=""
        data-name="Payment System"
        data-description="Hostel fee Payments"
        data-image="https://th.bing.com/th/id/OIP.bK7vRheAzEyzqL1nchpTUQHaHa?pid=ImgDet&w=182&h=182&c=7"
        data-currency="usd"
        data-email=""
    >
    </script>
</form>