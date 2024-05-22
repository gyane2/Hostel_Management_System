<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Integration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .payment-form {
            position: relative;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .payment-form input[type="number"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .stripe-button-el {
            margin-top: 20px;
            width: 100%;
        }

        .stripe-button-el span {
            background: #6772e5 !important;
            border: none !important;
            padding: 12px 0 !important;
            border-radius: 4px !important;
            width: 100%;
            text-align: center;
            color: white !important;
            font-size: 16px;
        }

        .payment-form img {
            max-width: 50px;
            margin-bottom: 20px;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #6772e5;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #556ac3;
        }
    </style>
</head>
<body>
    <?php require('config.php'); ?>
    <form action="submit.php" method="post" class="payment-form">
        <img src="https://th.bing.com/th/id/OIP.bK7vRheAzEyzqL1nchpTUQHaHa?pid=ImgDet&w=182&h=182&c=7" alt="Payment System">
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
        <a href="#" class="back-button" onclick="history.back(); return false;">Back</a>
    </form>
</body>
</html>
