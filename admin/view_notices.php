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

    // Fetch data from database
    $sql = "SELECT * FROM notices";
    $result = $conn->query($sql);

    if(isset($_GET['del'])) {
        $id = intval($_GET['del']);
        $sql = "DELETE FROM notices WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
           
            echo "<script>alert('Record has been deleted');</script>";
           // header("Refresh:0");
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }

    // Close database connection
  //  $conn->close();
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
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-heading {
            margin-bottom: 20px;
        }
        /* Custom CSS for positioning the button */
        .go-back-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="action-heading">
        <h2>Notices</h2>
    </div>
    <!-- Go Back Button -->
    <button class="btn btn-primary mb-3 go-back-button" onclick="goBack()">Go Back</button>

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Action</th> <!-- Added Action column heading -->
            </tr>
        </thead>
        <tbody>
            <?php
                // Display data in HTML table
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["title"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td>" . $row["date"] . "</td>";
                        echo "<td>";
                        // Add action links/buttons for delete and edit
                       
                        echo "<a href='?del=".$row['id']."' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No notices found</td></tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function goBack() {
        window.location = "dashboard.php";
    }
</script>
</body>
</html>
