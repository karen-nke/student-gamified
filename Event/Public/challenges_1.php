<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('db_connect.php');
require_once('Part/header.php');
require_once('logic_controller.php');

$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];

$skill = $_GET['skill'];

$data = getSoftSkillData($conn, $skill);

if (!$data) {
    die('Error: Failed to fetch data for the selected skill.');
}

$soft_skill_name = $data['name']; // Update with the current soft skill module

// Get the soft skill ID
$soft_skill_query = "SELECT id FROM soft_skills WHERE name = ?";
$soft_skill_stmt = $conn->prepare($soft_skill_query);
$soft_skill_stmt->bind_param("s", $soft_skill_name);
$soft_skill_stmt->execute();
$soft_skill_result = $soft_skill_stmt->get_result();
$soft_skill_row = $soft_skill_result->fetch_assoc();
$soft_skill_id = $soft_skill_row['id'];
$soft_skill_stmt->close();

$disable_button = false; // Initialize to false by default

// Challenge 1 completion handling
if (isset($_POST['done'])) {
    $challenge_number = 1; // Challenge 1

    // Check if the challenge is already completed
    $check_completion_query = "SELECT completed FROM user_soft_skill_progress WHERE user_id = ? AND soft_skill_id = ? AND challenge_number = ?";
    $check_completion_stmt = $conn->prepare($check_completion_query);
    $check_completion_stmt->bind_param("iii", $user_id, $soft_skill_id, $challenge_number);
    $check_completion_stmt->execute();
    $check_completion_result = $check_completion_stmt->get_result();
    $challenge_completed = $check_completion_result->fetch_assoc()['completed'];

    if ($challenge_completed) {
        $disable_button = true;
        
    } else {
        // Challenge 1 completion query
        $completion_query = "INSERT INTO user_soft_skill_progress (user_id, soft_skill_id, challenge_number, completed) VALUES (?, ?, ?, 1)";
        $completion_stmt = $conn->prepare($completion_query);
        $completion_stmt->bind_param("iii", $user_id, $soft_skill_id, $challenge_number);
        $completion_stmt->execute();
        $completion_stmt->close();

        // Add 10 points to user's points and record in point_history
        $points_to_add = 20;
        $event_description = "Challenge Point";

        // Update user's points
        $update_points_query = "UPDATE users SET points = points + ? WHERE id = ?";
        $update_points_stmt = $conn->prepare($update_points_query);
        $update_points_stmt->bind_param("ii", $points_to_add, $user_id);
        $update_points_stmt->execute();
        $update_points_stmt->close();

        // Record point history with added_at timestamp
        $record_history_query = "INSERT INTO point_history (username, points_added, event_description, added_at) VALUES (?, ?, ?, NOW())";
        $record_history_stmt = $conn->prepare($record_history_query);
        $record_history_stmt->bind_param("sis", $username, $points_to_add, $event_description);
        $record_history_stmt->execute();
        $record_history_stmt->close();

        echo "<script>alert('Challenge completed!');</script>";
        
    }

    $check_completion_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Leadership Challenge 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="container">
        <div class="box-container">
            <h3><?php echo $data['name']; ?></h3>

            <p><?php echo $data['c1_description']; ?></p>

                <form method="post">
                    <?php if ($disable_button): ?>
                        <a href="challenges_2.php?skill=<?php echo $skill; ?>"><button class ="button" type="button">Next Challenge</button></a>
                    <?php else: ?>
                        <button class ="button" type="submit" name="done">Done</button>
                    <?php endif; ?>
                </form>


        </div>

    </div>

</body>

</html>
