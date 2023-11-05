<?php
session_start();

require_once('db_connect.php');
require_once('Part/_header.php');

// Assuming you have a login system and the username is stored in the session
if (!isset($_SESSION["username"])) {
    header("Location: login.php"); // Redirect to login page
    exit();
}

$username = $_SESSION["username"];

//$points = isset($_SESSION[$username]) ? $_SESSION[$username] : 0; 
//This is used previously but cannot be used, because when user first logged in, the point doesnt showed unless user submit the form.

// Fetch and display user's points
$pointsQuery = "SELECT points FROM users WHERE username = ?";
$pointsStmt = $conn->prepare($pointsQuery);
$pointsStmt->bind_param("s", $username);
$pointsStmt->execute();
$pointsResult = $pointsStmt->get_result();
$pointsRow = $pointsResult->fetch_assoc();
$points = $pointsRow['points'];
$pointsStmt->close();


function getLevel($points) {
    $levels = array(
        1 => array('min' => 0, 'max' => 100),
        2 => array('min' => 101, 'max' => 200),
        3 => array('min' => 201, 'max' => 300),
        4 => array('min' => 301, 'max' => 400),
        5 => array('min' => 401, 'max' => 500),
        6 => array('min' => 501, 'max' => 600),
        7 => array('min' => 601, 'max' => 700),
        8 => array('min' => 701, 'max' => 800),
        9 => array('min' => 801, 'max' => 900),
        10 => array('min' => 901, 'max' => PHP_INT_MAX) 
    );

    foreach ($levels as $level => $range) {
        if ($points >= $range['min'] && $points <= $range['max']) {
            $progress = ($points - $range['min']) / ($range['max'] - $range['min']) * 100;
            return array('level' => $level, 'progress' => $progress);
        }
    }
    return array('level' => "Unknown", 'progress' => 0);
}

$levelData = getLevel($points); 
$userLevel = $levelData['level'];
$progress = $levelData['progress'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<style>

.progress-bar {
    background-color: #4CAF50;
    height: 100%;
    width: <?php echo $progress; ?>%;
    transition: width 0.5s ease-in-out;
    border-radius: 5px;
}

</style>

<div class="container">
    <h2 class="title"><br>Welcome, <?php echo $username; ?>!</h2>
</div>

<div class ="container">

<div class="profile-info">
    <p class="points">Points: <?php echo $points; ?></p>
    <p class="level">Level: <?php echo $userLevel; ?></p>

    <!-- Progress bar -->
    <p class="progress">Level Progress: <?php echo round($progress, 2); ?>%</p>
    <div class="progress-container">
        <div class="progress-bar"></div>
    </div>

    <!-- Level label -->
    <div class="level-label">
        <span>Level <?php echo $userLevel; ?></span>
        <span>Level <?php echo $userLevel + 1; ?></span>
    </div>

    <!-- Display events history -->
   
    <h2>Events History</h2>
    <?php
    // Fetch and display events history
    $eventsQuery = "SELECT * FROM events WHERE username = ?";
    $eventsStmt = $conn->prepare($eventsQuery);
    $eventsStmt->bind_param("s", $username);
    $eventsStmt->execute();
    $eventsResult = $eventsStmt->get_result();

    // Count total joined events
    $totalEvents = $eventsResult->num_rows;

    echo "<p>Total Joined Events: {$totalEvents}</p>";

    while ($row = $eventsResult->fetch_assoc()) {
        echo "<p>{$row['event']} at {$row['club']} on {$row['datetime']}</p>";
    }

$eventsStmt->close();
?>

    <!-- Display challenges -->
    <div class="challenge-dropdown">
        <h2>Challenges</h2>
        <?php
        // Fetch and display challenges
        $challengesQuery = "SELECT * FROM challenges";
        $challengesStmt = $conn->prepare($challengesQuery);
        $challengesStmt->execute();
        $challengesResult = $challengesStmt->get_result();

        while ($challenge = $challengesResult->fetch_assoc()) {
            // Check if user has completed the challenge based on event history
            $completedQuery = "SELECT COUNT(*) FROM events WHERE username = ?";
            $completedStmt = $conn->prepare($completedQuery);
            $completedStmt->bind_param("s", $username);
            $completedStmt->execute();
            $completedStmt->bind_result($eventsCount);
            $completedStmt->fetch();
            $completedStmt->close();

            if ($eventsCount >= $challenge['challenge_condition']) {
                // Challenge completed
                $statusClass = "complete";
            } else {
                // Challenge not completed
                $statusClass = "incomplete";
            }

            echo "<div class='challenge-card {$statusClass}'>";
            echo "<p>{$challenge['name']}</p>";
            echo "<p>{$challenge['description']}</p>";
            echo "<p>Points Reward: {$challenge['points_reward']}</p>";
            echo "<p>Status: {$statusClass}</p>"; // This line for debugging
            echo "</div>";
        }
        $challengesStmt->close();
        ?>
    </div>

    <button class="btn"><a href="point_history.php">Point History</a></button>

   

    
</div>
</div>    

</body>
</html>

