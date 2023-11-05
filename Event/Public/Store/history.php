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


</div>