<?php
$useAPI = false;
// Query API
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = $_POST["query"];

    // Database connection parameters
    $servername = "localhost"; // Change this if your database is hosted elsewhere
    $username = "root"; // Your database username
    $password = ""; // Your database password
    $dbname = "brisbaneevents"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query($query);

    // you can modify this however
    print_r($result->fetch_all(MYSQLI_ASSOC));

    // Close connection
    $conn->close();
}