<?php

/* Account Function */

//To get user gender - Customise Profile Picture 
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

//To get user points 
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

//To get user current rank
function getRank($conn, $points) {
    $rankQuery = "SELECT rank FROM (SELECT username, points, DENSE_RANK() OVER (ORDER BY points DESC) AS rank FROM users) AS ranked_users WHERE username 
    IN (SELECT username FROM users WHERE points = ?)"; //Fixed same marks but different level using Dense_Rank()
    $rankStmt = $conn->prepare($rankQuery);
    $rankStmt->bind_param("i", $points);
    $rankStmt->execute();
    $rankResult = $rankStmt->get_result();
    $rankRow = $rankResult->fetch_assoc();
    $userRank = $rankRow['rank'];
    $rankStmt->close();

    return $userRank;
}

//To get user current level according to total points earned
function getLevelData($points) {
    $levels = array(
        0 => array('min' => 0, 'max' => 9),
        1 => array('min' => 10, 'max' => 29),
        2 => array('min' => 30, 'max' => 49),
        3 => array('min' => 50, 'max' => 69),
        4 => array('min' => 70, 'max' => 89),
        5 => array('min' => 90, 'max' => 109),
        6 => array('min' => 110, 'max' => 129),
        7 => array('min' => 130, 'max' => 149),
        8 => array('min' => 150, 'max' => 169),
        9 => array('min' => 170, 'max' => 179),
        10 => array('min' => 180, 'max' => 2000) 
    );

    //Control the progress and levelling up
    foreach ($levels as $level => $range) {
        if ($points >= $range['min'] && $points <= $range['max']) {
            $nextLevelPoints = $range['max'];
            $remainingPoints = $nextLevelPoints - $points;
            $progress = ($points - $range['min']) / ($range['max'] - $range['min']) * 100;

            return array('level' => $level, 'progress' => $progress, 'remainingPoints' => $remainingPoints + 1, 'currentLevel' => $level);
        }
    }



}


//For user checkin
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

// To check if a user has submitted at least 3 event participations
function hasSubmittedThreeEvents($conn, $username) {
    $eventSubmissionQuery = "SELECT COUNT(*) as count FROM events WHERE username = ?";
    $eventSubmissionStmt = $conn->prepare($eventSubmissionQuery);
    $eventSubmissionStmt->bind_param("s", $username);
    $eventSubmissionStmt->execute();
    $result = $eventSubmissionStmt->get_result();
    $count = $result->fetch_assoc()['count'];
    $eventSubmissionStmt->close();

    return $count >= 3;
}

//To check if a user has join the module by starting the challenge 
function hasJoinedModule($conn, $user_id) {
    $check_module_query = "SELECT COUNT(*) as count FROM user_soft_skill_progress WHERE user_id = ?";
    $check_module_stmt = $conn->prepare($check_module_query);
    $check_module_stmt->bind_param("i", $user_id);
    $check_module_stmt->execute();
    $result = $check_module_stmt->get_result();
    $count = $result->fetch_assoc()['count'];
    $check_module_stmt->close();

    return $count > 0;
}

function hasCompletedModuleChallenges($conn, $user_id, $soft_skill_ids) {
    $soft_skill_ids_str = implode(",", $soft_skill_ids); // Convert array to comma-separated string

    $check_completion_query = "
        SELECT soft_skill_id, COUNT(*) as count
        FROM user_soft_skill_progress
        WHERE user_id = ? AND soft_skill_id IN ($soft_skill_ids_str) AND completed = 1
        GROUP BY soft_skill_id
    ";
    $check_completion_stmt = $conn->prepare($check_completion_query);
    $check_completion_stmt->bind_param("i", $user_id);
    $check_completion_stmt->execute();
    $result = $check_completion_stmt->get_result();

    // Initialize an array to store completion status for each soft skill
    $completion_status = array_fill_keys($soft_skill_ids, false);

    while ($row = $result->fetch_assoc()) {
        $soft_skill_id = $row['soft_skill_id'];
        $count = $row['count'];
        
        // Check if the user has completed all challenges for the current soft skill
        if ($count >= 3) {
            $completion_status[$soft_skill_id] = true;
        }
    }

    $check_completion_stmt->close();

    // Check if the user has completed all challenges for any of the soft skills
    return in_array(true, $completion_status);
}
//To check if user has completed SoftSkill Module 
function hasCompletedSoftSkillChallenges($conn, $user_id, $soft_skill_id, $challenge_numbers) {
    $check_completion_query = "SELECT COUNT(*) as count FROM user_soft_skill_progress WHERE user_id = ? AND soft_skill_id = ? AND challenge_number IN (?, ?, ?)";
    $check_completion_stmt = $conn->prepare($check_completion_query);
    $check_completion_stmt->bind_param("iiiii", $user_id, $soft_skill_id, $challenge_numbers[0], $challenge_numbers[1], $challenge_numbers[2]);
    $check_completion_stmt->execute();
    $result = $check_completion_stmt->get_result();
    $count = $result->fetch_assoc()['count'];
    $check_completion_stmt->close();

    return $count == count($challenge_numbers);
}

// Check if the alert for a specific badge has been shown for the user
function hasBadgeAlertBeenShown($conn, $user_id, $badgeName) {
    $columnName = $badgeName . '_alert_shown';
    $query = "SELECT $columnName FROM user_alerts WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    return $row[$columnName] ?? false;
}

// Mark the alert for a specific badge as shown for the user
function markBadgeAlertAsShown($conn, $user_id, $badgeName) {
    $columnName = $badgeName . '_alert_shown';
    $query = "INSERT INTO user_alerts (user_id, $columnName) VALUES (?, 1)
              ON DUPLICATE KEY UPDATE $columnName = 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
}

function getTotalUsers($conn) {
    $totalUsersQuery = "SELECT COUNT(*) as totalUsers FROM users";
    $totalUsersResult = $conn->query($totalUsersQuery);
    
    if ($totalUsersResult) {
        $totalUsersRow = $totalUsersResult->fetch_assoc();
        return $totalUsersRow['totalUsers'];
    } else {
        // Handle the error as needed
        return 0;
    }
}


/* End of Account */

/*Leaderboard*/

//Get user points and rank for leaderboard
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

/* End of Leaderboard */

/*Point History*/

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

/* End of Points History */

/* Event History */
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
/* End of Event History */



/* Event Form Process */
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

/* End of Event Form Process */


/* Soft Skills Page*/

function getSoftSkillData($conn, $skill) {
    $query = "SELECT * FROM soft_skills WHERE name = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die('Error in preparing statement: ' . $conn->error);
    }

    $stmt->bind_param("s", $skill);
    $stmt->execute();

    if ($stmt->error) {
        die('Error in executing statement: ' . $stmt->error);
    }

    $result = $stmt->get_result();

    if (!$result) {
        die('Error in getting result: ' . $stmt->error);
    }

    if ($result->num_rows > 0) {
        // Fetch the data as an associative array
        $data = $result->fetch_assoc();
        $stmt->close();
        return $data;
    } else {
        // No data found for the selected skill
        $stmt->close();
        return null;
    }
}

function hasCompletedChallenge($conn, $user_id, $soft_skill_id, $challenge_number) {
    $completedQuery = "SELECT completed FROM user_soft_skill_progress
                       WHERE user_id = ? AND soft_skill_id = ? AND challenge_number = ?";
    
    $completedStmt = $conn->prepare($completedQuery);
    $completedStmt->bind_param("iii", $user_id, $soft_skill_id, $challenge_number);
    $completedStmt->execute();
    $completedResult = $completedStmt->get_result();
    
    // Check if there is a row for the completed challenge
    if ($completedRow = $completedResult->fetch_assoc()) {
        $completedStatus = $completedRow['completed'];
    } else {
        // No row found, challenge not completed
        $completedStatus = 0;
    }

    $completedStmt->close();

    return $completedStatus == 1;
}

function getSoftSkillIdByName($conn, $soft_skill_name) {
    $query = "SELECT id FROM soft_skills WHERE name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $soft_skill_name);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $soft_skill_id = $row['id'];
    $stmt->close();

    return $soft_skill_id;
}

function getSkillImage($soft_skill_id) {
    switch ($soft_skill_id) {
        case 1:
            return 'Image/Leadership_Unlocked.png';
        case 2:
            return 'Image/Communication_Unlocked.png';
        case 3:
            return 'Image/Teamwork_Unlocked.png';
       
        default:
            return ''; 
    }
}


/* End of Soft Skills Page*/

function initializeUserLevels($conn, $user_id) {
    // Check if the user already has a record in user_levels
    $checkUserLevelsQuery = "SELECT * FROM user_levels WHERE user_id = ?";
    $checkUserLevelsStmt = $conn->prepare($checkUserLevelsQuery);
    $checkUserLevelsStmt->bind_param("i", $user_id);
    $checkUserLevelsStmt->execute();
    $checkUserLevelsResult = $checkUserLevelsStmt->get_result();

    if ($checkUserLevelsResult->num_rows == 0) {
        // User does not have a record in user_levels, insert a new record
        $initializeUserLevelsQuery = "INSERT INTO user_levels (user_id, current_level, alert_level, level_up_alert_shown)
                                      VALUES (?, 0, 0, 0)";
        $initializeUserLevelsStmt = $conn->prepare($initializeUserLevelsQuery);
        $initializeUserLevelsStmt->bind_param("i", $user_id);
        $initializeUserLevelsStmt->execute();
        $initializeUserLevelsStmt->close();
    }

    $checkUserLevelsStmt->close();
}



function deleteAccount($conn, $user_id, $username)
{
    // Delete user data from related tables
    // Modify the queries according to your database schema

    // Delete user data from the users table
    $deleteUserQuery = "DELETE FROM users WHERE id = ?";
    $deleteUserStmt = $conn->prepare($deleteUserQuery);
    $deleteUserStmt->bind_param("i", $user_id);
    $deleteUserStmt->execute();
    $deleteUserStmt->close();

    // Delete check-in history
    $deleteCheckinQuery = "DELETE FROM checkin_history WHERE user_id = ?";
    $deleteCheckinStmt = $conn->prepare($deleteCheckinQuery);
    $deleteCheckinStmt->bind_param("i", $user_id);
    $deleteCheckinStmt->execute();
    $deleteCheckinStmt->close();

    // Delete practical form submissions
    $deletePracticalFormQuery = "DELETE FROM practical_form WHERE user_id = ?";
    $deletePracticalFormStmt = $conn->prepare($deletePracticalFormQuery);
    $deletePracticalFormStmt->bind_param("i", $user_id);
    $deletePracticalFormStmt->execute();
    $deletePracticalFormStmt->close();

    // Delete user alerts
    $deleteUserAlertsQuery = "DELETE FROM user_alerts WHERE user_id = ?";
    $deleteUserAlertsStmt = $conn->prepare($deleteUserAlertsQuery);
    $deleteUserAlertsStmt->bind_param("i", $user_id);
    $deleteUserAlertsStmt->execute();
    $deleteUserAlertsStmt->close();

    // Delete user levels
    $deleteUserLevelsQuery = "DELETE FROM user_levels WHERE user_id = ?";
    $deleteUserLevelsStmt = $conn->prepare($deleteUserLevelsQuery);
    $deleteUserLevelsStmt->bind_param("i", $user_id);
    $deleteUserLevelsStmt->execute();
    $deleteUserLevelsStmt->close();

    // Delete user soft skill progress
    $deleteUserSoftSkillProgressQuery = "DELETE FROM user_soft_skill_progress WHERE user_id = ?";
    $deleteUserSoftSkillProgressStmt = $conn->prepare($deleteUserSoftSkillProgressQuery);
    $deleteUserSoftSkillProgressStmt->bind_param("i", $user_id);
    $deleteUserSoftSkillProgressStmt->execute();
    $deleteUserSoftSkillProgressStmt->close();

    // Delete events associated with the username
    $deleteEventsQuery = "DELETE FROM events WHERE username = ?";
    $deleteEventsStmt = $conn->prepare($deleteEventsQuery);
    $deleteEventsStmt->bind_param("s", $username);
    $deleteEventsStmt->execute();
    $deleteEventsStmt->close();

    // Delete point history associated with the username
    $deletePointHistoryQuery = "DELETE FROM point_history WHERE username = ?";
    $deletePointHistoryStmt = $conn->prepare($deletePointHistoryQuery);
    $deletePointHistoryStmt->bind_param("s", $username);
    $deletePointHistoryStmt->execute();
    $deletePointHistoryStmt->close();

    return "Account deleted successfully.";
}

?>