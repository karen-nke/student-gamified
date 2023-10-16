<!-- event_history.php -->
<?php
// Include necessary files (e.g., db_connect.php, header, etc.)

// Fetch and display all events history
$eventsQuery = "SELECT * FROM events WHERE username = ? ORDER BY datetime DESC";
$eventsStmt = $conn->prepare($eventsQuery);
$eventsStmt->bind_param("s", $username);
$eventsStmt->execute();
$eventsResult = $eventsStmt->get_result();

echo "<h2>All Events History</h2>";

while ($row = $eventsResult->fetch_assoc()) {
    echo "<p>{$row['event']} at {$row['club']} on {$row['datetime']}</p>";
}

$eventsStmt->close();
?>
