<?php
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

$skill = $_GET['skill'];
$soft_skill_id = getSoftSkillIdByName($conn, $skill);
$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;

//echo "User ID: " . $user_id . "<br>";
//echo "Soft Skill ID: " . $soft_skill_id . "<br>";


$data = getSoftSkillData($conn, $skill);
$challenge1Completed = hasCompletedChallenge($conn, $user_id, $soft_skill_id, 1);
$challenge2Completed = hasCompletedChallenge($conn, $user_id, $soft_skill_id, 2);
$challenge3Completed = hasCompletedChallenge($conn, $user_id, $soft_skill_id, 3);

$completionPercentage = ($challenge1Completed + $challenge2Completed + $challenge3Completed) / 3 * 100;

$completionText = "{$data['name']} Challenges: ";
$completedChallenges = [$challenge1Completed, $challenge2Completed, $challenge3Completed];
$completedCount = array_sum($completedChallenges);
$totalChallenges = count($completedChallenges);

for ($i = 1; $i <= $totalChallenges; $i++) {
    $completionText .= ($i <= $completedCount) ? "✔" : "◻";
    $completionText .= ($i < $totalChallenges) ? " / " : "";
}



if (!$data) {
    die('Error: Failed to fetch data for the selected skill.');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <title>Leadership Module</title> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<style>
.progress-container {
    margin-top: 20px;
    text-align: center;
}

.progress-bar {
    width: 100%;
    background-color: #e0e0e0;
    border-radius: 5px;
    overflow: hidden;
    height:20px;
    margin-top:25px;

    
}

.progress {
    height: 20px;
    background-color: #4caf50;
    transition: width 0.3s ease-in-out;
    margin-left: unset;
}

.percentage {
    margin-top: 10px;
}

.completion-text{
        margin-top:25px;
}
</style>


<body>
<div class ="container">


       
                <section class="hero">
                        <div class ="container">
                                <div class="mid">
                                        <div class="desc">
                                                <h2><?php echo $data['name']; ?></h2>
                                                <p><?php echo $data['description']; ?></p>
                                        </div>  

                                        

                                        <img src="<?php echo $data['image_path']; ?>" />
                                
                                </div>

                                <div class="progress-container">
                                        <p class="title">Challenges Progress</p>
                                     
                                        <div class="progress-bar">
                                                <div class="progress" style="width: <?php echo $completionPercentage; ?>%;"></div>
                        
                                        </div>
                                        <p class="completion-text"><?php echo $completionText; ?></p>

                                        <?php if (!isset($_SESSION["username"])) { ?>
                                                <a href="Login/Login.php"><button class="challenge-button">Login to Make Progress</button></a>
                                           <?php } ?>
                                </div>

                                

                                
                                <?php
                                        if ($completedCount === $totalChallenges) { ?>

                                          <div class="box-container">
                                                <p class="title">Congratulations</p>
                                                <div class ="badge-container">
                                                        <div class ="image-container">
                                                                <img src="<?php echo getSkillImage($soft_skill_id); ?>" />  
                                                        </div>

                                                        <div class ="text-container">
                                                                <p class ="badge-title">You've already earned <?php echo $data ['name'] ?> Completion Badge</p> <br>
                                                                <a href="account.php"><button class="challenge-button">View in Account</button></a>
                                                        
                                                        </div>

                                                </div>
                                        </div>        

                                        

                                      
                                <?php } ?>

                              

                                <div class="box-container">
                                        <p class="title">Completion Reward</p>
                                        <div class ="badge-container">
                                                <div class ="image-container">
                                                        <img src="Image/Points_Icon.png" class ="image" alt="No. 1 Badge">
                                                </div>

                                                <div class ="text-container">
                                                        <p class ="badge-title">1. Complete Challenges to earn points</p> <br>
                                                        <p class ="badge-desc">Earn 20 points by completing each challenges.</p>
                                                       
                                                
                                                </div>

                                        </div>

                                        <div class ="badge-container">
                                                <div class ="image-container">
                                                        <img src="<?php echo $data['badge_path']; ?>" class ="image" alt="No. 1 Badge">
                                                </div>

                                                <div class ="text-container">
                                                        <p class ="badge-title">2. Complete module to earn badge</p> <br>
                                                        <p class ="badge-desc">Complete all three module to earn a <?php echo $data['name'] ?> completion badge</p>
                                                
                                                </div>

                                        </div>


                                </div>

                                <div class="box-container">
                                        <p class="title">Challenges</p>
                                        <div class ="badge-container">
                                                <div class ="image-container">
                                                        <img src="Image/Challenge Box 1.png" class ="challenge-image" alt="No. 1 Badge">
                                                        
                                                </div>

                                                <div class ="text-container">
                                                        <p class ="badge-title">Theory</p> <br>
                                                        <p class ="badge-desc">In this theoretical challenge, participants delve into the foundational aspects of <?php echo $data ['name'] ?>. The focus is on providing a comprehensive understanding and their significance in various aspects of personal and professional life.</p>
                                                        <?php if (isset($_SESSION["username"])) {
                                                                if (!$challenge1Completed) { ?>
                                                                <a href="challenges_1.php?skill=<?php echo $skill; ?>"><button class="challenge-button">Start Challenge</button></a>
                                                                <?php } else { ?>
                                                                <button class="challenge-button" onclick="alert('Challenge 1 already completed!')">Challenge 1 Completed</button>
                                                                <?php }
                                                        } else { ?>
                                                                <a href="Login/Login.php"><button class="challenge-button">Login First</button></a>
                                                        <?php } ?>

                                                
                                                        
                                                               
                                                </div>

                                              

                                        </div>

                                        <div class ="badge-container">
                                                <div class ="image-container">
                                                        <img src="Image/Challenge Box 2.png" class ="challenge-image" alt="No. 1 Badge">
                                                </div>

                                                <div class ="text-container">
                                                        <p class ="badge-title">Test</p> <br>
                                                        <p class ="badge-desc">The second challenge involves a knowledge assessment through a series of Multiple-Choice Questions (MCQs). Participants test their understanding of the theoretical concepts introduced in Challenge 1, demonstrating their grasp of key <?php echo $data ['name'] ?> principles.</p>
                                                        <?php if (isset($_SESSION["username"])) {
                                                                if (!$challenge2Completed) { ?>
                                                                <a href="challenges_2.php?skill=<?php echo $skill; ?>"><button class="challenge-button">Start Challenge</button></a>
                                                                <?php } else { ?>
                                                                <button class="challenge-button" onclick="alert('Challenge 2 already completed!')">Challenge 2 Completed</button>
                                                                <?php }
                                                        } else { ?>
                                                                <a href="Login/Login.php"><button class="challenge-button">Login First</button></a>
                                                        <?php } ?>
                                                       
                                                </div>

                                        </div>

                                        <div class ="badge-container">
                                                <div class ="image-container">
                                                        <img src="Image/Challenge Box 3.png" class ="challenge-image" alt="No. 1 Badge">
                                                </div>

                                                <div class ="text-container">
                                                        <p class ="badge-title">Pratical</p> <br>
                                                        <p class ="badge-desc">The practical challenge is designed for participants to translate their theoretical understanding into practical application. Participants engage in real-world scenarios, exercises, or simulations that mirror situations where <?php echo $data ['name'] ?> are essential. This hands-on approach aims to reinforce the practical application of learned soft skills.</p>
                                                        <?php if (isset($_SESSION["username"])) {
                                                                if (!$challenge3Completed) { ?>
                                                                <a href="challenges_3.php?skill=<?php echo $skill; ?>"><button class="challenge-button">Start Challenge</button></a>
                                                                <?php } else { ?>
                                                                <button class="challenge-button" onclick="alert('Challenge 3 already completed!')">Challenge 3 Completed</button>
                                                                <?php }
                                                        } else { ?>
                                                                <a href="Login/Login.php"><button class="challenge-button">Login First</button></a>
                                                        <?php } ?>
                                                </div>

                                        </div>



                                </div>


                        </div>

                </section>
</div>

        
                        
</body>

</html>



