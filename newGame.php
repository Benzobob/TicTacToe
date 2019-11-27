<?php
session_start();
include_once 'WebServiceClient.php';

/*
 * 'moves' session variable is declared.
 * 'moves' currently holds 9 empty white images as placeholders.
 *  newGame WS method is called and user is re-directed to 'gameboard.php'
 * 'gameid' session variable is set.
 */

$result = $client->newGame(array("uid" => $_SESSION['id']));
$gameid = $result->return;
$_SESSION['moves'] = array
(
    array("imgs/emptyImg.png","imgs/emptyImg.png","imgs/emptyImg.png"),
    array("imgs/emptyImg.png","imgs/emptyImg.png","imgs/emptyImg.png"),
    array("imgs/emptyImg.png","imgs/emptyImg.png","imgs/emptyImg.png")
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
?>