<?php
// Replace these with your actual database credentials
$hostname = "localhost";
$username = "your_username";
$password = "your_password";
$database = "your_database";

// Connect to the database
$db = mysqli_connect($hostname, $username, $password, $database);

if ($db) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newUsername = mysqli_real_escape_string($db, $_POST['new-username']);
        $newPassword = mysqli_real_escape_string($db, $_POST['new-password']);

        // You should perform additional validation and security checks here

        // Check if the username is unique (not already registered)
        $checkQuery = "SELECT id FROM user WHERE user_id = '$newUsername'";
        $checkResult = mysqli_query($db, $checkQuery);

        if ($checkResult && mysqli_num_rows($checkResult) > 0) {
            echo "Username is already taken. Choose another one.";
        } else {
            // Insert the new user into the database
            $insertQuery = "INSERT INTO user (user_id, user_password) VALUES ('$newUsername', '$newPassword')";
            $insertResult = mysqli_query($db, $insertQuery);

            if ($insertResult) {
                echo "Registration successful. You can now log in.";
            } else {
                echo "Error: " . mysqli_error($db);
            }
        }

        // Close the database connection
        mysqli_close($db);
    } else {
        echo "Invalid request.";
    }
} else {
    echo "Connection failed: " . mysqli_connect_error();
}
?>
