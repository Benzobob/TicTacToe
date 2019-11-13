<?php
include_once 'WebServiceClient.php';
session_start();

$result = $client->newGame(array("uid" => $_SESSION['id']));

switch ($result->return) {
    case "ERROR-NOTFOUND":
        echo "There has been an error: ERROR-NOTFOUND";
        break;
    case "ERROR-RETRIEVE":
        echo "There has been an error: ERROR-RETRIEVE";
        break;
    case "ERROR-INSERT":
        echo "There has been an error: ERROR-INSERT";
        break;
    case "ERROR-DB":
        echo "There has been an error: ERROR-DB";
        break;
    default:
        echo "<div class='alert alert-info'>";
        echo 'Successfully created game';
        echo "</div>";
        header('Location: gameboard.php');
}
?>