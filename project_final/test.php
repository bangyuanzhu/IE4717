<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lao~X Cinema - Orders</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/jpg" href="image/logo.png"/>
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
            $servername ="localhost";
            $username = "f32ee";
            $password = "f32ee";
            $dbname = "f32ee";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Get selected movie, cinema, date_time, and timing

            $user_id = $_POST["user_id"];
            $user_email = $_POST["user_email"];
            $seat_id = $_POST["seat_id"];
            // // $movie_id = $_POST["movie_id"];
            // // $cinema_id = $_POST["cinema_id"];
            // // $date_time = $_POST["date_time"];
            // // $timing = $_POST['timing'];
            // // $seat_code = $_POST['selected_seats'];
            $selectedPaymentMethod = $_POST['payment_method'];


            
            $upd1 = "UPDATE ticketorders SET payment='$selectedPaymentMethod' WHERE userid = '$user_id' AND payment = 'pending'";
            
            $seat_id_array = explode(",", $seat_id);
            foreach ($seat_id_array as $seatid) {
                $upd2 = "UPDATE availability SET booking_status=1 WHERE id = '$seatid'";
                // echo "<p class='order_history'>Try1:$seatid</p>";
                if ($conn->query($upd1) !== true) {
                    echo "Error:". $upd1 . "<br>" . $conn->error;
                }
                if ($conn->query($upd2) !== true) {
                    echo "Error:". $upd2 . "<br>" . $conn->error;
                }
            }
            // echo "<p class='order_history'>Try2:$seat_id</p>";

            echo "<h2 class='order_history'>&nbsp Orders in cart for $user_email have been confirmed.</h2>";
            echo "<p class='order_history'>Click <a href='cart.php'>here </a> to see your orders.</p>";
            

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