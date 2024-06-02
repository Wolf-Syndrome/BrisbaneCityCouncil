<!DOCTYPE html>
<html>
    <title>Database test website</title>
    <body>
        <h1>Database test website</h1>
        <?php
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

            $sql = "SELECT * FROM Users";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "User ID: " . $row["user_id"]. " - Name: " . $row["first_name"]. " " . $row["last_name"]. "<br>";
                }
            } else {
                echo "0 results";
            }

            // Close connection
            $conn->close();
        ?>
    </body>
</html>