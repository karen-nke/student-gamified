<?php
// Include necessary files and start the session
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once('db_connect.php');
require_once('Part/header.php');
require_once('logic_controller.php');

// Initialize the variable
$challenge_completed = false;

// Check if the user is authenticated
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Get user information from the session
$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];



$questions = array(
    array(
        'question' => 'Question 1?',
        'choices' => array('A', 'B', 'C', 'D'),
        'correct_answer' => 'A',
    ),
    array(
        'question' => 'Question 2?',
        'choices' => array('A', 'B', 'C', 'D'),
        'correct_answer' => 'A',
    ),
    array(
        'question' => 'Question 3?',
        'choices' => array('A', 'B', 'C', 'D'),
        'correct_answer' => 'A',
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
                    window.location.href = 'challenge_2.php';
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
        $soft_skill_id = 1; // Update with the correct soft skill ID
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
                $event_description = "Challenge 2 Point";
    
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
                    window.location.href = 'leadership.php';
                 </script>";

            } else {
                // Challenge already completed
                echo "<script>
                        alert('Challenge 2 already completed!');
                        window.location.href = 'leadership.php';
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

<style>
    .box-container {
        width: 100%;
        height: auto;
        background: white;
        border: 2px #E87A00 solid;
        padding: 50px;
        position: relative;
        margin: 25px;

    }

    .box-container h3 {
        margin-bottom: 50px;

        color: #E87A00;
        font-size: 24px;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
    }

    .box-container .question {
        color: #045174;
        font-size: 18px;
        font-weight: 400;
        line-height: 30px;
        margin-top:50px;

    }

    .box-container .button {
        font-family: 'Poppins', sans-serif; 
        font-size: 18px;
        font-weight:300;
        background-color: #E87A00;
        color: #fff;
        padding: 10px 25px 10px 25px;
        margin-top: 25px;
        border-radius: 10px;

    }

</style>

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
                <a href="challenge_3.php"><button class ="button" type="button">Next Challenge</button></a>
                
            <?php else: ?>
                <p> For testing purpose, the answer is all a" </p>
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
                </form>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>
