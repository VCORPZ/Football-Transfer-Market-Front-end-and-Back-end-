<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Players for Agent</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
            background-color: #f0f0f0;
        }

        h2 {
            color: #3498db;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "kevin";
$dbname = "transfer";  // Change this to your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Replace $agentID with the actual agent ID you want to query
$agentID = 211;  // Change this to the desired agent ID

// Query to select agent, player, and transfer information
$sql = "SELECT a.agentname, p.playername, t.transferfee, t.transferdate
        FROM transfers t
        INNER JOIN agents a ON t.agentid = a.agentid
        INNER JOIN players p ON t.playerid = p.playerid
        WHERE t.agentid = $agentID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Players for Agent</h2>
          <table>
            <tr>
                <th>Agent Name</th>
                <th>Player Name</th>
                <th>Transfer Fee</th>
                <th>Transfer Date</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['agentname']}</td>
                <td>{$row['playername']}</td>
                <td>{$row['transferfee']}</td>
                <td>{$row['transferdate']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No players found for the agent.";
}

$conn->close();
?>

</body>
</html>
