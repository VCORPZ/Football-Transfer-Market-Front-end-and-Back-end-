<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Transfers</title>
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

    <h2>Transfers Table</h2>

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

    // Query to select data from the transfers table
    $sql = "SELECT transferid, playerid, agentid, fromclubid, toclubid, transferfee, transferdate FROM transfers";
    $result = $conn->query($sql);

    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Transfer ID</th>
                    <th>Player ID</th>
                    <th>Agent ID</th>
                    <th>From Club ID</th>
                    <th>To Club ID</th>
                    <th>Transfer Fee</th>
                    <th>Transfer Date</th>
                </tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['transferid']}</td>
                    <td>{$row['playerid']}</td>
                    <td>{$row['agentid']}</td>
                    <td>{$row['fromclubid']}</td>
                    <td>{$row['toclubid']}</td>
                    <td>{$row['transferfee']}</td>
                    <td>{$row['transferdate']}</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "No transfers found in the database.";
    }

    $conn->close();
    ?>

</body>
</html>
