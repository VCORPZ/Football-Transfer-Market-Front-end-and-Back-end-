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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $playerName = sanitize_input($_POST["playername"]);
    $dateOfBirth = sanitize_input($_POST["dateofbirth"]);
    $nationality = sanitize_input($_POST["nationality"]);
    $position = sanitize_input($_POST["position"]);
    $height = sanitize_input($_POST["height"]);
    $weight = sanitize_input($_POST["weight"]);
    $clubID = sanitize_input($_POST["clubid"]);

    // Get the maximum Player_ID from the players table
    $sqlMaxID = "SELECT MAX(playerid) as max_id FROM players";
    $resultMaxID = $conn->query($sqlMaxID);

    if ($resultMaxID && $rowMaxID = $resultMaxID->fetch_assoc()) {
        // Increment the maximum Player_ID by 1
        $newPlayerID = $rowMaxID['max_id'] + 1;

        // Insert the new player into the players table
        $sqlInsert = "INSERT INTO players (playerid, playername, dateofbirth, nationality, position, height, weight, clubid)
                      VALUES ($newPlayerID, '$playerName', '$dateOfBirth', '$nationality', '$position', '$height', '$weight', '$clubID')";

        if ($conn->query($sqlInsert) === TRUE) {
            echo "Player added successfully with playerid: $newPlayerID";
        } else {
            echo "Error adding player: " . $conn->error;
        }
    } else {
        echo "Error retrieving maximum playerid";
    }
}

$conn->close();

// Function to sanitize user input
function sanitize_input($input) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($input));
}
?>
