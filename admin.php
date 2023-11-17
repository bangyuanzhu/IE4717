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
                            <a href="login.html">Login/Register</a>
                        </td>
                        <td>
                            <a href="admin.php">Admin Page</a>
                        </td>                   
                    </tr>
                </table>
            </header>
        
        <?php
        //login部分
        ini_set('display_errors', TRUE);
        error_reporting(-1);
        session_start();
        ini_set('display_errors', TRUE);
        $adminaccount = 'admin@localhost';
        error_reporting(-1);
        if (isset($_SESSION['user_id'])) 
        {
            $user_id = $_SESSION['user_id'];
            $user_email = $_SESSION['user_email'];
            if ($user_email == $adminaccount){
                echo "<h4 class='order_history'>Welcome!   Administrator: ".$user_email. "</h4>";
            }
            else{
                $message = "You are not administrator.";
                $redirectURL = "index.html";
                echo "<script>alert('$message');</script>";
                echo "<script>window.location.href = '$redirectURL';</script>";
            }
        } 
    
        else 
        {
            $message = "Please Log in first.";
            $redirectURL = "login.html";


            echo "<script>alert('$message');</script>";
            echo "<script>window.location.href = '$redirectURL';</script>";
        }
        
        //连接database
        $servername ="localhost";
        $username = "f32ee";
        $password = "f32ee";
        $dbname = "f32ee";
        $db = mysqli_connect($servername, $username, $password, $dbname); // connect to db server
        if(!$db) {
            die("Connection error:" . mysqli_connect_error());
        }




        
        $movie_names = array
        (
            1 => "Freelance",
            2 => "Oppenheimer",
            3 => "Creation Of The Gods I: Kingdom Of Storms",
            4 => "Tejas",
        );
        $cinema_names = array
        (
            1 => "Lao~X Theatre VivoCity",
            2 => "Lao~X Theatre Jurong Point",
            3 => "Lao~X Theatre Tiong Bahru",
        );
        
        $selected_movie = "";
        $selected_cinema = "";
        $selected_date_time = "";
        $selected_timing = "";
        
        if (isset($_POST['movie_id'])) {
            $selected_movie = $_POST['movie_id'];
        }
        if (isset($_POST['cinema_id'])) {
            $selected_cinema = $_POST['cinema_id'];
        }

        
        if (isset($_POST['date_time'])) {
            $selected_date_time = $_POST['date_time'];
        }

        
        if (isset($_POST['timing'])) {
            $selected_timing = $_POST['timing'];
        }

        
        
        // Step 1: Select Movie
        $sql = "SELECT DISTINCT movie_id FROM availability";
        $result = $db->query($sql);

        echo "<h2 class='order_history'>Select Movie:</h2>";
        echo "<form action='' method='post'>";
        echo "<label class='order_history' for='movie_id'>Select Movie:</label>";
        echo "<select name='movie_id' id='movie_id' onchange='this.form.submit()'>";
        echo "<option value=''>Select Movie:</option>";
        
        foreach ($movie_names as $movie_id => $movie_name) {
            $selected = ($movie_id == $selected_movie) ? "selected" : "";
            echo "<option value='$movie_id' $selected>$movie_name</option>";
        }
        echo "</select>";
        echo "</form>";
        
        if (!empty($selected_movie)) {
            echo "<p class='order_history'>You selected Movie: <b><i>$movie_names[$selected_movie] </b></i> </p>";
        }
        
        
        
        // Step 2: Select Cinema
        if (!empty($selected_movie)){
            
            $sql = "SELECT DISTINCT cinema_id FROM availability WHERE movie_id = $movie_id";
            $result = $db->query($sql);
            
            // Create a form to select cinema
            echo "<h2 class='order_history'>Select Cinema:</h2>";
            echo "<form action='' method='post'>";
            // echo "<p >Try".$cinema_id."</p>";
            echo "<label class='order_history' for='cinema_id'>Select Cinema:</label>";
            echo "<select name='cinema_id' id='cinema_id' onchange='this.form.submit()'>";
            echo "<option value=''>Select Cinema</option>";
            
            foreach ($cinema_names as $cinema_id => $cinema_name) {
                $selected = ($cinema_id == $selected_cinema) ? "selected" : "";
                echo "<option value='$cinema_id' $selected>$cinema_name</option>";
            }
            echo "</select>";
            echo "<input type='hidden' name='movie_id' value='$selected_movie'>";
            echo "</form>";
            
        }
        if (!empty($selected_cinema)) {
            echo "<p class='order_history'>You selected Cinema:<b><i>$cinema_names[$selected_cinema]</b></i></p>";
        }
        
        
        // Step 3: Select Date
        if (!empty($selected_cinema)&& !empty($selected_movie)) {
        
            echo "<h2 class='order_history'>Select Date:</h2>";
            echo "<form action='' method='post'>";
            echo "<label class='order_history' for='date_time'>Select Date:</label>";
            echo "<input type='date' name='date_time' id='date_time' onchange='this.form.submit()'>";
            // echo "<select name='date_time' id='date_time' onchange='this.form.submit()'>";
            // echo "<option value=''>Select Date and Time</option>";
            echo "<input type='hidden' name='movie_id' value='$movie_id'>";
            echo "<input type='hidden' name='cinema_id' value='$selected_cinema'>";
            echo "</form>";
        }
        if (!empty($selected_date_time )) {
            echo "<p class='order_history'>You selected Date: <i><b>$selected_date_time</b></i></p>";
        }
        
        // Step 4: Select Timing
        
        if (!empty($selected_cinema)&& !empty($selected_movie)&& !empty($selected_date_time)) {
            echo "<h2 class='order_history'>Select Time:</h2>";
            echo "<form action='' method='post'>";
            echo "<label class='order_history' for='timing'>Select Time:</label>";
            echo "<input type='time' name='timing' id='timing' onchange='this.form.submit()'>";
            
        
            echo "<input type='hidden' name='movie_id' value='$movie_id'>";
            echo "<input type='hidden' name='cinema_id' value='$selected_cinema'>";
            echo "<input type='hidden' name='date_time' value='$selected_date_time'>";
            echo "</form>";
        }
        
        // Display the selected date_time on the website
        if (!empty($selected_timing)) {
            echo "<p class='order_history'>You selected Time: <b><i>$selected_timing</b></i></p>";
        }


        if (!empty($selected_cinema)&& !empty($selected_movie)&& !empty($selected_date_time) && !empty($selected_timing)) {
            
            echo "<form action='' method='post'>";
            echo "<input class='order_history' type='submit' value='Confirm to add this time slot'>";
            echo "</form>";
            for( $i = 0; $i < 24; $i++ ) {
                $upd = "INSERT INTO availability(cinema_id,movie_id, date_time, timing, seat_code, booking_status) 
                VALUES ('$selected_cinema', '$movie_id', '$selected_date_time', '$selected_timing', '$i', 0)";
                if ($db->query($upd) !== true) {
                    echo "Error: " . $upd . "<br>" . $db->error;
                }
            }
            exit;
        }



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