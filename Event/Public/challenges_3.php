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

$skill = $_GET['skill'];

$data = getSoftSkillData($conn, $skill);

if (!$data) {
    die('Error: Failed to fetch data for the selected skill.');
}


$soft_skill_id= $data['id'];
$challenge_number = 3;

// Check if the user has completed the challenge previously
$check_completion_query = "SELECT completed FROM user_soft_skill_progress WHERE user_id = ? AND soft_skill_id = ? AND challenge_number = ?";
$check_completion_stmt = $conn->prepare($check_completion_query);
$check_completion_stmt->bind_param("iii", $user_id, $soft_skill_id, $challenge_number);
$check_completion_stmt->execute();
$check_completion_result = $check_completion_stmt->get_result();
$challenge_completed_row = $check_completion_result->fetch_assoc();

if ($challenge_completed_row !== null && $challenge_completed_row['completed']) {
    // User has already completed the challenge
    echo "<script>
            alert('You have already completed Challenge 3!');
            window.location.href = 'soft_skills.php?skill=" . urlencode($skill) . "';
        </script>";
    exit();
}

$check_completion_stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST["description"];

    // Update practical_form
    $insertEventQuery = "INSERT INTO practical_form (user_id, soft_skill_id, date_stamp, description) VALUES (?, ?, NOW(), ?)";
    $insertEventStmt = $conn->prepare($insertEventQuery);
    $insertEventStmt->bind_param("iis", $user_id, $soft_skill_id, $description);
    $insertEventStmt->execute();
    $insertEventStmt->close();

    // Challenge 3 completion query
    $completion_query = "INSERT INTO user_soft_skill_progress (user_id, soft_skill_id, challenge_number, completed) VALUES (?, ?, ?, 1)";
    $completion_stmt = $conn->prepare($completion_query);
    $completion_stmt->bind_param("iii", $user_id, $soft_skill_id, $challenge_number);
    $completion_stmt->execute();
    $completion_stmt->close();

    // Add points to user's points and record in point_history
    $points_to_add = 20;
    $event_description = "Challenge 3 Point - " . $data['name'];

    $update_points_query = "UPDATE users SET points = points + ? WHERE id = ?";
    $update_points_stmt = $conn->prepare($update_points_query);
    $update_points_stmt->bind_param("ii", $points_to_add, $user_id);
    $update_points_stmt->execute();
    $update_points_stmt->close();

    $record_history_query = "INSERT INTO point_history (username, points_added, event_description, added_at) VALUES (?, ?, ?, NOW())";
    $record_history_stmt = $conn->prepare($record_history_query);
    $record_history_stmt->bind_param("sis", $username, $points_to_add, $event_description);
    $record_history_stmt->execute();
    $record_history_stmt->close();

    echo "<script>
            alert('Challenge 3 completed!');
            window.location.href = 'soft_skills.php?skill=" . urlencode($skill) . "';
         </script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Leadership - Challenge 3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="container">
        <div class="box-container">
            <h3>Challenge 3</h3>

            <?php
                        // Check if the user is logged in
                        if (isset($_SESSION["username"])) {
                             
                        ?>
                            <form action="" method="post" class="login-email">
                                <p class="login-text" style='font-size:2rem; font-weight:800;'>Submission</p>

                                <div class="input-group">
                                    <?php
                                    // Assuming you have a login system and the username is stored in the session
                                    if (isset($_SESSION["username"])) {
                                        $username = $_SESSION["username"];
                                        echo "<input type='text' id='username' placeholder='Username' name='username' value='$username' readonly>";
                                    } else {
                                        echo "<input type='text' id='username' placeholder='Username' name='username' required>";
                                    }
                                    ?>
                                </div>

                                <div class="input-group">
                                    <input type="text" id="description" placeholder="Describe your experience in <?php echo $data['name']?>" name="description" required>
                                </div>

                                <button class="btn" type="submit">Submit</button>
                            </form>

                              
                        <?php
                        } else {
                                // User is not logged in, show a message or redirect to the login page
                                echo "<p>Please <a href='Login/login.php'>login</a> first.</p>";
                        }
                        ?>
                       

           

        </div>
    </div>

</body>

</html>
