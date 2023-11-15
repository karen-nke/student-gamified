<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$user_id = $_SESSION["user_id"];

require_once('db_connect.php');
// Remove session_start() from header.php
require_once('Part/header.php');
require_once('logic_controller.php');

$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Perform the check-in logic
    $checkinResult = checkin($conn, $user_id);

    // Display the check-in result
    echo "<script>alert('$checkinResult');</script>";
}

try {
    if (!isset($_SESSION["username"])) {
        throw new Exception("User not authenticated");
    }

    $username = $_SESSION["username"];

    $userData = getUserData($conn, $username);
    $gender = $userData['gender'];

    $points = getUserPoints($conn, $username);

    $levelData = getLevelData($points);
    $userLevel = $levelData['level'];
    $progress = $levelData['progress'];
    $remainingPoints = $levelData['remainingPoints'];

    $userRank = getRank($conn, $points);
} catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), "\n";
    exit();
}

function hasJoinedModule($conn, $user_id) {
    $check_module_query = "SELECT COUNT(*) as count FROM user_soft_skill_progress WHERE user_id = ?";
    $check_module_stmt = $conn->prepare($check_module_query);
    $check_module_stmt->bind_param("i", $user_id);
    $check_module_stmt->execute();
    $result = $check_module_stmt->get_result();
    $count = $result->fetch_assoc()['count'];
    $check_module_stmt->close();

    return $count > 0;
}
$joined_module = hasJoinedModule($conn, $user_id);

function hasCompletedSoftSkillChallenges($conn, $user_id, $soft_skill_id, $challenge_numbers) {
    $check_completion_query = "SELECT COUNT(*) as count FROM user_soft_skill_progress WHERE user_id = ? AND soft_skill_id = ? AND challenge_number IN (?, ?, ?)";
    $check_completion_stmt = $conn->prepare($check_completion_query);
    $check_completion_stmt->bind_param("iiiii", $user_id, $soft_skill_id, $challenge_numbers[0], $challenge_numbers[1], $challenge_numbers[2]);
    $check_completion_stmt->execute();
    $result = $check_completion_stmt->get_result();
    $count = $result->fetch_assoc()['count'];
    $check_completion_stmt->close();

    return $count == count($challenge_numbers);
}

$soft_skill_id = 1;
$challenge_numbers = [1, 2, 3];
$completed_soft_skill_challenges = hasCompletedSoftSkillChallenges($conn, $user_id, $soft_skill_id, $challenge_numbers);



?>
<style>

    .progress-bar {
        background-color: #4CAF50;
        height: 100%;
        width: <?php echo $progress; ?>%;
        transition: width 0.5s ease-in-out;
        border-radius: 5px;
    }

    .logo-centered {

    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;

    }  

    .profile-info{
        padding: 20px;
    }

    .profile-info .container{
        width: 100%;
        height: 100px; 
        background: white; 
        border: 2px #E87A00 solid;
        padding:50px;
        position: relative;
        margin: 25px;
        display:flex;
        justify-content: space-between;
    }

    .profile-info .badge-container {
    width: 100%; 
    height: auto;
    padding:50px;
    position: relative;
    margin: 25px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    background: white; 
    border: 2px #E87A00 solid;
    }

    .profile-info .badge-container img {
    width: 30%;
    height: auto;
    margin: 10px;
    }

    .profile-info .badge-container p {
    margin: 0;
    position: absolute;
    top: 20px;
    left: 20px;
    color: #E87A00;
    font-size: 24px;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    }



    .profile-info .container p{
    margin: 0;
    position: absolute;
    top: 50%;
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);

    
        color: #E87A00;
        font-size: 24px;
        font-family: 'Poppins', sans-serif; 
        font-weight: 500;
    }

    .checkin-container{
        margin: 25px;
    }

</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="container">
    <?php
    if ($gender === 'female') {
        echo '<img src="Image/Profile_Female.png" style="width:200px;height:200px;" class="logo-centered"></a>';
    } elseif ($gender === 'male') {
        echo '<img src="Image/Profile_Male.png" style="width:200px;height:200px;" class="logo-centered"></a>';
    } else {
        echo '<img src="Image/Profile.png" style="width:200px;height:200px;" class="logo-centered"></a>';
    }
    ?>
    
    <h2 class="title"><br>Welcome, <?php echo $username; ?>!</h2>
</div>

<div class ="container">


    <div class="profile-info">
        <!-- Progress bar -->
        <div class= "p-container">
        
            <p class="progress">Level Progress: <?php echo round($progress, 2); ?>%</p>
            <p class="progress">Remaining Points to Next Level: <?php echo $remainingPoints; ?></p>
            <div class="progress-bar-container">
                <div class="progress-bar"></div>
            </div>

            <!-- Level label -->
            <div class="level-label">
                <span>Level <?php echo $userLevel; ?></span>
                <span>Level <?php echo $userLevel + 1; ?></span>
            </div>
         
           

        </div>



      <div class="checkin-container">
        <form method="post" action="account.php">
            <button class ="btn" type="submit">Check-in to earn 5 points</button>
        </form>  

      </div>

       
       

        <div class="container">
            <p>Points Earned: <?php echo $points; ?></p>
        </div>
        

        <div class="container">
            <p>Level: <span><?php echo $userLevel; ?></span></p>
        </div>

        <div class="container">
            <p>Current Ranking: <span><?php echo $userRank; ?></span></p>
        </div>

        <div class="badge-container">
            <p>Badges to be Earned</p>

            <?php
            if ($completed_soft_skill_challenges) {
                echo '<img src="Image/Leadership_Unlocked.png" alt="No. 1 Badge">';
            } else {
                echo '<img src="Image/Leadership_Locked.png" alt="No. 1 Badge">';
            }
            ?>
            
            <img src="Image/Communication_Locked.png" alt="No. 1 Badge">
            <img src="Image/Teamwork_Locked.png" alt="No. 1 Badge">
          
            
            
        </div>

        <div class="badge-container">
            <p>Acheivement to be Unlocked</p>

            <?php 
            if ($points >= 1) {
                echo ' <img src="Image/Points_Unlocked.png" alt="Points Badge">';
                }else{
                    echo ' <img src="Image/Points_Locked.png" alt="Points Badge">';
                }
            ?>
            <?php

            if ($joined_module) {
                echo '<img src="Image/Module_Unlocked.png" alt="Rank Badge">';

            }else{
                echo '<img src="Image/Module_Locked.png" alt="Rank Badge">';
            }
            ?>

            <img src="Image/Complete_Locked.png" alt="Complete Badge">
            <?php

                if ($userRank == 1) {
                echo '<img src="Image/Rank_Unlocked.png" alt="Rank Badge">';
                }else{
                    echo ' <img src="Image/Rank_Locked.png" alt="Rank Badge">';
                }

                if ($userLevel >= 1) {
                    echo '<img src="Image/Lvl1_Unlocked.png" alt="Rank Badge">';
                }else{
                    echo '<img src="Image/Lvl1_Locked.png" alt="Rank Badge">';

                }

                if ($userLevel >= 5) {
                    echo '<img src="Image/Lvl5_Unlocked.png" alt="Rank Badge">';
                }else{
                    echo '<img src="Image/Lvl5_Locked.png" alt="Rank Badge">';

                }

            ?> 
            
        </div>

    <button class="btn"><a href="badge_detail.php">Learn how to earn badges</a></button>   
  
    <button class="btn"><a href="point_history.php">Point History</a></button>

</div>    

</body>
</html>