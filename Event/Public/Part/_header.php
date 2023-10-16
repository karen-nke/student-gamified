<div class="topnav">
     
        <!-- Right-aligned links -->
        <div class="topnav-right">
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






<div class="container">
        <a href="index.php"><img src="Image/PopHolic_Logo.png" style="width:200px;height:200px;" class="logo-centered"></a>



        <hr>

        <div class="navbar">
                <a href="index.php">Home</a>
                <div class="dropdown">
                        <button class="dropbtn">Product
                                <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                                <a href="funko_page.php?type=all">Funko Pop</a>
                                <a href="banpresto_page.php?type=all">Banpresto</a>
                        </div>
                </div>
                <a href="about_us.php">About Us</a>
                <a href="contact_us.php">Contact Us</a>
                <a href="faq.php">FAQs</a>

                <div class="dropdown">
                        <button class="dropbtn">Other
                                <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                                <a href="Q&A.php">Q&A</a>
                                <a href="testimonial.php">Review</a>
                                
                        </div>
                </div>
        

        </div>


        <hr>

</div>