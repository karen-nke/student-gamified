<?php
// Include your database connection code here
require_once('db_connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Events Point Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php session_start(); ?>

    <?php require_once 'Part/header.php' ?>

    <section class="leaderboard">
        <img src="Image/Leaderboard_Icon.png" style="width:200px;height:250px;" class="logo-centered"></a>
        <h2>Leaderboard</h2>

        <div class="container">


             <?php
                        // Check if the user is logged in
                        if (isset($_SESSION["username"])) {
                                // User is logged in, show the form
            ?>

            <table>
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Points</th>
                </tr>

                <?php
                // Fetch leaderboard data from the database
                $leaderboardQuery = "SELECT username, points FROM users ORDER BY points DESC";
                $leaderboardResult = $conn->query($leaderboardQuery);

                $rank = 0; // Initialize rank
                $prevPoints = null;

                while ($row = $leaderboardResult->fetch_assoc()) {
                    echo "<tr>";

                    if ($row['points'] !== $prevPoints) {
                        $rank++;
                    }

                    echo "<td>{$rank}</td>";
                    echo "<td>{$row['username']}</td>";
                    echo "<td>{$row['points']}</td>";
                    echo "</tr>";

                    $prevPoints = $row['points'];
                }

                // Close the database connection
                $conn->close();
                ?>

            </table>

            <?php
                        } else {
                                // User is not logged in, show a message or redirect to the login page
                                echo "<p>Please <a href='Login/login.php'>login</a> first.</p>";
                        }
                        ?>
        </div>
    </section>


</body>

</html>
