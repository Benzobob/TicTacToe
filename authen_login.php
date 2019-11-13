<?php
include_once 'WebServiceClient.php';
$username = $_POST["user_id"];
$password = $_POST["user_pass"];

//Call the web service 'login' method
$result = $client->login(array("username" => $username, "password" => $password));

/* Check if login details are valid. If not, output an error and refresh login page.
 * If details are correct, then print success message and load dashboard page. */
if($result->return == 0){
    echo "<div class='alert alert-info'>";
    echo 'Incorrect Username or Password. <meta http-equiv="refresh" content="2; url=login.php">';
    echo "</div>";
}
else if($result->return == -1){
    echo "<div class='alert alert-info'>";
    echo 'Login Error. <meta http-equiv="refresh" content="2; url=login.php">';
    echo "</div>";
}
else if($result->return > 0){
    echo "<div class='alert alert-info'>";
    echo 'Successfully logged in. <meta http-equiv="refresh" content="2; url=dashboard.php">';
    echo "</div>";
}
?>
