<?php
//To display error message during implementation
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

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


initializeUserLevels($conn, $user_id);


 /* ----- Function for User Checkin----- */

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["checkin"])) {

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
    $user_id = $_SESSION["user_id"];


    /* ----- Function for User Progress and Bagdes Function----- */

    //Get User Data
    $userData = getUserData($conn, $username);
    $gender = $userData['gender'];
   
    //Get User Points
    $points = getUserPoints($conn, $username);

    //Get User Level and Progress
    $levelData = getLevelData($points);
    $userLevel = $levelData['level'];
    $progress = $levelData['progress'];
    $remainingPoints = $levelData['remainingPoints'];

    //Get User Rank
    $userRank = getRank($conn, $points);

    //Get Amount of Users
    $totalUsers = getTotalUsers($conn);

 

    /* ----- Function for Module Completion Badges ----- */
    
    //Check Leadership Module Completion
    $soft_skill_id = 1;
    $challenge_numbers = [1, 2, 3];
    $completed_leadership_challenges = hasCompletedSoftSkillChallenges($conn, $user_id, $soft_skill_id, $challenge_numbers);

     //Check Communication Module Completion
    $communication_id = 2;
    $completed_communcation_challenges = hasCompletedSoftSkillChallenges($conn, $user_id, $communication_id, $challenge_numbers);

    //Check Teamwork Module Completion
    $teamwork_id = 3;
    $completed_teamwork_challenges = hasCompletedSoftSkillChallenges($conn, $user_id, $teamwork_id, $challenge_numbers);

    /* ----- Function for Acheivement Badges ----- */

    $soft_skill_ids = [1, 2, 3];
    $completed_module_challenges = hasCompletedModuleChallenges($conn, $user_id, $soft_skill_ids);
    $hasSubmittedThreeEvents = hasSubmittedThreeEvents($conn, $username);
    $joined_module = hasJoinedModule($conn, $user_id);

     /* ----- Function for Badges Alert ----- */

    $leadershipAlertShown = hasBadgeAlertBeenShown($conn, $user_id, 'leadership');
    $communicationAlertShown = hasBadgeAlertBeenShown($conn, $user_id, 'communication');
    $teamworkAlertShown = hasBadgeAlertBeenShown($conn, $user_id, 'teamwork');
    $pointsAlertShown = hasBadgeAlertBeenShown($conn, $user_id, 'points');
    $challengeAlertShown = hasBadgeAlertBeenShown($conn, $user_id, 'challenge');
    $moduleAlertShown = hasBadgeAlertBeenShown($conn, $user_id, 'module');
    $eventAlertShown = hasBadgeAlertBeenShown($conn, $user_id, 'event');
    $rankAlertShown = hasBadgeAlertBeenShown($conn, $user_id, 'rank');
    $lvl1AlertShown = hasBadgeAlertBeenShown($conn, $user_id, 'lvl1');
    $lvl5AlertShown = hasBadgeAlertBeenShown($conn, $user_id, 'lvl5');


    


} catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), "\n";
    exit();
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_account_confirm"])) {
    // User clicked the "Delete Account" button, show confirmation message
    echo "<script>
            var confirmed = confirm('Are you sure you want to delete your account? This action cannot be undone.');
            if (confirmed) {
                window.location.href = 'delete_account.php';
                
            }
         </script>";
}
?>
<style>

    .progress-bar {
        background-color: #4CAF50;
        height: 100%;
        width: <?php echo $progress; ?>%;
        transition: width 0.5s ease-in-out;
        border-radius: 5px;
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
        echo '<img src="Image/Profile_Female.png" style="width:200px;height:200px;" class="logo-centered" alt="Female Profile Picture"></a>';
    } elseif ($gender === 'male') {
        echo '<img src="Image/Profile_Male.png" style="width:200px;height:200px;" class="logo-centered" alt="Male Profile Picture"></a>';
    } else {
        echo '<img src="Image/Profile.png" style="width:200px;height:200px;" class="logo-centered" alt="Profile Picture"></a>';
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
            <button class ="btn" type="submit" name="checkin">Check-in to earn 5 points</button>
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

       <!-- Module Completion Bagde -->

        <div class="badge-container">
            <p>Badges to be Earned</p>
              
            <!-- Check and Show the Bagde, Alert users when they unlocked the bagde -->

            <?php
            if ($completed_leadership_challenges) {
                echo '<img src="Image/Leadership_Unlocked.png" alt="Leadership Unlocked Badge">';
                if (!$leadershipAlertShown) {
                    echo "<script>alert('Congratulations! You\'ve earned a Leadership Badge!');</script>";
                    markBadgeAlertAsShown($conn, $user_id, 'leadership');
                }

            } else {
                echo '<img src="Image/Leadership_Locked.png" alt="Leadership Locked Badge">';
            }

            if ( $completed_communcation_challenges) {
                echo ' <img src="Image/Communication_Unlocked.png" alt="Communication Locked Badge">';
                if (!$communicationAlertShown) {
                    echo "<script>alert('Congratulations! You\'ve earned a Communication Badge!');</script>";
                    markBadgeAlertAsShown($conn, $user_id, 'communication');
                }
            

            } else {
                echo ' <img src="Image/Communication_Locked.png" alt="Communication Locked Badge">';
            }

            if ($completed_teamwork_challenges) {
                echo ' <img src="Image/Teamwork_Unlocked.png" alt="Communication Locked Badge">';
                if (!$teamworkAlertShown) {
                    echo "<script>alert('Congratulations! You\'ve earned a Teamwork Badge!');</script>";
                    markBadgeAlertAsShown($conn, $user_id, 'teamwork');
                }
            

            } else {
                echo ' <img src="Image/Teamwork_Locked.png" alt="Communication Locked Badge">';
            }
            ?>

            
            
        </div>


        <div class="badge-container">
            <p>Achievement to be Unlocked</p>

            <?php 
            if ($points >= 1) {
                echo '<img src="Image/Points_Unlocked.png" alt="Points Unlocked Badge">';  
                if (!$pointsAlertShown) {
                    echo "<script>alert('Congratulations! You\'ve earned a Points Pioneer Badge!');</script>";
                    markBadgeAlertAsShown($conn, $user_id, 'points');
                }
                  
            } else {
                echo '<img src="Image/Points_Locked.png" alt="Points Locked Badge">';
            }

            if ($joined_module) {
                echo '<img src="Image/Module_Unlocked.png" alt="Challenge Unlocked Badge">';
                if (!$challengeAlertShown) {
                    echo "<script>alert('Congratulations! You\'ve earned a Module Explorer Badge!');</script>";
                    markBadgeAlertAsShown($conn, $user_id, 'challenge');
                }
                  
            } else {
                echo '<img src="Image/Module_Locked.png" alt="Challenge Locked Badge">';
            }

            if ($completed_module_challenges) {
                echo '<img src="Image/Complete_Unlocked.png" alt="Module Unlocked Badge">';
                if (!$moduleAlertShown) {
                    echo "<script>alert('Congratulations! You\'ve earned a Module Master Badge!');</script>";
                    markBadgeAlertAsShown($conn, $user_id, 'module');
                }
            } else {
                echo '<img src="Image/Complete_Locked.png" alt="Module Locked Badge">';
            }

            $minPointsForBadge = 50; 
            $minUsersForBadge = 4; 

            if ($userRank == 1 && $points >= $minPointsForBadge && $totalUsers > $minUsersForBadge) {
                echo '<img src="Image/Rank_Unlocked.png" alt="Rank Unlocked Badge">';
                if (!$rankAlertShown) {
                    echo "<script>alert('Congratulations! You\'ve earned a Lead VoyagerBadge!');</script>";
                    markBadgeAlertAsShown($conn, $user_id, 'rank');
                }
            } else {
                echo '<img src="Image/Rank_Locked.png" alt="Rank Locked Badge">';
            }

            if ($userLevel >= 1) {
                echo '<img src="Image/Lvl1_Unlocked.png" alt="Level 1 Unlocked Badge">';
                if (!$lvl1AlertShown) {
                    echo "<script>alert('Congratulations! You\'ve earned a Skill Apprentice Level 1 Badge!');</script>";
                    markBadgeAlertAsShown($conn, $user_id, 'lvl1');
                }
            } else {
                echo '<img src="Image/Lvl1_Locked.png" alt="Level 1 Locked Badge">';
            }

            if ($userLevel >= 5) {
                echo '<img src="Image/Lvl5_Unlocked.png" alt="Level 5 Unlocked Badge">';
                if (!$lvl5AlertShown) {
                    echo "<script>alert('Congratulations! You\'ve earned a Skill Sage Level 5 Badge!');</script>";
                    markBadgeAlertAsShown($conn, $user_id, 'lvl5');
                }
            } else {
                echo '<img src="Image/Lvl5_Locked.png" alt="Level 5 Locked Badge">';
            }
            if ($hasSubmittedThreeEvents){
                echo '<img src ="Image/Event_Unlocked.png" alt ="Event Locked Bagde">';
                if (!$eventAlertShown) {
                    echo "<script>alert('Congratulations! You\'ve earned a Socialite Elite Badge!');</script>";
                    markBadgeAlertAsShown($conn, $user_id, 'event');
                }

            } else{
                echo '<img src ="Image/Event_Locked.png" alt ="Event Locked Bagde">';
            }
            ?> 
          
            
        </div>

    <button class="btn"><a href="badge_detail.php">Learn how to earn badges</a></button>   
  
    <button class="btn"><a href="point_history.php">Point History</a></button>

    <!--Account Deletion - Not Workable 

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <button class="btn-delete" type="submit" name="delete_account_confirm">Delete Account</button>
    </form> -->

</div>    

</body>
</html>