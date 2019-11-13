<?php
include_once 'WebServiceClient.php';
//get soap response containing values entered in registration form
$result = $client->register(array("username" => $_POST["username"], "password" => $_POST["password"], "name" => $_POST["name"], "surname" => $_POST["surname"]));

//check if result is Error, if so print error. Otherwise print user id.
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
        echo "id is " . $result->return;
}
?>