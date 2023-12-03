<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once('../Public/db_connect.php');
require_once('Part/header.php');

// Pagination
$records_per_page = 15;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Fetch user information with pagination
$userInfoQuery = "SELECT id, username, email, points, gender FROM users LIMIT $offset, $records_per_page";
$userInfoResult = $conn->query($userInfoQuery);

if (!$userInfoResult) {
    die('Error: Failed to fetch user information.');
}

// Count total records for pagination
$totalRecordsQuery = "SELECT COUNT(*) as totalRecords FROM users";
$totalRecordsResult = $conn->query($totalRecordsQuery);
$totalRecordsRow = $totalRecordsResult->fetch_assoc();
$totalRecords = $totalRecordsRow['totalRecords'];
$totalPages = ceil($totalRecords / $records_per_page);


if (!$userInfoResult) {
    die('Error: Failed to fetch user information.');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Edit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/public.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <section class="hero">
            <div class="container">
                <h2 class="title">User Information</h2>
                <table border="1">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Points</th>
                            <th>Gender</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $userInfoResult->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['username']}</td>";
                            echo "<td>{$row['email']}</td>";
                            echo "<td>{$row['points']}</td>";
                            echo "<td>{$row['gender']}</td>";
                            echo "<td><a href='edit_user.php?id={$row['id']}'>Edit</a></td>";
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

            </div>
        </section>
    </div>
</body>

</html>