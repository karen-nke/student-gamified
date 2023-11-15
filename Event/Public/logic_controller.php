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
    $rankQuery = "SELECT rank FROM (SELECT username, points, DENSE_RANK() OVER (ORDER BY points DESC) AS rank FROM users) AS ranked_users WHERE username IN (SELECT username FROM users WHERE points = ?)";
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
        9 => array('min' => 901, 'max' => 1000),
        10 => array('min' => 1001, 'max' => 2000) 
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

function getPointHistoryDataPaginated($conn, $username, $start_index, $items_per_page) {
    $pointHistoryQuery = "SELECT * FROM point_history WHERE username = ? ORDER BY added_at DESC LIMIT ?, ?";
    $pointHistoryStmt = $conn->prepare($pointHistoryQuery);
    $pointHistoryStmt->bind_param("sii", $username, $start_index, $items_per_page);
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

function getTotalRows($conn, $username) {
    $totalRowsQuery = "SELECT COUNT(*) as count FROM point_history WHERE username = ?";
    $totalRowsStmt = $conn->prepare($totalRowsQuery);
    $totalRowsStmt->bind_param("s", $username);
    $totalRowsStmt->execute();
    $result = $totalRowsStmt->get_result();
    $count = $result->fetch_assoc()['count'];
    $totalRowsStmt->close();

    return $count;
}



function getEventHistoryDataPaginated($conn, $username, $start_index, $items_per_page) {
    $eventHistoryQuery = "SELECT * FROM events WHERE username = ? ORDER BY datetime DESC LIMIT ?, ?";
    $eventHistoryStmt = $conn->prepare($eventHistoryQuery);
    $eventHistoryStmt->bind_param("sii", $username, $start_index, $items_per_page);
    $eventHistoryStmt->execute();
    $eventHistoryResult = $eventHistoryStmt->get_result();
    $eventHistoryData = array();

    while ($row = $eventHistoryResult->fetch_assoc()) {
        $eventHistoryData[] = array(
            'date' => $row['datetime'],
            'event_description' => $row['event'],
            'club' => $row['club']
        );
    }

    $eventHistoryStmt->close();

    return $eventHistoryData;
}


function getTotalPages($conn, $username, $items_per_page = 10) {
    $totalEventsQuery = "SELECT COUNT(*) as total FROM events WHERE username = ?";
    $totalEventsStmt = $conn->prepare($totalEventsQuery);
    $totalEventsStmt->bind_param("s", $username);
    $totalEventsStmt->execute();
    $totalEventsResult = $totalEventsStmt->get_result();
    $totalEvents = $totalEventsResult->fetch_assoc()['total'];
    $totalEventsStmt->close();

    // Calculate the total pages
    $totalPages = ceil($totalEvents / $items_per_page);

    return $totalPages;
}





function processEventForm($conn)
{
   
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

function hasCheckedInToday($conn, $user_id) {
    $checkin_date_query = "SELECT checkin_date FROM checkin_history WHERE user_id = ? AND checkin_date = CURDATE()";
    $checkin_date_stmt = $conn->prepare($checkin_date_query);
    $checkin_date_stmt->bind_param("i", $user_id);
    $checkin_date_stmt->execute();
    $result = $checkin_date_stmt->get_result();
    $checkin_date_stmt->close();

    return $result->num_rows > 0;
}

function checkin($conn, $user_id) {
    // Check if the user already checked in today
    if (hasCheckedInToday($conn, $user_id)) {
        return "You have already checked in today.";
    }

    // Get the username from the session
  
    $username = $_SESSION["username"];

    // Reward points for check-in
    $points_to_add = 5;
    
    // Update user's points
    $update_points_query = "UPDATE users SET points = points + ? WHERE id = ?";
    $update_points_stmt = $conn->prepare($update_points_query);
    $update_points_stmt->bind_param("ii", $points_to_add, $user_id);
    $update_points_stmt->execute();
    $update_points_stmt->close();

    // Record point history with added_at timestamp
    $event_description = "Check-in Points";
    $record_history_query = "INSERT INTO point_history (username, points_added, event_description, added_at) VALUES (?, ?, ?, NOW())";
    $record_history_stmt = $conn->prepare($record_history_query);
    $record_history_stmt->bind_param("sis", $username, $points_to_add, $event_description);
    $record_history_stmt->execute();
    $record_history_stmt->close();

    // Record check-in in checkin_history table
    $record_checkin_query = "INSERT INTO checkin_history (user_id, checkin_date) VALUES (?, CURDATE())";
    $record_checkin_stmt = $conn->prepare($record_checkin_query);
    $record_checkin_stmt->bind_param("i", $user_id);
    $record_checkin_stmt->execute();
    $record_checkin_stmt->close();

    return "Check-in successful! You earned 5 points.";
}




?>