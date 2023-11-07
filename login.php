<?php
session_start();
ini_set('display_errors', TRUE);
error_reporting(-1);

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $servername ="localhost";
    $username = "f32ee";
    $password = "f32ee";
    $dbname = "f32ee";

    // Connect to the database
    $db = mysqli_connect($servername, $username, $password, $dbname);

    if ($db) {
        // Get user input from the form
        $user_email = mysqli_real_escape_string($db, $_POST['user_email']);
        $user_password = mysqli_real_escape_string($db, $_POST['user_password']);

        // Query the database to verify user credentials
        $query = "SELECT * FROM USER WHERE user_email = '$user_email' AND user_password = '$user_password'";
        $result = mysqli_query($db, $query);

        if ($result && mysqli_num_rows($result) == 1) {
            // User is authenticated; set session variables
            $user = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $user['id'];
            
            $_SESSION['user_email'] = $user['user_email'];

            // Redirect to the welcome page
            echo "Welcome" ;
            if ($_SESSION['user_email'] == 'admin@localhost'){
                $redirectURL = "admin.php";
            }
            else{$redirectURL = "movies.html";}
            
            echo "<script>window.location.href = '$redirectURL';</script>";
        } else {
            echo "Invalid username or password.";
        }

        // Close the database connection
        mysqli_close($db);
    } else {
        echo "Connection failed: " . mysqli_connect_error();
    }
}
?>
