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

?>


<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <title>Home Page</title>
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
                                                <h2>Unlock Your Potential: <br>Soft Skills Mastery Journey </h2>
                                                <p> Embark on a transformative journey of self-discovery and skill enhancement with our innovative soft skills development platform. Dive into interactive modules, engage in practical tasks, and earn badges as you level up your expertise. Join a community of learners, track your progress, and discover the power of combining professionalism with the fun of gamified learning. Your journey to unlocking a new realm of possibilities starts here. </p>
                                                

                                                <div class="cta">
                                                        <?php

                                                        

                                                                if (isset($_SESSION['username'])) {

                                                                        echo "
                                                                        <a href=\"account.php\">Account</a>
                                                                        <a href=\"Login/logout.php\">Logout</a>





                                                                ";
                                                                } else {

                                                                        echo "
                                                                        <a href=\"Login/login.php\">Login</a>
                                                                        <a href=\"Login/register.php\">Register</a>

                                                                ";
                                                                }


                                                        ?>
                                                        
                                                </div>
                                        </div>  

                                        

                                        <img src="Image/Home_Banner.png" />
                                        
                                </div>

                                


                        </div>

                </section>

                <div class ="section-container">
                        <h2>Benefit of Program</h2>
                        <div class="card-container">

                  
                                <div class="event-card">
                                        <img src="Image/PointLevel_Icon.png" alt="Event Image">
                                        <h2>Earn Points & Up Level</h2>
                                        <p>Complete Tasks & Activities to earn Points and Level Up your Account.</p>
                                                
                                </div>

              
         
                                <div class="event-card">
                                        <img src="Image/Rewards_Icon.png" alt="Event Image">
                                        <h2>Earn Badges</h2>
                                        <p>Earn badges by completing different task and challenges.</p>
                                       
                                </div>

  

              
                                <div class="event-card">
                                        <img src="Image/Leaderboard_Icon2.png" alt="Event Image">
                                        <h2>Leaderboard</h2>
                                        <p>Compete with your peers and reach to the top of the Leaderboard</p>
                                        
                                </div>

                               
                        </div>
                </div>

                <div class ="section-container">
                        <h2>Get Started</h2>
                        <div class="card-container">

                                <a href="soft_skills.php?skill=leadership">
                                        <div class="event-card">
                                                <img src="Image/Leadership_Icon.png" alt="Event Image">
                                                <h2>Leadership</h2>
                                                        
                                        </div>

                                </a>
                                <a href="soft_skills.php?skill=communication">
                                        <div class="event-card">
                                                <img src="Image/Communication_Icon.png" alt="Event Image">
                                                <h2>Communication</h2>
                                                
                                        </div>

                                </a>

                                <a href="soft_skills.php?skill=teamwork">
                                        <div class="event-card">
                                                <img src="Image/Teamwork_Icon.png" alt="Event Image">
                                                <h2>Teamwork</h2>
                                                
                                        </div>

                                </a>

                     
                               
                               

                              

                               

                               
                        </div>
                </div>
        </div>

                
                        

     

                        
</body>

</html>

<style>


</style>
