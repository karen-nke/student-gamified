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
        <?php session_start(); ?>

        <?php require_once 'Part/header.php' ?>

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
                line-height: 18px;
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
            <img src="Image/Leaderboard_Icon.png" style="width:200px;height:250px;" class="logo-centered"></a>
            <h2 class="title">Awards</h2>

            <div class="box-container">
                <p class="title">Badges to be Earned</p>
                <div class ="badge-container">
                    <div class ="image-container">
                        <img src="Image/Leadership_Locked.png" class ="image" alt="No. 1 Badge">
                    </div>

                    <div class ="text-container">
                        <p class ="badge-title">Leadership Completion Badge</p> <br>
                        <p class ="badge-desc">Complete Leadership Module to Receive <br> Leadership Completion Badge.</p>
                    
                    </div>

                </div>

                <div class ="badge-container">
                    <div class ="image-container">
                        <img src="Image/Communication_Locked.png" class ="image" alt="No. 1 Badge">
                    </div>

                    <div class ="text-container">
                        <p class ="badge-title">Leadership Completion Badge</p> <br>
                        <p class ="badge-desc">Complete Leadership Module to Receive <br> Leadership Completion Badge.</p>
                    
                    </div>

                </div>

                <div class ="badge-container">
                    <div class ="image-container">
                        <img src="Image/Teamwork_Locked.png" class ="image" alt="No. 1 Badge">
                    </div>

                    <div class ="text-container">
                        <p class ="badge-title">Leadership Completion Badge</p> <br>
                        <p class ="badge-desc">Complete Leadership Module to Receive <br> Leadership Completion Badge.</p>
                    
                    </div>

                </div>
                



            </div>
        </div>






                
                        

     

                        
</body>

</html>

