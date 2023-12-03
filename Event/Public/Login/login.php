<?php


include 'config.php';


session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location:../index.php ");
}

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = md5($_POST['password']);

   

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        unset($row['password']);

        $_SESSION['user_id'] = $row['id'];
        
        $_SESSION['username'] = $row['username'];

        $_SESSION['last_acted_on'] = time();

        if($row ['user_role_id'] === "1"){
            header("Location: ../../Private/admin_page.php");
            $_SESSION['username'] = $row['username'];

        }else("Location:../index.php");
       
    } else {
        echo "<script>alert('Email or Password is Wrong.')</script>";
    } 
    

   
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7
.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="login_style.css">

    <title>Login</title>
</head>

<body>
    <div class="container">

        <div class="logo">
            <a href="../index.php"><img src="../Image/Login_Logo.png" width="200px"></a>
        </div>

        <form class="login-email" action="login.php" method="post">
            <p class="login-text" style='font-size:2rem; font-weight:800;'>Login</p>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
            </div>

            <div class="input-group">
                <input type="password" placeholder="Password" name="password" id="password" value="<?php echo $_POST['password']; ?>" required>
                <i class="fa fa-eye-slash password-toggle" onclick="togglePassword('password')"></i>
            </div>

            <div class="input-group">
                <button name="submit" class="btn">Login</button>
                
            </div>


            

            <p class="login-register-text">Don't have an account? <a href="register.php"><br>Click here to register.</a></p>
            <p class="login-register-text"><a href="../index.php">Back to Homepage.</a></p>
            






    </div>

    <script>
            function togglePassword(inputId) {
                const passwordInput = document.getElementById(inputId);
                const passwordToggle = document.querySelector(`#${inputId} ~ .password-toggle`);

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordToggle.classList.add('fa-eye');
                    passwordToggle.classList.remove('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    passwordToggle.classList.add('fa-eye-slash');
                    passwordToggle.classList.remove('fa-eye');
                }
            }
</script>
</body>

</html>

