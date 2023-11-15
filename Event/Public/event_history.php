<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once('db_connect.php');
require_once('Part/header.php');
require_once('logic_controller.php');

// Assuming you have a login system and the username is stored in the session
if (!isset($_SESSION["username"])) {
    header("Location: login.php"); // Redirect to login page
    exit();
}

$username = $_SESSION["username"];

// Pagination variables
$perPage = 10; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;

// Get total number of rows for pagination
$totalRows = getTotalEventHistoryRows($conn, $username);

// Calculate total number of pages
$totalPages = ceil($totalRows / $perPage);

// Get event history data for the current page
$eventHistoryData = getEventHistoryDataPaginated($conn, $username, $offset, $perPage);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Point History</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
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

        <!-- Pagination -->
        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <a href="?page=<?php echo $i; ?>" <?php if ($i === $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
            <?php endfor; ?>
        </div>
    </div>
</body>

</html>
