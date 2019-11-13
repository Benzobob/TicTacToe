<?php
include_once 'WebServiceClient.php';
$username = $_POST["user_id"];
$password = $_POST["user_pass"];

$result = $client->login(array("username" => $username, "password" => $password));
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
    echo 'Successfully logged in. <meta http-equiv="refresh" content="2; url=mainPage.php">';
    echo "</div>";
}
?>
