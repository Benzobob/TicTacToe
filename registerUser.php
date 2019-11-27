<?php
include_once 'WebServiceClient.php';

/*
 * Call 'register' WS method and echo the result.
 * Re-direct user to login page if successful.
 */
$result = $client->register(array("username" => $_POST["username"], "password" => $_POST["password"], "name" => $_POST["name"], "surname" => $_POST["surname"]));

switch ($result->return){
    case "ERROR-REPEAT":
        echo"There has been an error: ERROR-REPEAT";
        break;
    case "ERROR-INSERT":
        echo "There has been an error: ERROR-INSERT";
        break;
    case "ERROR-RETRIEVE":
        echo "There has been an error: ERROR-RETRIEVE";
        break;
    case "ERROR-DB":
        echo "There has been an error: ERROR-DB";
        break;
    default:
        echo "<div class='alert alert-info'>";
        echo 'Successfully registered';
        echo "</div>";
        header('Location: login.php');
}
?>