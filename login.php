<!DOCTYPE html >
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body id="body_login">
<div align="center">
    <h1>Login Page</h1>
    <form id="login-form" method="post" action="authen_login.php" >
        <table border="0.8" >
            <tr>
                <td><label for="user_id">Username</label></td>
                <td><input type="text" name="user_id" id="user_id" placeholder="Username"></td>
            </tr>
            <tr>
                <td><label for="user_pass">Password</label></td>
                <td><input type="password" name="user_pass" id="user_pass" placeholder="Password"></td>
            </tr>

            <tr>
                <td><input type="submit" value="Submit" />
                <td><input type="reset" value="Reset"/>
                <td><button><a href="registration.php"> Register</a></button>
            </tr>
        </table>
    </form>
</div>
</body>
</html>