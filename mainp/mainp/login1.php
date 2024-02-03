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
    $username = sanitize_input($_POST["Username"]);
    $password = sanitize_input($_POST["Password"]);
    $role = sanitize_input($_POST["Role"]);

    // Query to check user credentials
    $sql = "SELECT * FROM users WHERE Username='$username' AND Password='$password' AND Role='$role'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $userDetails = $result->fetch_assoc();
        session_start();
        $_SESSION['user_id'] = $userDetails['User_id'];
        $_SESSION['username'] = $userDetails['Username'];
        $_SESSION['role'] = $userDetails['Role'];

        // Redirect based on role
        switch ($role) {
            case 'admin':
                header("Location: admin_dashboard.html");
                break;
            case 'player':
                header("Location: player_dashboard.php");
                break;
            case 'agent':
                header("Location: agent_dashboard.php");
                break;
            default:
                echo "Invalid role";
                break;
        }
    } else {
        echo "Invalid credentials";
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
