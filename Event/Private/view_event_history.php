<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once('../Public/db_connect.php');
require_once('Part/header.php');






// Check if user_id is provided in the URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $query = "SELECT username FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $username = $row['username'];  
    $stmt->close();

    // Fetch event history for the user
    $eventHistoryQuery = "SELECT * FROM events WHERE username = ?";
    $eventHistoryStmt = $conn->prepare($eventHistoryQuery);
    $eventHistoryStmt->bind_param("s", $username);  
    $eventHistoryStmt->execute();
    $eventHistoryResult = $eventHistoryStmt->get_result();

    $eventHistoryStmt->close();
} else {
    die('Error: User ID not provided.');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Event History</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/public.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>

<div class="container">
        <section class="hero">
            <div class="container">
                <h2>Event History for <?php echo $username; ?></h2>
                <?php if ($eventHistoryResult->num_rows > 0) : ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Event</th>
                                <th>Club</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $eventHistoryResult->fetch_assoc()) : ?>
                                <tr>
                                    <td><?php echo $row['datetime']; ?></td>
                                    <td><?php echo $row['event']; ?></td>
                                    <td><?php echo $row['club']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No event history available.</p>
                <?php endif; ?>
            </div>
        </section>


    </div>
</body>

</html>
