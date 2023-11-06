<?php
    session_start();

    # db credentials
    $servername ="localhost";
    $username = "f32ee";
    $password = "f32ee";
    $dbname = "f32ee";

    # get user selection of movie: movie_id
    $movie_id = (int)$_GET['movie'];
    $_SESSION['movie_id'] = $movie_id;

    # connect to db and fetch movie detail of "movied_id"
    $db = mysqli_connect($servername, $username, $password, $dbname); // connect to db server
    if(!$db) {
        die("Connection error:" . mysqli_connect_error());
    }
    $query = "SELECT * FROM MOVIE WHERE movie_id=$movie_id"; // formulate query
    $result = $db->query($query); // point db to query
    $row = $result->fetch_assoc();

    # format of MOVIE table: `movie_id`, `movie_name`, `duration`, `language`, `genre`, `release_date`, `image_dir`, `synopsis`, `rating`, `cast`, `director`
    # store all attr of the movie into variables to populate html codes below
    $movie_name = $row['movie_name'];
    $duration = $row['duration'];
    $language = $row['language'];
    $genre = $row['genre'];
    $release_date = $row['release_date'];
    $image_dir = $row['image_dir'];
    $synopsis = $row['synopsis'];
    $rating = $row['rating'];
    $cast = $row['cast'];
    $director = $row['director'];

    $result->free();
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lao~X Thertre - Cinemas</title>
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
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="movies.html">Movie</a></li>
            <li><font color="#e8e0a3"><?php echo $movie_name ?></li>
        </ul>

        <div class="content">
            <!---------------------------------------------------------------content here---------------------------------------------------->
            <?php
                # `movie_id`, `movie_name`, `duration`, `language`, `genre`, `release_date`, `image_dir`, `synopsis`, `rating`, `cast`, `director`
            ?>
            <div class="mini_wrapper">
                <h class="individual_movie_title"><?php echo $movie_name ?></h>
                <p class="rating">(<?php echo $rating?>)</p>
                <hr class="individual_movie_title">
                <br>
                <div class="individual_mov">
                    <div id="img">
                        <img src="<?php echo $image_dir ?>" alt="movie poster">
                    </div>
                    <div id="info">
                        <div id="details">
                            <h3>Details</h3>
                            <table class="individual_mov" border="0">
                                <tr>
                                    <td rowspan="2" class="label">Cast: </td>
                                    <td rowspan="2" class="detail"><?php echo $cast ?></td>
                                    <td class="label">Release:</td>
                                    <td class="detail"><?php echo $release_date ?></td>
                                </tr>
                                <tr>
                                    <td class="label">Running Time: </td>
                                    <td class="detail"><?php echo $duration ?> mins</td>
                                </tr>
                                <tr>
                                    <td class="label">Director: </td>
                                    <td class="detail"><?php echo $director ?></td>
                                    
                                    <td class="label">Language: </td>
                                    <td class="detail"><?php echo $language ?></td>
                                </tr>
                                <tr>
                                    <td class="label">Genre: </td>
                                    <td class="detail"><?php echo $genre ?></td>

                                </tr>
                            </table>
                        </div>
                        <div id="synopsis">
                            <h3>Synopsis</h3>
                            <p><?php echo $synopsis ?></p>
                        </div>
                    </div>
                </div>
                <div class="booking">
                <?php
                    $cinema_names = array
                    (
                    "1" => "Lao~X Theatre VivoCity",
                    "2" => "Lao~X Theatre Jurong Point",
                    "3" => "Lao~X Theatre Tiong Bahru",
                    );
                    $selected_cinema = "";
                    $selected_date_time = "";
                    
                    if (isset($_POST['cinema_id'])) {
                        $selected_cinema = $_POST['cinema_id'];
                    }
                    
                    if (isset($_POST['date_time'])) {
                        $selected_date_time = $_POST['date_time'];
                    }
                    
                    // Step 2: Select Cinema
                    $sql = "SELECT DISTINCT cinema_id FROM availability WHERE movie_id = $movie_id";
                    $result = $db->query($sql);
                    
                    // Create a form to select cinema
                    echo "<h2>Select Cinema:</h2>";
                    echo "<form action='' method='post'>";
                    echo "<label for='cinema_id'>Select Cinema:</label>";
                    echo "<select name='cinema_id' id='cinema_id' onchange='this.form.submit()'>";
                    echo "<option value=''>Select Cinema</option>";
                    foreach ($cinema_names as $cinema_id => $cinema_name) {
                        $selected = ($cinema_id == $selected_cinema) ? "selected" : "";
                        echo "<option value='$cinema_id' $selected>$cinema_name</option>";
                    }
                    echo "</select>";
                    echo "</form>";
                    
                    // Display the selected cinema on the website
                    if (!empty($selected_cinema)) {
                        echo "<p>You selected Cinema: " . $cinema_names[$selected_cinema] . "</p>";
                    }
                    
                    // Step 3: Display available date_time based on selected cinema
                    if (!empty($selected_cinema)) {
                        $sql = "SELECT DISTINCT date_time FROM availability WHERE movie_id = $movie_id AND cinema_id = $selected_cinema";
                        $result = $db->query($sql);
                    
                        echo "<h2>Select Date and Time:</h2>";
                        echo "<form action='' method='post'>";
                        echo "<label for='date_time'>Select Date and Time:</label>";
                        echo "<select name='date_time' id='date_time' onchange='this.form.submit()'>";
                        echo "<option value=''>Select Date and Time</option>";
                        while ($row = $result->fetch_assoc()) {
                            $date_time = $row['date_time'];
                            $selected = ($date_time == $selected_date_time) ? "selected" : "";
                            echo "<option value='$date_time' $selected>$date_time</option>";
                        }
                        echo "</select>";
                    
                        echo "<input type='hidden' name='movie_id' value='$movie_id'>";
                        echo "<input type='hidden' name='cinema_id' value='$selected_cinema'>";
                        echo "</form>";
                    }
                    
                    // Display the selected date_time on the website
                    if (!empty($selected_date_time)) {
                        echo "<p>You selected Date and Time: $selected_date_time</p>";
                    }
                    
                    // Step 4: Select Timing
                    if (!empty($selected_cinema) && !empty($selected_date_time)) {
                        $sql = "SELECT DISTINCT timing FROM availability WHERE movie_id = $movie_id AND cinema_id = $selected_cinema AND date_time = '$selected_date_time'";
                        $result = $db->query($sql);
                    
                        echo "<h2>Select Timing:</h2>";
                        echo "<form action='seat_selection.php' method='post'>";
                        echo "<label for='timing'>Select Timing:</label>";
                        echo "<select name='timing' id='timing'>";
                        echo "<option value=''>Select Timing</option>";
                        while ($row = $result->fetch_assoc()) {
                            $timing = $row['timing'];
                            echo "<option value='$timing'>$timing</option>";
                        }
                    
                        echo "<input type='hidden' name='movie_id' value='$movie_id'>";
                        echo "<input type='hidden' name='cinema_id' value='$selected_cinema'>";
                        echo "<input type='hidden' name='date_time' value='$selected_date_time'>";
                        echo "<input type='hidden' name='timing' value='$timing'>";
                        echo "<input type='submit' value='Continue'>";
                        echo "</form>";
                        exit;
                    }

                ?>
                </div>

            </div>

        </div>        

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