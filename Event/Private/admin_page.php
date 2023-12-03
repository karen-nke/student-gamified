<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
require_once('../Public/db_connect.php');
require_once('Part/header.php');
require_once('logic_controller.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <title>Admin Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Public/public.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
        <div class ="page-container">
       
               <div class ="container">
                        <h2 class="title"><br>Admin Control Panel</h2>
               </div>

               <div class ="box-container">
                        <p> User Control </p>
                        <button class="btn"><a href="user_edit.php">Edit or Delete User</a> </button>


               </div>

               <div class ="box-container">
                        <p> Module Control </p>
                        <button class="btn"><a href="module_edit.php">Edit Module</a> </button>
                        <button class="btn"><a href="module_add.php">Add Module</a> </button>


               </div>
        </div>

                
                        

     

                        
</body>

</html>

