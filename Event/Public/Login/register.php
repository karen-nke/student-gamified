<?php

include 'config.php';

error_reporting(0);

session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = trim($_POST['email']);
    $password = md5($_POST['password']);
    $confirmpassword = md5($_POST['confirmpassword']);

    if ($password == $confirmpassword) {
        $sql = "SELECT * FROM users WHERE email='" . $email . "'";
        $sql2 = "SELECT * FROM users WHERE username='" . $username . "'";
        $result = mysqli_query($conn, $sql);
        $result2 = mysqli_query($conn, $sql2);

       if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Email Already Exists.')</script>";
        } else if (mysqli_num_rows($result2) > 0) {
            echo "<script>alert('Username Already Exists.')</script>";
        } else {
            $sql = "INSERT INTO users (username, email, password)
                        VALUES ('$username', '$email', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Succesfully Registered')</script>";
                $username = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['confirmpassword'] = "";
            } else {
                echo "<script>alert('Something went wrong.')</script>";
            }
        }
    } else {
        echo "<script>alert('Password Not Matched.')</script>";
    }
}
?>

<script>
    function validate(form){
        fail = validateUsername(form.username.value)
        fail += validateEmail(form.email.value)
        fail += validatePassword(form.password.value)

        if(fail=="") return true //if empty string, return true = pass validation
        else {alert(fail); return false}

       
    }


    function validateUsername(field){
        if(field == "") return "No Username was entered.\n"
        else if (field.length <5) return "Username must be at least 5 characters.\n"
        else if (/[^a-zA-Z0-9_-]/.test(field)) return "Only Alphabet & Numbers are allowed in the username.\n"
        return ""

    }

    function validatePassword(field){
        if(field=="") return "No Password Entered.\\n"
        else if (field.length < 8) return "Password must be at least 8 characters.\n"
        else if (!/[a-z]/.test(field) || !/[A-Z]/.test(field) || !/[0-9]/.test(field)) return "Password must require at least one uppercase, one lowercase and one number\n." 
        return ""
    }

    function validateEmail(field){
        if (field=="") return "No Email Entered.\n"
        else if (!((field.indexOf(".")>0) && (field.indexOf("@")>0)) || /[^a-zA-Z0-9.@_-]/.test(field)) return "The Email Address is invalid.\n"
        return""
    }

</script>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7
.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="login_style.css">

    <title>Register</title>
</head>

<body>
    <div class="container">

        <div class="logo">
            <a href="index.php"><img src="../Image/PopHolic_Logo.png" width="200px"></a>
        </div>


        <form action="register.php" method="POST" class="login-email" onSubmit ="return validate(this)">
            <p class="login-text" style='font-size:2rem; font-weight:800;'>Register</p>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
            </div>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="input-group">
            <input type="password" placeholder="Password" name="password" id="password" value="<?php echo $_POST['password']; ?>" required oninput="onPasswordInput()">

            </div>
            <div id="password-feedback"></div>
            <div class="input-group-cb">
                <input type="checkbox" onclick="togglePassword()"> Show Password   
            </div>
            <div class="input-group">
                <input type="password" placeholder="Confirm Password" name="confirmpassword" value="<?php echo $_POST['confirmpassword'] ?>" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Register</button>
            </div>
            <p class="login-register-text">Already have account? <a href="login.php"><br>Login Here.</a></p>
        </form>

        <script>
            function togglePassword() {
                var passwordField = document.getElementById("password");
                if (passwordField.type === "password") {
                    passwordField.type = "text";
                } else {
                    passwordField.type = "password";
                }
            }

            function validatePassword(field) {
        var feedbackElement = document.getElementById("password-feedback");
        if (field == "") {
            feedbackElement.innerHTML = "No Password Entered.";
            feedbackElement.style.color = "red";
            return false;
        } else if (field.length < 8) {
            feedbackElement.innerHTML = "Password must be at least 8 characters.";
            feedbackElement.style.color = "red";
            return false;
        } else if (!/[a-z]/.test(field) || !/[A-Z]/.test(field) || !/[0-9]/.test(field)) {
            feedbackElement.innerHTML = "Password must require at least one uppercase, one lowercase, and one number.";
            feedbackElement.style.color = "red";
            return false;
        } else {
            feedbackElement.innerHTML = "Password is valid.";
            feedbackElement.style.color = "green";
            return true;
        }
    }

    function onPasswordInput() {
        var passwordField = document.getElementById("password");
        validatePassword(passwordField.value);
    }

    function togglePassword() {
        var passwordField = document.getElementById("password");
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
        </script>





    </div>
   
</body>

</html>