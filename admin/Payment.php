<!DOCTYPE html>
<html>
<head>
    <title>Photo Details and Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
        }
        .photo {
            width: 30%;
            margin-right: 10px;
            margin-left:50px;
            padding-top: 50px;
        }
        .payment-form {
            width: 45%;
            margin-left: 10px;
            margin-right:150px;
        }
        .payment-form input[type=text], 
        .payment-form input[type=number], 
        .payment-form input[type=submit] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
        }
        .payment-form input[type=submit] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .payment-form input[type=submit]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
        }
    </style>
    <script>
        function showPaymentInfo(name, email) {
            alert("Payment Successful\n\nThank you, " + name + ", for your Payment!\nAn email receipt will be sent to " + email + ".");
        }

        function showError(message) {
            alert(message);
        }
    </script>
</head>
<body>

<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "hostelmsphp";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $card_number = $_POST['card_number'];
    $expiry_date = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];

    $payment_successful = true;

    if ($payment_successful) {
        // Validate card number
        if (!preg_match('/^\d{16}$/', $card_number)) {
            echo "<script>showError('Invalid card number. Please enter a 16-digit card number.');</script>";
        }
        // Validate expiry date format
        elseif (!preg_match('/^(0[1-9]|1[0-2])\/[0-9]{2}$/', $expiry_date)) {
            echo "<script>showError('Invalid expiry date format. Please enter MM/YY format.');</script>";
        } else {
            // Insert payment details into database
            $sql = "INSERT INTO payments (name, email, card_number, expiry_date, cvv) VALUES ('$name', '$email', '$card_number', '$expiry_date', '$cvv')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>showPaymentInfo('$name', '$email');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        echo "<div class='container'>";
        echo "<div class='photo'>";
        echo "<img src='photo.jpg' alt='Photo' style='width:100%;'>";
        echo "<ul>";
        echo "<li><strong>E-Pay</strong></li>";
        echo "<li><strong>E-Sewa</strong></li>";
        echo "<li><strong>Fee:</strong> $10.00</li>";
        echo "</ul>";
        echo "</div>";
        echo "<div class='payment-form'>";
        echo "<h2>Payment Failed</h2>";
        echo "<p>Sorry, your payment could not be processed.</p>";
        echo "</div>";
        echo "</div>";
    }
}

// Close connection
$conn->close();
?>

<div class="container">
    <div class="photo">
        <img src="../assets/images/QR.jpg" alt="Photo" style="width:100%;">
        <ul>
            <li><strong>E-Pay</strong></li>
            <li><strong>E-Sewa</strong></li>
            <li><strong>Fee:</strong> $10.00</li>
        </ul>
    </div>
    <div class="payment-form">
        <h2>Payment</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" name="name" placeholder="Your Name" required><br>
            <input type="text" name="email" placeholder="Your Email" required><br>
            <input type="text" name="card_number" placeholder="Card Number" required><br>
            <input type="text" name="expiry_date" placeholder="MM/YY" required><br>
            <input type="number" name="cvv" placeholder="CVV" required><br>
            <input type="submit" value="Make Payment">
        </form>
    </div>
</div>

</body>
</html>
