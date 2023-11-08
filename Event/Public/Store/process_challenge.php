<?php
session_start();
require_once('db_connect.php');

// Assuming you have a login system and the username is stored in the session
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION["username"];

// Fetch and display challenges
$challengesQuery = "SELECT * FROM challenges";
$challengesStmt = $conn->prepare($challengesQuery);
$challengesStmt->execute();
$challengesResult = $challengesStmt->get_result();
$totalEvents = $eventsResult->num_rows;

// Check and complete challenges automatically based on event history
while ($challenge = $challengesResult->fetch_assoc()) {
    $challengeId = $challenge['id'];
    $pointsReward = $challenge['points_reward'];
    $challengeCondition = $challenge['challenge_condition'];

    if ($eventsCount >= $challengeCondition) {
        completeChallenge($conn, $username, $challengeId, $pointsReward);
    }
}

$challengesStmt->close();


// Fetch and display events history
$eventsQuery = "SELECT * FROM events WHERE username = ?";
$eventsStmt = $conn->prepare($eventsQuery);
$eventsStmt->bind_param("s", $username);
$eventsStmt->execute();
$eventsResult = $eventsStmt->get_result();

while ($row = $eventsResult->fetch_assoc()) {
    echo '<div class="card">';
    echo '<h3>' . htmlspecialchars($row['event']) . '</h3>';
    echo '<p><strong>Club:</strong> ' . htmlspecialchars($row['club']) . '</p>';
    echo '<p><strong>Date and Time:</strong> ' . htmlspecialchars($row['datetime']) . '</p>';
    echo '</div>';
}

$eventsStmt->close();
$conn->close();

function completeChallenge($conn, $username, $challengeId, $pointsReward)
{
    // Check if the challenge is already completed
    $checkCompletionQuery = "SELECT * FROM completed_challenges WHERE username = ? AND challenge_id = ?";
    $checkCompletionStmt = $conn->prepare($checkCompletionQuery);
    $checkCompletionStmt->bind_param("si", $username, $challengeId);
    $checkCompletionStmt->execute();
    $result = $checkCompletionStmt->get_result();
    $checkCompletionStmt->close();

    if ($result->num_rows == 0) {
        // Challenge not completed yet, complete it
        $updateChallengeQuery = "INSERT INTO completed_challenges (username, challenge_id, points_reward) VALUES (?, ?, ?)";
        $updateChallengeStmt = $conn->prepare($updateChallengeQuery);
        $updateChallengeStmt->bind_param("sii", $username, $challengeId, $pointsReward);
        $updateChallengeStmt->execute();
        $updateChallengeStmt->close();

        // Update user's points
        $updatePointsQuery = "UPDATE users SET points = points + ? WHERE username = ?";
        $updatePointsStmt = $conn->prepare($updatePointsQuery);
        $updatePointsStmt->bind_param("is", $pointsReward, $username);

        if ($updatePointsStmt->execute()) {
            echo "Points updated successfully.";
        } else {
            echo "Error updating points: " . $updatePointsStmt->error;
        }

        $updatePointsStmt->close();

        // Update session variable
        $_SESSION[$username] += $pointsReward;
    }
}
