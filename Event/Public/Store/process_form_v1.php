<?php
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

    // Close the update statement
    $conn->close();
}
