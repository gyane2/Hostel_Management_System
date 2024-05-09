<?php
// Database connection
$servername = "localhost";
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $regNumber = $_POST['regNumber'];
    $studentName = $_POST['studentName'];
    $reportTitle = $_POST['reportTitle'];
    $description = $_POST['description'];

    // Sanitize data (prevent SQL injection)
    $regNumber = mysqli_real_escape_string($conn, $regNumber);
    $studentName = mysqli_real_escape_string($conn, $studentName);
    $reportTitle = mysqli_real_escape_string($conn, $reportTitle);
    $description = mysqli_real_escape_string($conn, $description);

    // Insert data into database
    $sql = "INSERT INTO reports (regNumber, studentName, reportTitle, description) VALUES ('$regNumber', '$studentName', '$reportTitle', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Report submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Hostel Management System</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
}

input[type="text"],
textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    resize: vertical;
}

button[type="submit"],
button {
    background-color: blueviolet;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button[type="submit"]:hover,
button:hover {
    background-color: lightblue;
}

.button-group {
    display: flex;
    justify-content: space-between;
}

button {
    margin-top: 20px;
}
</style>
</head>
<body>
    <div class="container">
        <h2>Report Form</h2>
        <form id="reportForm" action="report.php" method="post">
            <div class="form-group">
                <label for="regNumber">Register Number:</label>
                <input type="text" id="regNumber" name="regNumber" required>
            </div>
            <div class="form-group">
                <label for="studentName">Student Name:</label>
                <input type="text" id="studentName" name="studentName" required>
            </div>
            <div class="form-group">
                <label for="reportTitle">Report Title:</label>
                <input type="text" id="reportTitle" name="reportTitle" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="button-group">
                <button type="submit">Submit</button>
                <button type="button" onclick="goBack()">Back</button>
            </div>
        </form>
    </div>

    <script> 
    function goBack() {
    window.location="dashboard.php";
}

document.getElementById("reportForm").addEventListener("submit", function(event) {
    //event.preventDefault();
    // You can add your form submission logic here
    console.log("Form submitted!");
    // For example, you can send the form data to a server using AJAX
});
</script>
</body>
</html>
