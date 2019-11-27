<?php
session_start();
include_once 'WebServiceClient.php';

/*
 * POST gameid is set to session variable 'gameid'.
 * 'moves' session variable is declared.
 * 'moves' currently holds 9 empty white images as placeholders.
 *  joinGame WS method is called and user is re-directed to 'gameboard.php'
 */
if (!empty($_POST["gameid"])) {
    $gameid = (int)$_POST["gameid"];
    $_SESSION['gameid'] = $gameid;
    $_SESSION['moves'] = array
    (
        array("imgs/emptyImg.png","imgs/emptyImg.png","imgs/emptyImg.png"),
        array("imgs/emptyImg.png","imgs/emptyImg.png","imgs/emptyImg.png"),
        array("imgs/emptyImg.png","imgs/emptyImg.png","imgs/emptyImg.png")
    );
    $result = $client->joinGame(array("uid" => $_SESSION['id'], "gid" => $gameid));
    switch ($result->return) {
        case "ERROR-DB":
            echo "There has been an error: ERROR-DB";
            break;
        case "1":
            echo "Joined. gameid from joinGame: " . $gameid;
            header("Location: gameboard.php");
            break;
        default:
            echo "Unable to join";
    }
}
?>