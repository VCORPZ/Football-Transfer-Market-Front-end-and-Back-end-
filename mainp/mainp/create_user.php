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
    $username = sanitize_input($_POST["Username"]);
    $password = sanitize_input($_POST["Password"]);
    $role = sanitize_input($_POST["Role"]);

    // Get the maximum User_ID from the users table
    $sqlMaxID = "SELECT MAX(User_id) as max_id FROM users";
    $resultMaxID = $conn->query($sqlMaxID);

    if ($resultMaxID && $rowMaxID = $resultMaxID->fetch_assoc()) {
        // Increment the maximum User_ID by 1
        $newUserID = $rowMaxID['max_id'] + 1;

        // Insert the new user into the users table
        $sqlInsert = "INSERT INTO users (User_id, Username, Password, Role)
                      VALUES ($newUserID, '$username', '$password', '$role')";

        if ($conn->query($sqlInsert) === TRUE) {
            echo "User created successfully with user_id: $newUserID";
        } else {
            echo "Error creating user: " . $conn->error;
        }
    } else {
        echo "Error retrieving maximum User_id";
    }
}

$conn->close();

// Function to sanitize user input
function sanitize_input($input) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($input));
}
?>
