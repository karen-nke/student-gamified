<?php
session_start();

require_once('db_connect.php');
require_once('Part/_header.php');

// Assuming you have a login system and the username is stored in the session
if (!isset($_SESSION["username"])) {
    header("Location: login.php"); // Redirect to login page
    exit();
}

$username = $_SESSION["username"];

//$points = isset($_SESSION[$username]) ? $_SESSION[$username] : 0; 
//This is used previously but cannot be used, because when user first logged in, the point doesnt showed unless user submit the form.
    

// Fetch and display point history
$pointHistoryQuery = "SELECT * FROM point_history WHERE username = ?";
$pointHistoryStmt = $conn->prepare($pointHistoryQuery);
$pointHistoryStmt->bind_param("s", $username);
$pointHistoryStmt->execute();
$pointHistoryResult = $pointHistoryStmt->get_result(); ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Point History</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="container">
    <h2 class="title"><br>Welcome, <?php echo $username; ?>!</h2>
</div>
   
<div class="page-container">
<h3>Point History</h3>

    <table>
    <thead>
        <tr>
            <th class="date-column">Date</th>
            <th>Event Description</th>
            <th>Points Added</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = $pointHistoryResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['added_at']}</td>";
            echo "<td>{$row['event_description']}</td>";
            echo "<td>{$row['points_added']}</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

    </div>

<?php
    $pointHistoryStmt->close();
    ?>

</div>

</body>
</html>