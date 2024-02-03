<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Transfer History</title>
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

        button {
            padding: 12px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
        }

        button:hover {
            background-color: #2980b9;
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

    // Query to select data from transfers, players, and clubs tables
    $sql = "SELECT t.transferid, t.transferfee, t.transferdate, 
                   p.playername, 
                   c.clubname AS fromclubname, 
                   cc.clubname AS toclubname
            FROM transfers t
            INNER JOIN players p ON t.playerid = p.playerid
            INNER JOIN clubs c ON t.fromclubid = c.clubid
            INNER JOIN clubs cc ON t.toclubid = cc.clubid";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Transfer History</h2>
              <table>
                <tr>
                    <th>Transfer ID</th>
                    <th>Player Name</th>
                    <th>From Club</th>
                    <th>To Club</th>
                    <th>Transfer Fee</th>
                    <th>Transfer Date</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['transferid']}</td>
                    <td>{$row['playername']}</td>
                    <td>{$row['fromclubname']}</td>
                    <td>{$row['toclubname']}</td>
                    <td>{$row['transferfee']}</td>
                    <td>{$row['transferdate']}</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "No transfer history found.";
    }

    $conn->close();
    ?>

</body>
</html>
