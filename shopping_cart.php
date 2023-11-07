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
        session_start();
        ini_set('display_errors', TRUE);
      error_reporting(-1);
        if (isset($_SESSION['user_id'])) 
        {
            $user_id = $_SESSION['user_id'];
            $user_email = $_SESSION['user_email'];
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

        // Query the database for the user's order history
        $sql = "SELECT * FROM ticketorders WHERE userid = '$user_id' AND payment = 'pending'";

        $result = $conn->query($sql);
        $seat_id = "";
        if ($result->num_rows > 0) {
            echo "<h2 class='order_history'>&nbsp &nbsp Shopping cart for User $user_email:</h2>";
            echo "<table class='order_history' border='1' >";
            echo "<tr><th>Cinema</th><th>Movie Name</th><th>Seat</th><th>Day of Week</th><th>Timing</th></tr>";

            while ($row = $result->fetch_assoc()) {
                $movie_names = array(
                    1 => "Freelance",
                    2 => "Oppenheimer",
                    3 => "Creation Of The Gods I: Kingdom Of Storms",
                    4 => "Oppenheimer",
                );
                $movie_name = $movie_names[$row['movie_id']];
    
                $cinema_names = array(
                    1 => "Lao~X Theatre VivoCity",
                    2 => "Lao~X Theatre Jurong Point",
                    3 => "Lao~X Theatre Tiong Bahru",
                );
                $cinema_name = $cinema_names[$row['cinema_id']];
                $seat_id = $seat_id.','.$row['seat_id'];
                
                echo "<tr>";
                echo "<td>" . $cinema_name . "</td>";
                echo "<td>" . $movie_name . "</td>";
                echo "<td>" . $row['seat'] . "</td>";
                echo "<td>" . $row['dayofweek'] . "</td>";
                echo "<td>" . $row['timing'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
            
            $selectedPaymentMethod = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';

            echo "<h4 class='order_history'>Select Payment Method:</h4>";
            echo "<form action='test.php' method='post'>";
            echo "<label for='payment_method' style='color:#e9e7d7;font-size: 20px;margin:5%;'>Payment Method:<br></label>";
            echo "<select name='payment_method' id='payment_method' style='margin-left:5%;' required >";
            echo "<option value='Master'>Master</option>";
            echo "<option value='Visa'>Visa</option>";
            echo "<option value='PayLah'>PayLah</option>";
            echo "</select>";
            echo "<input type='hidden' name='user_id' value='$user_id'>";
            echo "<input type='hidden' name='user_email' value='$user_email'>";
            echo "<input type='hidden' name='seat_id' value='$seat_id'>";
            // echo $seat_id;
            echo "<input style='margin-left:20px;padding: 5px;'type='submit' value='Continue to Payment'>";
            echo "</form>";
            
        } 
        
        
        else {
            echo '<font style="color: #e9e7d7; font-size: 24px;> ';
            echo '<font style="color: #e9e7d7; font-size: 24px;> '."<p> &nbsp &nbsp  No order history found for User $user_email.</p>";
        }

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