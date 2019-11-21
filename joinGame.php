<?php
session_start();
include_once 'WebServiceClient.php';


if (!empty($_POST["gameid"])) {
    $gameid = (int)$_POST["gameid"];
    $_SESSION['gameid'] = $gameid;
    $_SESSION['moves'] = array
    (
        array("imgs/empty.png","imgs/empty.png","imgs/empty.png"),
        array("imgs/empty.png","imgs/empty.png","imgs/empty.png"),
        array("imgs/empty.png","imgs/empty.png","imgs/empty.png")
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