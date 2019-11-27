<!DOCTYPE html >
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="styles/formStyles.css">
</head>
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

<body id="body_reg">
<form id="reg-form" method="post" action="registerUser.php" >
    <div class="head" align="center">
        <h2>Register</h2>
    </div>
    <div class="container">
        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Enter Name" name="name" required>

        <label for="surname"><b>Password</b></label>
        <input type="text" placeholder="Enter Surname" name="surname" required>

        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <label for="psw1"><b>Re-type Password</b></label>
        <input type="password" placeholder="Re-type Password" name="psw-repeat" required>

        <button type="submit" class="registerbtn">Register</button>
    </div>

</form>

<div align="center">
    <p>Already have an account? <a href="login.php">Login Here</a>.</p>
</div>
</body>
</html>