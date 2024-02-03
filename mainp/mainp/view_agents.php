<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Agents</title>
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

    <h2>Agents Table</h2>

    <?php
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "kevin";
    $dbname = "transfer";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to select data from the agent table
    $sql = "SELECT agentid, agentname, contactnumber, email FROM agents";
    $result = $conn->query($sql);

    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Agent ID</th>
                    <th>Agent Name</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                </tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['agentid']}</td>
                    <td>{$row['agentname']}</td>
                    <td>{$row['contactnumber']}</td>
                    <td>{$row['email']}</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "No agents found in the database.";
    }

    $conn->close();
    ?>

</body>
</html>
