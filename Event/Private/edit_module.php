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
    $updatedName = $_POST['name'];
    $updatedDescription = $_POST['description'];
    $updatedBadgePath = $_POST['badge_path'];
    $updatedImagePath = $_POST['image_path'];

    // Update user information in the database
    $updatesoftSkillQuery = "UPDATE soft_skills SET name = ?, description = ?, badge_path = ?, image_path = ? WHERE id = ?";
    $updatesoftSkillStmt = $conn->prepare($updatesoftSkillQuery);
    $updatesoftSkillStmt->bind_param("ssssi", $updatedName, $updatedDescription, $updatedBadgePath, $updatedImagePath, $skill_id);

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
                    <label for="username">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $softSkill['name']; ?>" required>

                    <label for="description">Description:</label>
                    <input type="text" id="description" name="description" value="<?php echo $softSkill['description']; ?>" required>

                    <label for="badge_path">Badge Path:</label>
                    <input type="text" id="badge_path" name="badge_path" value="<?php echo $softSkill['badge_path']; ?>" required>

                    <label for="image_path">Image Path:</label>
                    <input type="text" id="image_path" name="image_path" value="<?php echo $softSkill['image_path']; ?>" required>

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