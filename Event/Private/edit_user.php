<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once('../Public/db_connect.php');
require_once('Part/header.php');


// Check if user_id is provided in the URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch user information
    $userInfoQuery = "SELECT * FROM users WHERE id = ?";
    $userInfoStmt = $conn->prepare($userInfoQuery);
    $userInfoStmt->bind_param("i", $user_id);
    $userInfoStmt->execute();
    $userInfoResult = $userInfoStmt->get_result();

    if ($userInfoResult->num_rows > 0) {
        $userInfo = $userInfoResult->fetch_assoc();
    } else {
        die('Error: User not found.');
    }

    $userInfoStmt->close();
} else {
    die('Error: User ID not provided.');
}

// Check if the update form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract data from the form
    $updatedUsername = $_POST['username'];
    $updatedEmail = $_POST['email'];
    $updatedPoints = $_POST['points'];
    $updatedGender = $_POST['gender'];

    // Update user information in the database
    $updateUserInfoQuery = "UPDATE users SET username = ?, email = ?, points = ?, gender = ? WHERE id = ?";
    $updateUserInfoStmt = $conn->prepare($updateUserInfoQuery);
    $updateUserInfoStmt->bind_param("ssisi", $updatedUsername, $updatedEmail, $updatedPoints, $updatedGender, $user_id);

    if ($updateUserInfoStmt->execute()) {
        echo "<script>
                alert('Information Updated');
                window.location.href = 'user_edit.php';
            </script>";
        exit();
    } else {
        echo "Error updating user information.";
    }
    $updateUserInfoStmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/public.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<style>
   


    form {
        margin-top: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
      
    }

    input, select {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        box-sizing: border-box;

    }

    input:focus, select:focus {
        outline-color: #E87A00;
    }
    

    button {
        background-color: #E87A00;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #E87A00;
    }

    .additional-info {
            margin-top: 20px;
        }

        .additional-info a {
            display: block;
            margin-bottom: 10px;
            text-decoration: none;
            color: #E87A00;
            font-weight: bold;
        }
</style>
</style>

<body>
    <div class="container">
        <section class="hero">
            <div class="container">
                <h2 class="title">Edit User</h2>
                <form method="post">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo $userInfo['username']; ?>" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $userInfo['email']; ?>" required>

                    <label for="points">Points:</label>
                    <input type="number" id="points" name="points" value="<?php echo $userInfo['points']; ?>" required>

                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="Male" <?php echo ($userInfo['gender'] === 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($userInfo['gender'] === 'Female') ? 'selected' : ''; ?>>Female</option>
                        <option value="Other" <?php echo ($userInfo['gender'] === 'Other') ? 'selected' : ''; ?>>Other</option>
                    </select>

                    <button type="submit">Update</button>
                </form>
            </div>
        </section>

        <div class="additional-info">
            <a href="view_point_history.php?id=<?php echo $user_id; ?>" target="_blank">View Point History</a><br>
            <a href="view_module_progress.php?id=<?php echo $user_id; ?>" target="_blank">View Module Progress</a><br>
            <a href="view_event_history.php?id=<?php echo $user_id; ?>" target="_blank">View Event History</a><br>
         </div>

    </div>
</body>

</html>