
<div class="navbar">
    <div class="menu-item">
        <div class ="menu">
            <a href="index.php">Home</a>
            <a href="event.php">Events</a>
            <div class="dropdown">
                        <button class="dropbtn">Module
                                <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                                <a href="funko_page.php">Leadership</a>
                                <a href="banpresto_page.php">Communication</a>
                                <a href="banpresto_page.php">Teamwork</a>
                        </div>
                </div>

            <a href="index.php">Leaderboard</a>
          
        
        </div>

        <?php

                session_start();

                if (isset($_SESSION['username'])) {
                    
                        echo "
                        <button class=\"login-button\"><a href=\"account.php\">Account</a></button>
                        <button class=\"register-button\"><a href=\"Login/logout.php\">Logout</a></button>
                

                     

                
                ";
                } else {

                        echo "
                        <button class=\"login-button\"><a href=\"Login/login.php\">Login</a></button>
                        <button class=\"register-button\"><a href=\"Login/register.php\">Register</a></button>
                    
                ";
                }


                ?>
      
    </div>
    <img src="../Image/Logo.png" />
</div>



<section class="hero">
    <div class ="container">
        <div class="mid">
            <div class="desc">
                <h2>Unlock Your Potential: <br>Soft Skills Mastery Journey </h2>
                <p> Embark on a transformative journey of self-discovery and skill enhancement with our innovative soft skills development platform. Dive into interactive modules, engage in practical tasks, and earn badges as you level up your expertise. Join a community of learners, track your progress, and discover the power of combining professionalism with the fun of gamified learning. Your journey to unlocking a new realm of possibilities starts here. </p>
                
                <div class="cta">
                        <a href="Login/login.php">Login</a>
                        <a href="Login/logout.php">Logout</a>

                </div>
            </div>  

          

            <img src="../Image/Home_Banner.png" />
          
        </div>


    </div>

</section>

<section class = "benefit">
    <div class="container">
        <h3>Benefit of Program</h3>

        <div class = "row">

            <div class ="column">
                <p>hello</p>

            </div>

            <div class ="column">
                <p>hello</p>

            </div>

            <div class ="column">
                <p>hello</p>

            </div>

        </div>

       

       


                              
    </div>

</section>


<style>

    .benefit .container{
        width: 100%; 
        height: 1%; 
        position: relative

    }

    .benefit .container h3{

        text-align: center; 
        color: #E87A00; 
        font-size: 32px; 
        font-family: 'Poppins', sans-serif;  
        font-weight: 700; 
        line-height: 46px;

    }

    .benefit .container .row {

        width: 1000px;
        height: 500px;
        margin: 25px;

    }


    .benefit .container .column{
       

        float: left;
        width: 250px;
        padding: 50px;
        min-width: 200px;
        margin-bottom: 50px;
        transition: transform 0.5s;

    }


    

    .hero{
        width: 100%;
        height: 800px;
        background-color:#FFF;
        position:relative;
        padding-top: 50px;
    }

    .hero-container{
        height: 100%;
        position: relative;
    }

    .hero .mid{
        padding: 0 2%;
        display: flex;
        flex-wrap; wrap;
        align-items: center;
        justify-content: space-between;

    }

    .hero .mid{
        padding-right:50px;
        display: flex;
        flex-wrap; wrap;
        align-items: center;
        justify-content: space-between;

    }

    .hero .mid .desc{
       width: 40%;
       margin-left: 250px;
    
    }

    .hero .mid .desc .cta {
        margin-top: 50px;

    }

    .hero .mid .desc .cta a{
       font-weight: 600;
       padding: 25px 80px;
       border: 2px solid #E87A00;
       border-radius: 25px;
       transition-duration: .3s;
       transition-property: background-color, border;
       text-decoration: none;
       color: #E87A00;
    }


    .hero .mid .desc .cta a:first-child{
      background-color: #E87A00;
      color: #FFF;
      margin: 0 15px 10px 0;

    }

    .hero .mid .desc .cta a:first-child:hover{
      background-color: #D89C60;
      border: 2px solid #D89C60;

    }

    .hero .mid img{
      
       margin-right: 200px;

    }



    .hero .mid .desc h2{
        font-size: 42px;
        font-family: 'Poppins', sans-serif;
        font-weight: 700; 
        line-height: 64px;
        color: #E87A00;
        margin-bottom: 50px;
    }

    .hero .mid .desc p{
        color: #045174; 
        font-size: 18px; 
        font-family: 'Poppins', sans-serif; 
        font-weight: 400; 
        line-height: 25.20px;
        margin-bottom: 50px;
    }





    /* Banner */
    .banner-container{
    
        height: 799px; 
        padding: 80px; 
        background: white; 
        align-items: center; 

    }

    .banner-container img{
        width: 754px; height: 725px; left: 613px; top: 41px; position: absolute
    }

    /* Navigation Bar */

    .navbar{
        width: 100%; 
        height: 120px; 
        background-color:#FFF;
        padding: 20px;
    }

    .menu-item {

        align-items: center;
        gap: 24px;
        display: inline-flex;
        float: right;
        padding-right: 100px;


    }


    .menu{
        justify-content: flex-end; 
        align-items: center; 
        gap: 33px; 
        display: flex

    }

    .menu a{
        text-align: center; color: #001F3D; font-size: 18px; font-family: Poppins; font-weight: 400; line-height: 18px; word-wrap: break-word; text-decoration: none;

    }

    .navbar .img{
        width: 93px; 
        height: 93px;
        float: left;
        position:absolute;

    }

    .login-button{
        padding-left: 24px; 
        padding-right: 24px; 
        padding-top: 18px; 
        padding-bottom: 18px; 
        background: white; 
        border-radius: 30px; 
        border: 1px #E87A00 solid; 
        justify-content: flex-end; 
        align-items: center; 
        gap: 8px; 
        display: flex

    }

    .login-button a{
        text-align: center; 
        color: #001F3D; 
        font-size: 16px; 
        font-family: 'Poppins', sans-serif; 
        font-weight: 400; 
        line-height: 18px; 
        word-wrap: break-word;
        text-decoration: none;

    }

    .register-button{
        padding-left: 24px; padding-right: 24px; padding-top: 18px; padding-bottom: 18px; background: #001F3D; border-radius: 30px; justify-content: flex-end; align-items: center; gap: 8px; display: flex;
    }

    .register-button a{
        text-align: center; 
        color: white; 
        font-size: 16px; 
        font-family: 'Poppins', sans-serif; 
        font-weight: 500; 
        line-height: 18px; 
        word-wrap: break-word;
        text-decoration: none;

    }

      /* The dropdown container */
  .dropdown{
    float: left;
    overflow: hidden;
  
  }
  
  /* Dropdown button */
  .dropdown .dropbtn {
      font-size: 16px; 
      border: none;
      outline: none;
      color: #001F3D;
      padding: 14px 16px;
      background-color: inherit;
      font-family: inherit; /* Important for vertical align on mobile phones */
      margin: 0; /* Important for vertical align on mobile phones */
    }
  
  
    
    /* Dropdown content (hidden by default) */
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #fff;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }
    
    /* Links inside the dropdown */
    .dropdown-content a {
      float: none;
      color: #001F3D;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      text-align: left;
    }
    
    /* Add a grey background color to dropdown links on hover */
    .dropdown-content a:hover {
      background-color: #fff;
    }
    
    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {
      display: block;
    }

    .navbar a:hover, .dropdown:hover .dropbtn {
      color: #E87A00;
          
   }
  
  

  
</style>
