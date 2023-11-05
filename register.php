<?php
// Replace these with your actual database credentials
$servername ="localhost";
$username = "f32ee";
$password = "f32ee";
$dbname = "f32ee";

// Check if the user submitted the registration form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_email = $_POST["user_email"];
    $user_password = $_POST["user_password"];

    // Connect to the database
    $db = mysqli_connect($servername, $username, $password, $dbname);

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the user_email already exists
    $query = "SELECT id FROM USER WHERE user_email = '$user_email'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        // User already exists - provide an error message or redirect
        header("Location: register.html");
    } else {
        // User doesn't exist, insert a new record
        $insertQuery = "INSERT INTO USER (user_email, user_password) VALUES ('$user_email', '$user_password')";
        if (mysqli_query($db, $insertQuery)) {
            $message = "Successfully Registered";
            echo "<script type='text/javascript'>alert('$message');</script>";
            // Registration successful, redirect to login page
            header("Location: login.html");
        } else {
            // Registration failed - provide an error message or redirect
            header("Location: register.html");
        }
    }

    // Close the database connection
    mysqli_close($db);
}
?>
