<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
// Include necessary files
require_once('db_connect.php');
require_once('Part/header.php');
require_once('logic_controller.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <title>Events</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

        <div class="page-container">
                <div>
                        <img src="Image/Events_Icon.png" style="width:200px;height:250px;" class="logo-centered"></a>
                        <h2 class="title"><br>Events Points Tracker</h2>
                </div>

                <div class="container">

                        <?php
                        // Check if the user is logged in
                        if (isset($_SESSION["username"])) {
                                // User is logged in, show the form
                                processEventForm($conn, 'processEventForm');
                        ?>
                                <form action="" method="post" class="login-email">
                                        <p class="login-text" style='font-size:2rem; font-weight:800;'>Input Event</p>

                                        <div class="input-group">
                                                <?php
                                                // Assuming you have a login system and the username is stored in the session
                                                if (isset($_SESSION["username"])) {
                                                        $username = $_SESSION["username"];
                                                        echo "<input type='text' id='username' placeholder='Username' name='username' value='$username' readonly>";
                                                } 
                                                ?>
                                        </div>

                                        <div class="input-group">
                                                <input type="text" id="event" placeholder="Event Name" name="event" required>
                                        </div>

                                        <div class="input-group">
                                                <input type="text" id="club" placeholder="Club" name="club" required>
                                        </div>

                                        <div class="input-group">
                                                <input type="datetime-local" id="datetime" placeholder="Date & Time of the Event" name="datetime" required>
                                        </div>

                                        <button class="btn" type="submit">Submit</button>
                                </form>

                                <button class="btn"><a href="event_history.php">Event History</a></button>  

                        <?php
                        } else {
                                // User is not logged in, show a message or redirect to the login page
                                echo "<p>Please <a href='Login/login.php'>login</a> first.</p>";
                        }
                        ?>
                       

                </div>

</body>

</html>