<?php
session_start();
include_once 'WebServiceClient.php';

if(!(isset($_SESSION['gameid']))) {
    $result = $client->newGame(array("uid" => $_SESSION['id']));
    $gameid = $result->return;
    $_SESSION['moves'] = array
    (
        array("imgs/empty.png","imgs/empty.png","imgs/empty.png"),
        array("imgs/empty.png","imgs/empty.png","imgs/empty.png"),
        array("imgs/empty.png","imgs/empty.png","imgs/empty.png")
    );
    switch ($gameid) {
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
            header("Location: gameboard.php");
            $_SESSION['gameid'] = $gameid;
    }
}
?>