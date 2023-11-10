<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start or resume the session
session_start();

echo '<pre>';
print_r($_SESSION);
echo '</pre>';


// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: Login/login.php"); // Redirect to login page if not logged in
    exit();
}

require_once('db_connect.php');
require_once('Part/header.php');
require_once('logic_controller.php');

// Assuming you have the user ID in the session
$user_id = $_SESSION["user_id"];

$soft_skill_name = 'Leadership'; // Update with the current soft skill module

// Get the soft skill ID
$soft_skill_query = "SELECT id FROM soft_skills WHERE name = ?";
$soft_skill_stmt = $conn->prepare($soft_skill_query);
$soft_skill_stmt->bind_param("s", $soft_skill_name);
$soft_skill_stmt->execute();
$soft_skill_result = $soft_skill_stmt->get_result();
$soft_skill_row = $soft_skill_result->fetch_assoc();
$soft_skill_id = $soft_skill_row['id'];
$soft_skill_stmt->close();

// Challenge 1 completion handling
if (isset($_POST['done'])) {
    $challenge_number = 1; // Challenge 1
    $completion_query = "INSERT INTO user_soft_skill_progress (user_id, soft_skill_id, challenge_number, completed) VALUES (?, ?, ?, 1)";
    $completion_stmt = $conn->prepare($completion_query);
    $completion_stmt->bind_param("iii", $user_id, $soft_skill_id, $challenge_number);

    $completion_stmt->execute();
    $completion_stmt->close();

    // Redirect to the main soft skill module page
    header("Location: leadership.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <title>Events Point Tracker</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<style>
     .box-container{
        width: 100%;
        height: auto; 
        background: white; 
        border: 2px #E87A00 solid;
        padding:50px;
        position: relative;
        margin: 25px;
      
    }

    .box-container h3{
    margin-bottom: 50px;
    
        color: #E87A00;
        font-size: 24px;
        font-family: 'Poppins', sans-serif; 
        font-weight: 500;
    }

    .box-container p{
    color: #045174;
    font-size: 18px;
    font-weight: 400;
    line-height: 30px;

    }
</style>

<body>

<div class ="container">
    <div class ="box-container">
        <h3>Leadership </h3>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec interdum accumsan orci, at pretium magna dignissim et. Sed ac felis a sapien interdum imperdiet in a felis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed leo dui, egestas sed ullamcorper vitae, euismod vel nunc. Ut sed justo quis justo aliquam ultricies quis et odio. Nulla laoreet scelerisque sapien. Nunc ut pharetra ipsum.

            Quisque ac urna lectus. Nunc ex nisi, egestas id hendrerit eget, tristique ac risus. Maecenas orci nisl, mattis in turpis nec, sagittis blandit elit. Cras laoreet arcu ex, at sagittis ligula posuere a. Quisque id dui et urna aliquet porttitor aliquet eu ex. Donec eget massa erat. Donec accumsan massa sapien, nec tincidunt enim interdum in. Quisque ut vulputate nisl. Vestibulum luctus, sem id feugiat sollicitudin, dui diam interdum neque, vel interdum tortor neque eget ante. Aliquam non augue lacus. In viverra venenatis augue, eu suscipit tellus posuere vel. Maecenas convallis mauris quis turpis pellentesque, blandit rhoncus dolor congue. Suspendisse ut tempus justo, nec sodales massa. In at massa pretium, tincidunt magna et, molestie massa.</p>
        
        <form method="post">
            <button type="submit" name="done">Done</button>
        </form>
    
    </div>

</div>



       
              


                
                        

                        
</body>

</html>

