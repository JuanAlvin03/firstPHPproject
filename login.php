<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<!-- CSS -->
<link rel="stylesheet" href="css/login-style.css"> 
<body>
<div class="login-page">
    <div class="form">
        
        <form class="register-form" method="POST" id="register-form" action="cek-login.php">
            <span><b>REGISTER</b></span><br><br>
            <input type="text" placeholder="Username" name="username">
            <input type="password" placeholder="Password" name="password">
            <button type="submit" value="register" name="btnSubmit"><b>create</b></button>
            <p class="message">Already registered? <a href="#" onclick="toLogin()">Sign In</a></p>
        </form>
        
        <form class="login-form" method="POST" id="login-form" action="cek-login.php">
            <span><b>LOGIN</b></span><br><br>
            <input type="text" placeholder="Username" name="username">
            <input type="password" placeholder="Password" name="password">
            <button type="submit" value="login" name="btnSubmit"><b>login</b></button>
            <p class="message">Not registered? <a href="#" onclick="toReg()">Create an account</a></p>
        </form>
    </div>
</div>

<!-- JS -->
<script src="login-script.js"></script>
</body>
</html>