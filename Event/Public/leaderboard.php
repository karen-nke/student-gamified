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
    <title>Leaderboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <section class="leaderboard">
        <img src="Image/Leaderboard_Icon.png" style="width:200px;height:250px;" class="logo-centered"></a>
        <h2>Leaderboard</h2>

        <div class="container">
            <?php
            if (isset($_SESSION["username"])) {
                $leaderboardData = getLeaderboardData($conn);

                if (!empty($leaderboardData)) {
                    echo "<table>";
                    echo "<tr><th>Rank</th><th>Username</th><th>Points</th></tr>";

                    foreach ($leaderboardData as $entry) {
                        echo "<tr>";
                        echo "<td>{$entry['rank']}</td>";
                        echo "<td>{$entry['username']}</td>";
                        echo "<td>{$entry['points']}</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "<p>No data available.</p>";
                }
            } else {
                echo "<p>Please <a href='Login/login.php'>login</a> first.</p>";
            }
            ?>
        </div>
    </section>

</body>

</html>