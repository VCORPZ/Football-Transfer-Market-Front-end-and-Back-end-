<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
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
            width: 50%;
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

// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];

    // Query to select user details based on User_id
    $sql = "SELECT * FROM users WHERE User_id = $userID";
    $result = $conn->query($sql);

    echo "<h2>User Profile</h2>";

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Role</th>
                </tr>";

        $row = $result->fetch_assoc();

        echo "<tr>
                <td>{$row['User_id']}</td>
                <td>{$row['Username']}</td>
                <td>{$row['Role']}</td>
              </tr>";

        echo "</table>";
    } else {
        echo "<p>User not found.</p>";
    }
} else {
    // Redirect to the login page if not logged in
    header("Location: login1.php");
    exit();
}

$conn->close();
?>

</body>
</html>
