<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lao~X Cinema - Home</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="shortcut icon" type="image/jpg" href="./logo.png"/>
</head>
<body>
    <div id="wrapper">
        <header>
            <img id='company_logo' src="image\logo.png" alt="Logo" width="150px" height="100px">
        </header>
        <div id="nav">
            <nav>
                <ul class="nav">
                    <li class="nav"><a href="index.html">Home</a></li>
                    <li class="nav"><a href="movies.html">Movies</a></li>
                    <li class="nav"><a href="cinema.html">Cinema</a></li>
                    <li class="nav"><a class="active" href="cart.php">Cart</a></li>
                    <li class="nav"><a href="login.html">Register/Login</a></li>
                </ul>
            </nav>
        </div>
        
        <?php
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
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "my_project";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query the database for the user's order history
        $sql = "SELECT * FROM ticketorders WHERE userid = '$user_id'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Order History for User $user_id:</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Movie ID</th><th>Seat</th><th>Day of Week</th><th>Timing</th><th>Payment</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['movie_id'] . "</td>";
                echo "<td>" . $row['seat'] . "</td>";
                echo "<td>" . $row['dayofweek'] . "</td>";
                echo "<td>" . $row['timing'] . "</td>";
                echo "<td>" . $row['payment'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No order history found for User $user_id.</p>";
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
                <td>
                    <small>
                        <i>
                            We reserve the right to update this TERMS OF SERVICE from time to time as we expand our services. <br>
                            We will post a notice on our home page to inform you that an update has been made. <br>
                            Your use of the website or mobile application after this Policy has been updated will be deemed acceptance of the updated Policy. <br>&copy; 
                            Lao~X Cinema
                        </i>
                    </small>
                </td>
                       
                    </td>
               </tr>
           </table>
        </footer>
    </div>

</body>
</html>