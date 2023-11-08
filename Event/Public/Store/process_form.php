<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once('db_connect.php');

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
        $pointsReward = 10; // Hard-coded points
        $eventDescription = "Event participation"; // Hard-coded event description
        $recordHistoryStmt->bind_param("sis", $username, $pointsReward, $eventDescription);
        $recordHistoryStmt->execute();
        $recordHistoryStmt->close();

        // Close the database connection
        $conn->close();

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
