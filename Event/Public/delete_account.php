<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once('db_connect.php');
require_once('Part/header.php');
require_once('logic_controller.php');

$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm_delete"])) {
    // Perform account deletion logic
    $deleteResult = deleteAccount($conn, $user_id, $username);

    // Display the result and redirect
    echo "<script>alert('$deleteResult');</script>";
    header("Location: logout.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <title>Delete Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <div class="box-container">
            <h3>Delete Account</h3>
            <p>Are you sure you want to delete your account? This action cannot be undone.</p>
            <form method="post" action="delete_account.php">
                <button class="btn" type="submit" name="confirm_delete">Confirm Delete</button>
            </form>
        </div>
    </div>
</body>

</html>