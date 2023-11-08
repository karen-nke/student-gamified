<?php

function getUserData($conn, $username) {
    $userDataQuery = "SELECT gender FROM users WHERE username = ?";
    $userDataStmt = $conn->prepare($userDataQuery);
    $userDataStmt->bind_param("s", $username);
    $userDataStmt->execute();
    $userDataResult = $userDataStmt->get_result();
    $userData = $userDataResult->fetch_assoc();
    $userDataStmt->close();

    return $userData;
}

function getUserPoints($conn, $username) {
    $pointsQuery = "SELECT points FROM users WHERE username = ?";
    $pointsStmt = $conn->prepare($pointsQuery);
    $pointsStmt->bind_param("s", $username);
    $pointsStmt->execute();
    $pointsResult = $pointsStmt->get_result();
    $pointsRow = $pointsResult->fetch_assoc();
    $points = $pointsRow['points'];
    $pointsStmt->close();

    return $points;
}

function getRank($conn, $points) {
    $rankQuery = "SELECT COUNT(*) + 1 AS rank FROM users WHERE points > ?";
    $rankStmt = $conn->prepare($rankQuery);
    $rankStmt->bind_param("i", $points);
    $rankStmt->execute();
    $rankResult = $rankStmt->get_result();
    $rankRow = $rankResult->fetch_assoc();
    $userRank = $rankRow['rank'];
    $rankStmt->close();

    return $userRank;
}

function getLevelData($points) {
    $levels = array(
        0 => array('min' => 0, 'max' => 100),
        1 => array('min' => 101, 'max' => 200),
        2 => array('min' => 201, 'max' => 300),
        3 => array('min' => 301, 'max' => 400),
        4 => array('min' => 401, 'max' => 500),
        5 => array('min' => 501, 'max' => 600),
        6 => array('min' => 601, 'max' => 700),
        7 => array('min' => 701, 'max' => 800),
        8 => array('min' => 801, 'max' => 900),
        9 => array('min' => 901, 'max' => PHP_INT_MAX) 
    );

    foreach ($levels as $level => $range) {
        if ($points >= $range['min'] && $points <= $range['max']) {
            $nextLevelPoints = $range['max'];
            $remainingPoints = $nextLevelPoints - $points;
            $progress = ($points - $range['min']) / ($range['max'] - $range['min']) * 100;
            return array('level' => $level, 'progress' => $progress, 'remainingPoints' => $remainingPoints + 1);
        }
    }



}

function getLeaderboardData($conn) {
    $leaderboardQuery = "SELECT username, points FROM users ORDER BY points DESC";
    $leaderboardResult = $conn->query($leaderboardQuery);

    $rank = 0; // Initialize rank
    $prevPoints = PHP_INT_MAX; // Set to the maximum integer value

    $leaderboardData = array();

    while ($row = $leaderboardResult->fetch_assoc()) {
        if ($row['points'] < $prevPoints) {
            $rank++;
        }

        $leaderboardData[] = array(
            'rank' => $rank,
            'username' => $row['username'],
            'points' => $row['points']
        );

        $prevPoints = $row['points'];
    }

    return $leaderboardData;
}

function getPointHistoryData($conn, $username) {
    $pointHistoryQuery = "SELECT * FROM point_history WHERE username = ?";
    $pointHistoryStmt = $conn->prepare($pointHistoryQuery);
    $pointHistoryStmt->bind_param("s", $username);
    $pointHistoryStmt->execute();
    $pointHistoryResult = $pointHistoryStmt->get_result();

    $pointHistoryData = array();

    while ($row = $pointHistoryResult->fetch_assoc()) {
        $pointHistoryData[] = array(
            'date' => $row['added_at'],
            'event_description' => $row['event_description'],
            'points_added' => $row['points_added']
        );
    }

    $pointHistoryStmt->close();

    return $pointHistoryData;
}

function processEventForm($conn)
{
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];

        // Fetch user's current points from the database
        $query = "SELECT points FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($currentPoints);

        if ($stmt->fetch()) {
            // Update points
            $updatedPoints = $currentPoints + 10;

            // Close the first statement before executing the update statement
            $stmt->close();

            // Update points in the database
            $updateQuery = "UPDATE users SET points = ? WHERE username = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("is", $updatedPoints, $username);
            $updateStmt->execute();

            // Store updated points in the session
            $_SESSION[$username] = $updatedPoints;

            // Close the update statement
            $updateStmt->close();

            // Insert event information into the 'events' table
            $event = $_POST["event"];
            $club = $_POST["club"];
            $datetime = $_POST["datetime"];

            $insertEventQuery = "INSERT INTO events (username, event, club, datetime) VALUES (?, ?, ?, ?)";
            $insertEventStmt = $conn->prepare($insertEventQuery);
            $insertEventStmt->bind_param("ssss", $username, $event, $club, $datetime);
            $insertEventStmt->execute();
            $insertEventStmt->close();

            // Record point history with added_at timestamp
            $pointsReward = 10;
            $eventDescription = "Event participation";

            $recordHistoryQuery = "INSERT INTO point_history (username, points_added, event_description, added_at) VALUES (?, ?, ?, NOW())";
            $recordHistoryStmt = $conn->prepare($recordHistoryQuery);
            $recordHistoryStmt->bind_param("sis", $username, $pointsReward, $eventDescription);
            $recordHistoryStmt->execute();
            $recordHistoryStmt->close();

            // Redirect to account.php and show pop-up
            echo '<script>
                    alert("Points updated successfully!");
                    window.location.href = "account.php";
                </script>';
            exit();
        } else {
            echo "User not found!";
        }

        // Close the database connection
        $conn->close();
    }
}



?>