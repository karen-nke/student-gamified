<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once('db_connect.php');
require_once('Part/header.php');
require_once('logic_controller.php');

$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];

$soft_skill_id = 1; // You need to implement a function like getSoftSkillId

// Check if the challenge is already completed
$completion_query = "SELECT * FROM user_soft_skill_progress WHERE user_id = ? AND soft_skill_id = ? AND challenge_number = ?";
$completion_stmt = $conn->prepare($completion_query);
$completion_stmt->bind_param("iii", $user_id, $soft_skill_id, $challenge_number);
$completion_stmt->execute();
$completion_result = $completion_stmt->get_result();
$challenge_completed = $completion_result->num_rows > 0;

$completion_stmt->close();


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

<body>


       
                <section class="hero">
                        <div class ="container">
                                <div class="mid">
                                        <div class="desc">
                                                <h2>Leaderships</h2>
                                                <p> The ability to influence and inspire a group of individuals towards a common goal or purpose. Effective leadership involves making informed and strategic decisions, fostering collaboration, and motivating team members to perform at their best. <br> <br> A leader serves as a role model, guiding others by demonstrating integrity and a strong work ethic. Whether in the context of an organization, government, educational institution, or any collective effort, leadership plays a pivotal role in driving positive change and achieving shared objectives.</p>
                                        </div>  

                                        

                                        <img src="Image/Leadership_Icon.png" />
                                
                                </div>

                                <div class="box-container">
                                        <p class="title">Completion Reward</p>
                                        <div class ="badge-container">
                                                <div class ="image-container">
                                                        <img src="Image/Points_Icon.png" class ="image" alt="No. 1 Badge">
                                                </div>

                                                <div class ="text-container">
                                                        <p class ="badge-title">1. Complete Challenges to earn points</p> <br>
                                                        <p class ="badge-desc">Lorem ipsum dolor sit amet consecte tur adipiscing elit semper dalaracc lacus vel facilisis volutpat est velitolm.</p>
                                                       
                                                
                                                </div>

                                        </div>

                                        <div class ="badge-container">
                                                <div class ="image-container">
                                                        <img src="Image/Leadership_Unlocked.png" class ="image" alt="No. 1 Badge">
                                                </div>

                                                <div class ="text-container">
                                                        <p class ="badge-title">2. Complete module to earn badge</p> <br>
                                                        <p class ="badge-desc">Lorem ipsum dolor sit amet consecte tur adipiscing elit semper dalaracc lacus vel facilisis volutpat est velitolm.</p>
                                                
                                                </div>

                                        </div>


                                </div>

                                <div class="box-container">
                                        <p class="title">Challenges</p>
                                        <div class ="badge-container">
                                                <div class ="image-container">
                                                        <img src="Image/Challenge Box 1.png" class ="image" alt="No. 1 Badge">
                                                        
                                                </div>

                                                <div class ="text-container">
                                                        <p class ="badge-title">Theory</p> <br>
                                                        <p class ="badge-desc">Lorem ipsum dolor sit amet consecte tur adipiscing elit semper dalaracc lacus vel facilisis volutpat est velitolm.</p>
                                                                <?php
                                                        // Display the "Start Challenge" button only if the challenge is not completed
                                                                if (!$challenge_completed) {
                                                                echo '<button onclick="startChallenge()">Start Challenge</button>';
                                                                }
                                                                ?>
                                                </div>

                                                <script>
                                                function startChallenge() {
                                                // Add logic to navigate to the challenge page (e.g., leadership_challenge.php)
                                                window.location.href = 'challenge_1.php';
                                                }
                                                </script>

                                        </div>

                                        <div class ="badge-container">
                                                <div class ="image-container">
                                                        <img src="Image/Challenge Box 2.png" class ="image" alt="No. 1 Badge">
                                                </div>

                                                <div class ="text-container">
                                                        <p class ="badge-title">Test</p> <br>
                                                        <p class ="badge-desc">Lorem ipsum dolor sit amet consecte tur adipiscing elit semper dalaracc lacus vel facilisis volutpat est velitolm.</p>
                                                        <button>Start Challenge</button>
                                                </div>

                                        </div>

                                        <div class ="badge-container">
                                                <div class ="image-container">
                                                        <img src="Image/Challenge Box 1.png" class ="image" alt="No. 1 Badge">
                                                </div>

                                                <div class ="text-container">
                                                        <p class ="badge-title">Pratical</p> <br>
                                                        <p class ="badge-desc">Lorem ipsum dolor sit amet consecte tur adipiscing elit semper dalaracc lacus vel facilisis volutpat est velitolm.</p>
                                                        <button>Start Challenge</button>
                                                </div>

                                        </div>



                                </div>


                        </div>

                </section>


        
                        
</body>

</html>

