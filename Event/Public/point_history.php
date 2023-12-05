<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Include necessary files
require_once('db_connect.php');
require_once('Part/header.php');
require_once('logic_controller.php');

// Check if the user is authenticated
if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page if not authenticated
    header("Location: login.php");
    exit();
}


// Get user information from the session
$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];

// Fetch total number of rows
$totalRows = getTotalRows($conn, $username);

// Calculate total number of pages
$items_per_page = 10;
$totalPages = ceil($totalRows / $items_per_page);

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_index = ($page - 1) * $items_per_page;

$pointHistoryData = getPointHistoryDataPaginated($conn, $username, $start_index, $items_per_page);
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
                foreach ($pointHistoryData as $row) {
                    echo "<tr>";
                    echo "<td>{$row['date']}</td>";
                    echo "<td>{$row['event_description']}</td>";
                    echo "<td>{$row['points_added']}</td>";
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

        <button class="btn"><a href="account.php">Back to Account</a></button>
    </div>
</body>
</html>
