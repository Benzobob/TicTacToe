<!DOCTYPE html >
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body id="body_reg">
<div align="center">
    <h1>Registration Page</h1>
    <form id="reg-form" method="post" action="registerUser.php" >
        <table border="0.8" >
            <tr>
                <td><label for="name"><b>First name</b></label></td>
                <td><input type="text" placeholder="Name" name="name" required></td>
            </tr>
            <tr>
                <td><label for="surname"><b>Surname</b></label></td>
                <td><input type="text" placeholder="Surname" name="surname" required></td>
            </tr>
            <tr>
                <td><label for="username"><b>Username</b></label></td>
                <td><input type="text" placeholder="username" name="username" required></td>
            </tr>
            <tr>
                <td><label for="password"><b>Password</b></label></td>
                <td><input type="password" placeholder="Password" name="password" required></td>
            </tr>
            <tr>
                <td><label for="psw1"><b>Re-type Password</b></label></td>
                <td><input type="password" placeholder="Re-type Password" name="psw-repeat" required></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="registerbtn">Register</button></td>
            </tr>
        </table>
    </form>
</div>

<div align="center">
    <p>Already have an account? <a href="login.php">Login Here</a>.</p>
</div>
</body>
</html>