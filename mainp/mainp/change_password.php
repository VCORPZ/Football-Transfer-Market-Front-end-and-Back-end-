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

// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];
} else {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = sanitize_input($_POST["currentPassword"]);
    $newPassword = sanitize_input($_POST["newPassword"]);
    $confirmPassword = sanitize_input($_POST["confirmPassword"]);

    // Validate current password (You may want to implement more secure password validation)
    $sqlValidate = "SELECT * FROM users WHERE User_id = $userID AND Password = '$currentPassword'";
    $resultValidate = $conn->query($sqlValidate);

    if ($resultValidate->num_rows > 0 && $newPassword == $confirmPassword) {
        // Update the password in the users table
        $sqlUpdate = "UPDATE users SET Password = '$newPassword' WHERE User_id = $userID";

        if ($conn->query($sqlUpdate) === TRUE) {
            echo "Password changed successfully";
        } else {
            echo "Error changing password: " . $conn->error;
        }
    } else {
        echo "Invalid current password or new passwords do not match";
    }
}

// Close the connection
$conn->close();

// Function to sanitize user input
function sanitize_input($input) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($input));
}
?>
