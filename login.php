<!DOCTYPE html >
<html>
<head>
    <title>Login</title>
</head>
<link rel="stylesheet" type="text/css" href="styles/formStyles.css">
<style>
    body {
        margin-right: 60%;
        background-color: rgb(52, 160, 156);
        background-image: url("imgs/XO.jpg");
        background-repeat: no-repeat;
        background-position: right top;
        background-size: 46%;
    }
</style>
<body id="body_login">

<form id="login-form" method="post" action="authen_login.php" >
    <div class="head" align="center">
        <h2>Login</h2>
    </div>
    <div class="imgcontainer">
        <img src="imgs/loginPic.jpg" alt="Avatar" class="avatar">
    </div>

    <div class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="user_id" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="user_pass" required>

        <button type="submit" >Login</button>
    </div>
    <div align="center">
        <p>No account? <a href="registration.php">Register Here</a>.</p>
    </div>
</form>
</body>
</html>