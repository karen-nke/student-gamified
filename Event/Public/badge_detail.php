<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once('db_connect.php');
require_once('Part/header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <title>Badges Details</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

        <style>

            .box-container{
                width: 100%;
                height: auto; 
                background: white; 
                border: 2px #E87A00 solid;
                padding:50px;
                position: relative;
                margin: 50px;
                justify-content: space-between;

            }

            .box-container .badge-container{
                width: 100%;
                height: auto;
                display:flex;
                padding:50px;
            }

            .box-container .image-container{
                width: 50%;
                text-align: center;
            }
            .image {
                max-width: 100%;
                height: auto;
            }

            .box-container .text-container {
                width: 50%;
                padding-top: 120px;
                top: 50%

            }

            .box-container .badge-title{
                color: #E87A00;
                font-size: 32px;
                font-weight: 700;
                line-height: 42px;
;
                
            }

            .box-container .badge-desc{
                color: #045174;
                font-size: 18px;
                font-weight: 400;
                line-height: 30px;

            }
            .box-container .title{
                margin: 0;
                position: absolute;
                top: 20px;
                left: 20px;
                color: #E87A00;
                font-size: 24px;
                font-family: 'Poppins', sans-serif;
                font-weight: 500;
            }
                
        </style>

        <div class ="container">
            <img src="Image/Rewards_Icon.png" style="width:200px;height:250px;" class="logo-centered"></a>
            <h2 class="title">Awards</h2>

            <div class="box-container">
                <p class="title">Badges to be Earned</p>
                <div class ="badge-container">
                    <div class ="image-container">
                        <img src="Image/Leadership_Unlocked.png" class ="image" alt="Leadership Badge">
                    </div>

                    <div class ="text-container">
                        <p class ="badge-title">Leadership Completion Badge</p> <br>
                        <p class ="badge-desc">Complete Leadership Module to Receive <br> Leadership Completion Badge.</p>
                    
                    </div>

                </div>

                <div class ="badge-container">
                    <div class ="image-container">
                        <img src="Image/Communication_Unlocked.png" class ="image" alt="Communication Badge">
                    </div>

                    <div class ="text-container">
                        <p class ="badge-title">Communication Completion Badge</p> <br>
                        <p class ="badge-desc">Complete Communication Module to Receive <br> Communication Completion Badge.</p>
                    
                    </div>

                </div>

                <div class ="badge-container">
                    <div class ="image-container">
                        <img src="Image/Teamwork_Unlocked.png" class ="image" alt="Teamwork Badge">
                    </div>

                    <div class ="text-container">
                        <p class ="badge-title">Teamwork Completion Badge</p> <br>
                        <p class ="badge-desc">Complete Teamwork Module to Receive <br> Teamwork Completion Badge.</p>
                    
                    </div>

                </div>
                



            </div>

            <div class="box-container">
                <p class="title">Acheivement to be Earned</p>
                <div class ="badge-container">
                    <div class ="image-container">
                        <img src="Image/Points_Unlocked.png" class ="image" alt="Points Badge">
                    </div>

                    <div class ="text-container">
                        <p class ="badge-title">Point Pioneer</p> <br>
                        <p class ="badge-desc">Forge your path to success! To become a "Point Pioneer," earn your first point. Engage with tasks, quizzes, and events to accumulate points and showcase your commitment to growth.</p>
                    
                    </div>

                </div>

                <div class ="badge-container">
                    <div class ="image-container">
                        <img src="Image/Module_Unlocked.png" class ="image" alt="Module Badge">
                    </div>

                    <div class ="text-container">
                        <p class ="badge-title">Module Explorer</p> <br>
                        <p class ="badge-desc">Begin your soft skills adventure! To earn the "Module Explorer" achievement, start your first module. Navigate through the tasks and unlock the secrets of effective soft skills development.</p>
                    
                    </div>

                </div>

                <div class ="badge-container">
                    <div class ="image-container">
                        <img src="Image/Complete_Unlocked.png" class ="image" alt="Completion Badge">
                    </div>

                    <div class ="text-container">
                        <p class ="badge-title">Module Master</p> <br>
                        <p class ="badge-desc">Master the modules! To achieve "Module Master" status, complete your first module. Conquer the tasks, absorb the knowledge, and emerge as a well-rounded soft skills enthusiast.</p>
                    
                    </div>

                </div>

                <div class ="badge-container">
                    <div class ="image-container">
                        <img src="Image/Rank_Unlocked.png" class ="image" alt="Rank Badge">
                    </div>

                    <div class ="text-container">
                        <p class ="badge-title">Lead Voyager</p> <br>
                        <p class ="badge-desc">Set sail to leadership excellence! To become a "Leadership Voyager," reach the top spot on the Leadership Board. Showcase your outstanding leadership skills and inspire others on your journey.</p>
                    
                    </div>

                </div>

                <div class ="badge-container">
                    <div class ="image-container">
                        <img src="Image/Event_Unlocked.png" class ="image" alt="Event Badge">
                    </div>

                    <div class ="text-container">
                        <p class ="badge-title">Socialite Elite</p> <br>
                        <p class ="badge-desc">Step into the spotlight of social engagement with the "Socialite Elite" badge. This achievement awaits users who submit their very first event participation.</p>
                    
                    </div>

                </div>

                <div class ="badge-container">
                    <div class ="image-container">
                        <img src="Image/Lvl1_Unlocked.png" class ="image" alt="Level 1 Badge">
                    </div>

                    <div class ="text-container">
                        <p class ="badge-title">Skill Apprentice (Level 1)</p> <br>
                        <p class ="badge-desc">To earn the "Skill Apprentice" achievement, reach Level 1. Embrace the learning process, accumulate points, and steadily progress on your way to mastery.</p>
                    
                    </div>

                </div>

                <div class ="badge-container">
                    <div class ="image-container">
                        <img src="Image/Lvl5_Unlocked.png" class ="image" alt="Level 5 Badge">
                    </div>

                    <div class ="text-container">
                        <p class ="badge-title">Skill Sage (Level 5)</p> <br>
                        <p class ="badge-desc">To become a "Skill Sage," reach Level 5. Your dedication and continuous improvement have elevated you to the highest echelons of soft skills expertise.</p>
                    
                    </div>

                </div>
            
            </div>

            <button class="btn"><a href="account.php">Back to Account</a></button>
        </div>
                        
</body>

</html>

