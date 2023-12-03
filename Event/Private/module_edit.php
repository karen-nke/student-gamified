<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../Public/db_connect.php');
require_once('Part/header.php');

// Fetch soft skills data from the database
$softSkillsQuery = "SELECT * FROM soft_skills";
$softSkillsResult = $conn->query($softSkillsQuery);

if (!$softSkillsResult) {
    die('Error: Failed to fetch soft skills data.');
}
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <title>User Edit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/public.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>
    <!-- Other body content remains unchanged -->

    <div class="page-container">

    <div class="container">
        <section class="hero">
            <div class="container">
                <h2>Edit Soft Skills</h2>
                <?php if ($softSkillsResult->num_rows > 0) : ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Badge Path</th>
                                <th>Image Path</th>
                                <th>Action</th>
                                <th>Challenge</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $softSkillsResult->fetch_assoc()) : ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><?php echo $row['badge_path']; ?></td>
                                    <td><?php echo $row['image_path']; ?></td>
                                    <td><a class="edit-link" href="edit_module.php?id=<?php echo $row['id']; ?>">Edit</a></td>
                                    <td>
                                        <a class="edit-link" href="edit_c1.php?id=<?php echo $row['id']; ?>">Challenge1</a><br><br>
                                        <a class="edit-link" href="edit_c2.php?id=<?php echo $row['id']; ?>">Challenge2</a><br><br>
                                    
                                    </td>
                                  
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No soft skills available.</p>
                <?php endif; ?>

                <a href="module_add.php"><button class="btn"> Add Module </button></a>
            </div>
        </section>
    </div>
    </div>
</body>

</html>