<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once('../Public/db_connect.php');
require_once('Part/header.php');


if (isset($_GET['id'])) {
    $skill_id = $_GET['id'];

    // Fetch user information
    $softSkillQuery = "SELECT * FROM soft_skills WHERE id = ?";
    $softSkillStmt = $conn->prepare($softSkillQuery);
    $softSkillStmt->bind_param("i", $skill_id);
    $softSkillStmt->execute();
    $softSkillResult = $softSkillStmt->get_result();

    if ($softSkillResult->num_rows > 0) {
        $softSkill = $softSkillResult->fetch_assoc();
    } else {
        die('Error: User not found.');
    }

    $softSkillStmt->close();
} else {
    die('Error: User ID not provided.');
}

// Check if the update form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract data from the form
    $updatedQuestion1 = $_POST['question_1'];
    $updatedOption1A = $_POST['option_1_A'];
    $updatedOption1B = $_POST['option_1_B'];
    $updatedOption1C = $_POST['option_1_C'];
    $updatedOption1D = $_POST['option_1_D'];
    $updatedCorrectAnswer1 = $_POST['correct_answer_1'];

    $updatedQuestion2 = $_POST['question_2'];
    $updatedOption2A = $_POST['option_2_A'];
    $updatedOption2B = $_POST['option_2_B'];
    $updatedOption2C = $_POST['option_2_C'];
    $updatedOption2D = $_POST['option_2_D'];
    $updatedCorrectAnswer2 = $_POST['correct_answer_2'];

    $updatedQuestion3 = $_POST['question_3'];
    $updatedOption3A = $_POST['option_3_A'];
    $updatedOption3B = $_POST['option_3_B'];
    $updatedOption3C = $_POST['option_3_C'];
    $updatedOption3D = $_POST['option_3_D'];
    $updatedCorrectAnswer3 = $_POST['correct_answer_3'];

    // Update soft skill information in the database
    $updateSoftSkillQuery = "UPDATE soft_skills SET 
        question_1 = ?, option_1_A = ?, option_1_B = ?, option_1_C = ?, option_1_D = ?, correct_answer_1 = ?,
        question_2 = ?, option_2_A = ?, option_2_B = ?, option_2_C = ?, option_2_D = ?, correct_answer_2 = ?,
        question_3 = ?, option_3_A = ?, option_3_B = ?, option_3_C = ?, option_3_D = ?, correct_answer_3 = ?
        WHERE id = ?";

    $updateSoftSkillStmt = $conn->prepare($updateSoftSkillQuery);
    $updateSoftSkillStmt->bind_param("ssssssssssssssssssi", 
        $updatedQuestion1, $updatedOption1A, $updatedOption1B, $updatedOption1C, $updatedOption1D, $updatedCorrectAnswer1,
        $updatedQuestion2, $updatedOption2A, $updatedOption2B, $updatedOption2C, $updatedOption2D, $updatedCorrectAnswer2,
        $updatedQuestion3, $updatedOption3A, $updatedOption3B, $updatedOption3C, $updatedOption3D, $updatedCorrectAnswer3,
        $skill_id);

    if ($updateSoftSkillStmt->execute()) {
        echo "<script>
                alert('Information Updated');
                window.location.href = 'module_edit.php';
            </script>";
        exit();
    } else {
        echo "Error updating module information.";
    }
    $updateSoftSkillStmt->close();
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
                <h2 class="title">Edit Challenge 1</h2>
                <form method="post">
                <label for="question_1">Set Question 1</label>
                <input type="text" id="question_1" name="question_1" value="<?php echo $softSkill['question_1']; ?>" required>

                <label for="option_1_A">Option A</label>
                <input type="text" id="option_1_A" name="option_1_A" value="<?php echo $softSkill['option_1_A']; ?>" required>

                <label for="option_1_B">Option B</label>
                <input type="text" id="option_1_B" name="option_1_B" value="<?php echo $softSkill['option_1_B']; ?>" required>

                <label for="option_1_C">Option C</label>
                <input type="text" id="option_1_C" name="option_1_C" value="<?php echo $softSkill['option_1_C']; ?>" required>

                <label for="option_1_D">Option D</label>
                <input type="text" id="option_1_D" name="option_1_D" value="<?php echo $softSkill['option_1_D']; ?>" required>

                <label for="correct_answer_1">Correct Answer for Question 1</label>
                <input type="text" id="correct_answer_1" name="correct_answer_1" value="<?php echo $softSkill['correct_answer_1']; ?>" required>

                <label for="question_2">Set Question 2</label>
                <input type="text" id="question_2" name="question_2" value="<?php echo $softSkill['question_2']; ?>" required>

                <label for="option_2_A">Option A</label>
                <input type="text" id="option_2_A" name="option_2_A" value="<?php echo $softSkill['option_2_A']; ?>" required>

                <label for="option_2_B">Option B</label>
                <input type="text" id="option_2_B" name="option_2_B" value="<?php echo $softSkill['option_2_B']; ?>" required>

                <label for="option_2_C">Option C</label>
                <input type="text" id="option_2_C" name="option_2_C" value="<?php echo $softSkill['option_2_C']; ?>" required>

                <label for="option_2_D">Option D</label>
                <input type="text" id="option_2_D" name="option_2_D" value="<?php echo $softSkill['option_2_D']; ?>" required>

                <label for="correct_answer_2">Correct Answer for Question 2</label>
                <input type="text" id="correct_answer_2" name="correct_answer_2" value="<?php echo $softSkill['correct_answer_2']; ?>" required>

                <label for="question_3">Set Question 3</label>
                <input type="text" id="question_3" name="question_3" value="<?php echo $softSkill['question_3']; ?>" required>

                <label for="option_3_A">Option A</label>
                <input type="text" id="option_3_A" name="option_3_A" value="<?php echo $softSkill['option_3_A']; ?>" required>

                <label for="option_3_B">Option B</label>
                <input type="text" id="option_3_B" name="option_3_B" value="<?php echo $softSkill['option_3_B']; ?>" required>

                <label for="option_3_C">Option C</label>
                <input type="text" id="option_3_C" name="option_3_C" value="<?php echo $softSkill['option_3_C']; ?>" required>

                <label for="option_3_D">Option D</label>
                <input type="text" id="option_3_D" name="option_3_D" value="<?php echo $softSkill['option_3_D']; ?>" required>

                <label for="correct_answer_3">Correct Answer for Question 3</label>
                <input type="text" id="correct_answer_3" name="correct_answer_3" value="<?php echo $softSkill['correct_answer_3']; ?>" required>




                   
                    <button type="submit">Update</button>
                </form>
            </div>
        </section>


    </div>
</body>

</html>