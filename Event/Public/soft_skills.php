<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once('db_connect.php');
require_once('Part/header.php');
require_once('logic_controller.php');

$skill = $_GET['skill'];

$data = getSoftSkillData($conn, $skill);

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
                                                        <a href = "challenges_1.php?skill=<?php echo $skill; ?>"><button class ="challenge-button">Start Challenge</button></a>
                                                               
                                                </div>

                                              

                                        </div>

                                        <div class ="badge-container">
                                                <div class ="image-container">
                                                        <img src="Image/Challenge Box 2.png" class ="challenge-image" alt="No. 1 Badge">
                                                </div>

                                                <div class ="text-container">
                                                        <p class ="badge-title">Test</p> <br>
                                                        <p class ="badge-desc">The second challenge involves a knowledge assessment through a series of Multiple-Choice Questions (MCQs). Participants test their understanding of the theoretical concepts introduced in Challenge 1, demonstrating their grasp of key <?php echo $data ['name'] ?> principles.</p>
                                                        <a href = "challenges_2.php?skill=<?php echo $skill; ?>"><button class ="challenge-button">Start Challenge</button></a>
                                                </div>

                                        </div>

                                        <div class ="badge-container">
                                                <div class ="image-container">
                                                        <img src="Image/Challenge Box 3.png" class ="challenge-image" alt="No. 1 Badge">
                                                </div>

                                                <div class ="text-container">
                                                        <p class ="badge-title">Pratical</p> <br>
                                                        <p class ="badge-desc">The practical challenge is designed for participants to translate their theoretical understanding into practical application. Participants engage in real-world scenarios, exercises, or simulations that mirror situations where <?php echo $data ['name'] ?> are essential. This hands-on approach aims to reinforce the practical application of learned soft skills.</p>
                                                        <a href = "challenges_3.php?skill=<?php echo $skill; ?>"><button class ="challenge-button">Start Challenge</button></a>
                                                </div>

                                        </div>



                                </div>


                        </div>

                </section>
</div>

        
                        
</body>

</html>



