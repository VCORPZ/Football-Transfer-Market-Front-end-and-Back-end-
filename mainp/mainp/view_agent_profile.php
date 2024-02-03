<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Agent Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }

        h2 {
            color: #3498db;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <?php
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "kevin";
    $dbname = "your_database_name";  // Change this to your actual database name

    // Get agentID from the URL parameter
    $agentID = isset($_GET['agentID']) ? $_GET['agentID'] : null;

    // Validate and sanitize input
    $agentID = filter_var($agentID, FILTER_VALIDATE_INT);

    if ($agentID === false || $agentID === null) {
        echo "Invalid agent ID";
        exit();
    }

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to select agent profile based on agentID
    $sql = "SELECT * FROM agent WHERE Agent_ID = $agentID";
    $result = $conn->query($sql);

    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        echo "<h2>Agent Profile</h2>
              <table>
                <tr>
                    <th>Agent ID</th>
                    <th>Agent Name</th>
                    <th>Email Address</th>
                    <th>Agency</th>
                    <!-- Add more attributes as needed -->
                </tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['Agent_ID']}</td>
                    <td>{$row['Agent_Name']}</td>
                    <td>{$row['Email_Address']}</td>
                    <td>{$row['Agency']}</td>
                    <!-- Output more attributes as needed -->
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "No agent profile found.";
    }

    $conn->close();
    ?>

</body>
</html>
