<?php
// Include necessary files and start the session
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once('db_connect.php');
require_once('Part/header.php');
require_once('logic_controller.php');

// Check if the user is authenticated
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Get user information from the session
$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];



// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  


    $challenge_completed = true;
} else {
    // Display the quiz questions
  
    $questions = array(
        array(
            'question' => 'Questions',
            'choices' => array('A', 'B', 'C', 'D'),
            'correct_answer' => 'A',
        ),
        array(
            'question' => 'Questions',
            'choices' => array('A', 'B', 'C', 'D'),
            'correct_answer' => 'B',
        ),
        array(
            'question' => 'Questions',
            'choices' => array('A', 'B', 'C', 'D'),
            'correct_answer' => 'C',
        ),
        
    );


    $challenge_completed = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Challenge 2</title>
  
</head>

<body>

    <div class="container">
        <div class="box-container">
            <h3>Challenge 2</h3>

            <?php if ($challenge_completed): ?>
                <p>Congratulations! You completed Challenge 2.</p>
                
            <?php else: ?>
                <form method="post">
                  
                    <?php foreach ($questions as $index => $question): ?>
                        <div class="question-container">
                            <p><?php echo $question['question']; ?></p>
                            
                            <?php foreach ($question['choices'] as $choice): ?>
                                <label>
                                    <input type="radio" name="answer_<?php echo $index; ?>" value="<?php echo $choice; ?>">
                                    <?php echo $choice; ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>

                    <button type="submit" name="submit">Submit Answers</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>
