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