<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once('db_connect.php');
require_once('Part/header.php');
require_once('logic_controller.php');
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
                                        <h2>Unlock Your Potential: <br>Soft Skills Mastery Journey </h2>
                                        <p> Embark on a transformative journey of self-discovery and skill enhancement with our innovative soft skills development platform. Dive into interactive modules, engage in practical tasks, and earn badges as you level up your expertise. Join a community of learners, track your progress, and discover the power of combining professionalism with the fun of gamified learning. Your journey to unlocking a new realm of possibilities starts here. </p>
                                        

                                        <div class="cta">
                                                <?php

                                                        session_start();

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


                
                        

     

                        
</body>

</html>

