<?php
require_once('db_connect.php');
require_once('Part/header.php');
require_once('logic_controller.php');

session_start();

// Assuming you have a login system and the username is stored in the session
if (!isset($_SESSION["username"])) {
    header("Location: login.php"); // Redirect to login page
    exit();
}

$username = $_SESSION["username"];
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$items_per_page = 10;

$totalPages = getTotalPages($conn, $username, $items_per_page);

$items_per_page = 10;
$start_index = ($page - 1) * $items_per_page;

$eventHistoryData = getEventHistoryDataPaginated($conn, $username, $start_index, $items_per_page);
?>


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
        <h3>Event History <span class="current-page"><?php echo $current_page; ?></span></h3>
       
        <table>
            <thead>
                <tr>
                    <th class="date-column">Date</th>
                    <th>Event Description</th>
                    <th>Club</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($eventHistoryData as $row) {
                    echo "<tr>";
                    echo "<td>{$row['date']}</td>";
                    echo "<td>{$row['event_description']}</td>";
                    echo "<td>{$row['club']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <a href="?page=<?php echo $i; ?>" class="<?php echo $i == $page ? 'current-page' : ''; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
        </div>

        <button class="btn"><a href="event.php">Back to Event</a></button>

    </div>
</body>

</html>
