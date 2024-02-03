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
    $agentName = sanitize_input($_POST["agentname"]);
    $contactNo = sanitize_input($_POST["contactnumber"]);
    $email = sanitize_input($_POST["email"]);

    // Get the maximum Agent_ID from the agents table
    $sqlMaxID = "SELECT MAX(agentid) as max_id FROM agents";
    $resultMaxID = $conn->query($sqlMaxID);

    if ($resultMaxID && $rowMaxID = $resultMaxID->fetch_assoc()) {
        // Increment the maximum Agent_ID by 1
        $newAgentID = $rowMaxID['max_id'] + 1;

        // Insert the new agent into the agents table
        $sqlInsert = "INSERT INTO agents (agentid, agentname, contactnumber, email)
                      VALUES ($newAgentID, '$agentName', '$contactNo', '$email')";

        if ($conn->query($sqlInsert) === TRUE) {
            echo "Agent added successfully with agentid: $newAgentID";
        } else {
            echo "Error adding agent: " . $conn->error;
        }
    } else {
        echo "Error retrieving maximum agentid";
    }
}

$conn->close();

// Function to sanitize user input
function sanitize_input($input) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($input));
}
?>
