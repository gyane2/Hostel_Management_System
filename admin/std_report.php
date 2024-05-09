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

    // Fetch data from the reports table
    $sql = "SELECT * FROM reports";
    $result = $conn->query($sql);

    // Close database connection
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .go-back-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
        }
    </style>
</head>
<body>
    <h2>Reports</h2>
    <table>
        <tr>
            <th>Register Number</th>
            <th>Student Name</th>
            <th>Report Title</th>
            <th>Description</th>
        </tr>
        <?php
        // Display data in HTML table
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["regNumber"] . "</td>";
                echo "<td>" . $row["studentName"] . "</td>";
                echo "<td>" . $row["reportTitle"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No reports found</td></tr>";
        }
        ?>
    </table>

    <!-- Go Back Button -->
    <button class="go-back-button" onclick="goBack()">Go Back</button>

    <script>
        function goBack() {
            window.location = "dashboard.php";
        }
    </script>
</body>
</html>
