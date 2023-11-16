<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lao~X Cinema - Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/png" href="image/logo.png"/>
</head>
<body>
    <div id="wrapper">
        <header id="cinema_header">
            <img id='cinema_logo' src="image/logo.png" alt="logo" >
            <table class="cinema">
                <tr>
                    <td>
                        <a href="index.html">Home</a>
                    </td>
                    <td>
                        <a href="movies.html">Movies</a>
                    </td>
                    <td>
                        <a href="cinema.html">Cinemas</a>
                    </td>
                    <td>
                        <a href="cart.php">Orders</a>
                    </td>
                    <td>
                        <a href="login.html">Login/Register</a>
                    </td>                   
                </tr>
            </table>
        </header>

        <?php
        ini_set('display_errors', TRUE);
        error_reporting(-1);
        session_start();
        if (isset($_SESSION['user_id'])) 
        {
            $user_id = $_SESSION['user_id'];
        } 
        else 
        {
            $message = "Please Log in first.";
            $redirectURL = "login.html";


            echo "<script>alert('$message');</script>";
            echo "<script>window.location.href = '$redirectURL';</script>";
        }

        // Establish a database connection (replace with your database credentials)
            $servername ="localhost";
            $username = "f32ee";
            $password = "f32ee";
            $dbname = "f32ee";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Get selected movie, cinema, date_time, and timing

            $movie_id = $_POST["movie_id"];
            $cinema_id = $_POST["cinema_id"];
            $date_time = $_POST["date_time"];
            $timing = $_POST['timing'];


            // Retrieve seat availability based on selected parameters
            $sql = "SELECT seat_code, booking_status FROM availability
                    WHERE movie_id = $movie_id
                    AND cinema_id = $cinema_id
                    AND date_time = '$date_time'
                    AND timing = '$timing'
                    ORDER BY seat_code";

            $result = $conn->query($sql);

            // Create a form to select seats
            echo "<h2 class='order_history'>Select Seats:</h2>";
            echo "<img src='image/seating.png' hspace='31%' width='500'>";
            echo "<form action='booking_confirmation.php' method='post'>";
            echo "<div style='display: flex; flex-wrap: wrap; padding-left:20%; padding-top:20px;'>";
            $available_seats = [];

            while ($row = $result->fetch_assoc()) {
                $seat_code = $row['seat_code'];
                $booking_status = $row['booking_status'];
                // Check if the seat is available
                if ($booking_status == 0) {
                    $available_seats[] = $seat_code;
                    echo "<input type='checkbox' name='selected_seats[]' value='$seat_code' id='seat_$seat_code'>";
                } else {
                    echo "<input type='checkbox' name='selected_seats[]' value='$seat_code' id='seat_$seat_code' disabled>";
                }
                echo "<label for='seat_$seat_code' style='color:#e9e7d7;font-size: 20px;'>$seat_code</label>";
            }

            echo "</div>";
            
            echo "<input type='hidden' name='user_id' value='$user_id'>";
            echo "<input type='hidden' name='movie_id' value='$movie_id'>";
            echo "<input type='hidden' name='cinema_id' value='$cinema_id'>";
            echo "<input type='hidden' name='date_time' value='$date_time'>";
            echo "<input type='hidden' name='timing' value='$timing'>";
            echo "<input style='margin-left:46.5%;margin-top:20px; padding: 15px;' type='submit' value='Continue'>";
            echo "</form>";

            $conn->close();
        ?>
            
            
            
            <div class="push"></div>
            <footer class="footer">
            <table>
                <tr>
                    <td><small><b>Terms and Conditions</b></small></a></td>
                </tr>
                <tr>
                    <td><small><i>By using our servicces, you hereby agree to these terms. When you 
                        access this website, you acknowledge that you <br>have read and agree to abide by 
                        the terms described. If you do not agree to the terms, 
                        you should exit this site. <br>Lao~X Cinema</i></small>                      
                     </td>
                </tr>
            </table>
         </footer>
    </div>

</body>
</html>
