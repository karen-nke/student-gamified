<?php

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


// Initialize the variable
$challenge_completed = false;

$skill = $_GET['skill'];

$data = getSoftSkillData($conn, $skill);

if (!$data) {
    die('Error: Failed to fetch data for the selected skill.');
}


$soft_skill_id= $data['id'];

$questions = array(
    array(
        'question' => $data['question_1'],
        'choices' => array($data['option_1_A'], $data['option_1_B'], $data['option_1_C'], $data['option_1_D']),
        'correct_answer' => $data['correct_answer_1'],
    ),
    array(
        'question' => $data['question_2'],
        'choices' => array($data['option_2_A'], $data['option_2_B'], $data['option_2_C'], $data['option_2_D']),
        'correct_answer' => $data['correct_answer_2'],
    ),
    array(
        'question' => $data['question_3'],
        'choices' => array($data['option_3_A'], $data['option_3_B'], $data['option_3_C'], $data['option_3_D']),
        'correct_answer' => $data['correct_answer_3'],
    ),
);


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the submitted answers
    $answers = array();

    foreach ($questions as $i => $question) {
        $answer_key = 'answer_' . $i;
        if (isset($_POST[$answer_key])) {
            $answers[$i] = $_POST[$answer_key];
        } else {
            echo "<script>
                    alert('Please answer all questions');
                    window.location.href = 'challenges_2.php?skill=" . urlencode($skill) . "';
                 </script>";
                    
            exit();
        }
    }

    $all_correct = true;

    foreach ($questions as $i => $question) {
        if ($answers[$i] !== $question['correct_answer']) {
            $all_correct = false;
            break;
        }
    }

    if ($all_correct) {
        // Update user progress and points
        $soft_skill_id= $data['id'];
        $challenge_number = 2;
        
        // Check if the challenge is already completed
        $check_completion_query = "SELECT completed FROM user_soft_skill_progress WHERE user_id = ? AND soft_skill_id = ? AND challenge_number = ?";
        $check_completion_stmt = $conn->prepare($check_completion_query);
        $check_completion_stmt->bind_param("iii", $user_id, $soft_skill_id, $challenge_number);
        $check_completion_stmt->execute();
        $check_completion_result = $check_completion_stmt->get_result();
        $challenge_completed_row = $check_completion_result->fetch_assoc();

        if ($challenge_completed_row !== null) {
            $challenge_completed = $challenge_completed_row['completed'];
        } else {

            if (!$challenge_completed) {
                // Challenge 2 completion query
                $completion_query = "INSERT INTO user_soft_skill_progress (user_id, soft_skill_id, challenge_number, completed) VALUES (?, ?, ?, 1)";
                $completion_stmt = $conn->prepare($completion_query);
                $completion_stmt->bind_param("iii", $user_id, $soft_skill_id, $challenge_number);
                $completion_stmt->execute();
                $completion_stmt->close();
    
                // Add points to user's points and record in point_history
                $points_to_add = 20; // Update with the correct points
                $event_description = "Challenge 2 Point - " . $data['name'];
    
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
    
                echo
                "<script>
                    alert('Challenge 2 completed!');
                    window.location.href = 'challenges_3.php?skill=" . urlencode($skill) . "';
                 </script>";

            } else {
                // Challenge already completed
                echo "<script>
                        alert('Challenge 2 already completed!');
                        window.location.href = 'soft_skills.php?skill=" . urlencode($skill) . "';
                    </script>";
            }
        }


        $check_completion_stmt->close();
    } else {
        // Display a message indicating that not all answers are correct
        echo "<script>alert('Not all answers are correct. Please try again.');</script>";
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Leadership - Challenge 2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="container">
        <div class="box-container">
            <h3>Challenge 2</h3>
           

            <?php if ($challenge_completed): ?>
                <p>Congratulations! You completed Challenge 2.</p>
                <a href="challenges_3.php?skill=<?php echo $skill; ?>"><button class ="button" type="button">Next Challenge</button></a>
                
                <?php else: ?>
                
                <form method="post">
                    <?php foreach ($questions as $index => $question): ?>
                            <div class="question-container">
                                <p class ="question"><?php echo $question['question']; ?></p>
                                
                                <?php foreach ($question['choices'] as $choice): ?>
                                    <label>
                                        <input type="radio" name="answer_<?php echo $index; ?>" value="<?php echo $choice; ?>">
                                        <?php echo $choice; ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>

                    <button class ="button" type="submit" name="submit">Submit Answers</button>

                    <p> Answer </p>
                    <p><?php echo $data['correct_answer_1']?></p>
                    <p><?php echo $data['correct_answer_2']?></p>
                    <p><?php echo $data['correct_answer_3']?></p>
                </form>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>
