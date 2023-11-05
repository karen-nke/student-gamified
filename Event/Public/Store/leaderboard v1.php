<?php
// Include your database connection code here
require_once('db_connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <title>Soft Skills Development</title>
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

                $rank = 1;

                while ($row = $leaderboardResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$rank}</td>";
                    echo "<td>{$row['username']}</td>";
                    echo "<td>{$row['points']}</td>";
                    echo "</tr>";

                    $rank++;
                }

                // Close the database connection
                $conn->close();
                ?>

            </table>


       </div>

       
    </section>



    <style>

        .logo-centered {

        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;




        }  

    .leaderboard .container{
        display: flex;
        align-items: center;
        justify-content: center;
        max-width: 2000px;
        
        margin: 0;

    }   
    
    .leaderboard h2{
        color: #E87A00;
        font-size: 54px;
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        text-align: center;
    }

    .leaderboard table {
        width: 50%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .leaderboard th, td {
        padding: 10px;
        text-align: left;
        border: 1px solid #E87A00;
    }

    .leaderboard th {
        background-color: #f2f2f2;
    }
    </style>

</body>
</html>