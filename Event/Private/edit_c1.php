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
    $updatedC1 = $_POST['c1_description'];

    // Update user information in the database
    $updatesoftSkillQuery = "UPDATE soft_skills SET c1_description = ? WHERE id = ?";
    $updatesoftSkillStmt = $conn->prepare($updatesoftSkillQuery);
    $updatesoftSkillStmt->bind_param("si", $updatedC1, $skill_id);

    if ($updatesoftSkillStmt->execute()) {
        echo "<script>
                alert('Information Updated');
                window.location.href = 'module_edit.php';
            </script>";
        exit();
    } else {
        echo "Error updating module information.";
    }
    $updatesoftSkillStmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Challenge 1</title>
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
                    <label for="c1_description">Theory</label>
                    <input type="textarea" id="c1_description" name="c1_description" value="<?php echo $softSkill['c1_description']; ?>" required>

                   
                    <button type="submit">Update</button>
                </form>
            </div>
        </section>


    </div>
</body>

</html>