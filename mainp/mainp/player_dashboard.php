<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Dashboard</title>
    <style>
     body {
    background-image: url('images/pl_completed_transfers.webp');
    background-size: cover;
    background-repeat: no-repeat;
    height: 100vh;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    text-align: center;
    margin: 20px;
}

        header {
            color: #343a40;
            padding: 10px;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
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
    // Start the session
    session_start();

    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        $userID = $_SESSION['user_id'];
        $username = $_SESSION['username'];
    } else {
        // Redirect to the login page if not logged in
        header("Location: login1.php");
        exit();
    }
    ?>

    <header>
        <h1>Welcome <?php echo $username; ?></h1>
    </header>

    <form action="change_password.php" method="post">
        <h2>Change Password</h2>

        <label for="User_id">User ID:</label>
        <input type="text" id="User_id" name="User_id" value="<?php echo $userID; ?>" readonly>

        <label for="currentPassword">Current Password:</label>
        <input type="Password" id="currentPassword" name="currentPassword" required>

        <label for="newPassword">New Password:</label>
        <input type="Password" id="newPassword" name="newPassword" required>

        <label for="confirmPassword">Confirm Password:</label>
        <input type="Password" id="confirmPassword" name="confirmPassword" required>

        <button type="submit">Change Password</button>
    </form>


    <button type="button" onclick="window.location.href='view_transfer_history.php?table=transfers&playerid=<?php echo $userID; ?>'">View Transfer History</button>
    <button type="button" onclick="window.location.href='view_profile.php?table=players'">View Profile</button>
</body>
</body>
</html>
