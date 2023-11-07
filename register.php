<?php


// Replace these with your actual database credentials
$servername ="localhost";
$username = "f32ee";
$password = "f32ee";
$dbname = "f32ee";


// Check if the user submitted the registration form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_email = $_POST["new-useremail"];
    $user_password = $_POST["new-password"];

    // Connect to the database
    $db = mysqli_connect($servername, $username, $password, $dbname);

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address: " . $user_email;
        header("Location: register.html");
    }
    if (strlen($user_password) < 9 || ctype_digit($user_password)) {
        echo "Password must be at least 9 length digits.";
        header("Location: register.html");
    }


    // Check if the user_email already exists
    $query = "SELECT id FROM USER WHERE user_email = '$user_email'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        // User already exists - provide an error message or redirect
        header("Location: failure.html");
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
            header("Location: failure.html");
        }
    }

    // Close the database connection
    mysqli_close($db);
}
?>
