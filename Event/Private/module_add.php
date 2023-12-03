<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
    
    require_once('../Public/db_connect.php');

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Extract data from the form
        $moduleName = $_POST['name'];
        $moduleDescription = $_POST['description'];
        $badgePath = $_POST['badge_path'];
        $imagePath = $_POST['image_path'];

        // Insert new module into the soft_skills table
        $insertModuleQuery = "INSERT INTO soft_skills (name, description, badge_path, image_path) VALUES (?, ?, ?, ?)";
        $insertModuleStmt = $conn->prepare($insertModuleQuery);
        $insertModuleStmt->bind_param("ssss", $moduleName, $moduleDescription, $badgePath, $imagePath);

        if ($insertModuleStmt->execute()) {
            echo "<script>
                    alert('Module Added Successfully');
                    window.location.href = 'module_edit.php';
                </script>";
        } else {
            echo "Error adding module: " . $conn->error;
        }

        $insertModuleStmt->close();
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

    input, select , textarea{
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        box-sizing: border-box;

    }

    input:focus, select:focus, textarea:focus {
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

<body>
    <div class="container">
        <section class="hero">
            <div class="container">
                <h2>Add Module</h2>
                <form method="post">
                    <label for="name">Module Name:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="description">Module Description:</label>
                    <textarea id="description" name="description" required></textarea>

                    <label for="badge_path">Badge Path:</label>
                    <input type="text" id="badge_path" name="badge_path" required>

                    <label for="image_path">Image Path:</label>
                    <input type="text" id="image_path" name="image_path" required>

                    <button type="submit">Add Module</button>
                </form>
            </div>
        </section>
    </div>
</body>

</html>
