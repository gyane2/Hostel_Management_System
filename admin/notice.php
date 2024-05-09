<?php
// Database connection
$servername = "localhost"; // Replace with your MySQL server hostname
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "hostelmsphp"; // Replace with your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    // Sanitize data
    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    $date = mysqli_real_escape_string($conn, $date);

    // Insert data into database
    $sql = "INSERT INTO notices (title, description, date) VALUES ('$title', '$description', '$date')";

    if ($conn->query($sql) === TRUE) {
        $message = "Notice added successfully";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Hostel Management System</title>
    <style>
        .notice-form {
            max-width: 700px;
            margin: 25px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            position: relative; /* For positioning buttons */
        }

        .notice-form h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        textarea,
        input[type="date"] {
            width: calc(100% - 20px); /* Adjusted width */
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            /* Increase height */
            height: 150px; /* Adjust the height as needed */
        }

        button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Positioning buttons */
        .submit-button {
            position: absolute;
            left: 10px;
            bottom: 10px;
        }

        .back-button {
            position: absolute;
            right: 10px;
            bottom: 10px;
        }

        /* Adjust spacing between date and buttons */
        .date-group {
            margin-bottom: 30px;
        }

        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            z-index: 9999;
        }

        .popup h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .popup-button {
            display: block;
            margin: 0 auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

    </style>
</head>
<body>

<div class="notice-form">
    <h2>Write Your Notice</h2>
    <form id="notice-form" method="post">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <div class="form-group date-group">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
        </div>
        <button type="submit" class="submit-button">Submit</button>
        <button type="button" onclick="goBack()" class="back-button">Back</button>
    </form>
</div>

<div id="popup" class="popup">
    <h2><?php echo $message; ?></h2>
    <button class="popup-button" onclick="goBack()">Done</button>
</div>

<script>
    function goBack() {
      window.location = "dashboard.php";
    }

    window.onload = function () {
        var popup = document.getElementById('popup');
        <?php if ($message !== "") { ?>
        popup.style.display = 'block';
        <?php } ?>
    }
</script>

</body>
</html>
