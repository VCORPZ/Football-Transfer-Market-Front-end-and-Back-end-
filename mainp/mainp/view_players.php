<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Players</title>
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

    <h2>Players Table</h2>

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

    // Query to select data from the players table
    $sql = "SELECT playerid, playername, clubid, dateofbirth, nationality, position, height, weight FROM players";
    $result = $conn->query($sql);

    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Player ID</th>
                    <th>Player Name</th>
                    <th>Club ID</th>
                    <th>Date of Birth</th>
                    <th>Nationality</th>
                    <th>Position</th>
                    <th>Height</th>
                    <th>Weight</th>
                </tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['playerid']}</td>
                    <td>{$row['playername']}</td>
                    <td>{$row['clubid']}</td>
                    <td>{$row['dateofbirth']}</td>
                    <td>{$row['nationality']}</td>
                    <td>{$row['position']}</td>
                    <td>{$row['height']}</td>
                    <td>{$row['weight']}</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "No players found in the database.";
    }

    $conn->close();
    ?>

</body>
</html>
