<?php
session_start();
include_once 'WebServiceClient.php';

$gid = $_SESSION['gameid'];
$uid = $_SESSION['id'];
$result = $client->deleteGame(array("gid" => $gid, "uid" => $uid));
if ($result->return === "1"){
    echo "1";
}
elseif($result->return === "ERROR-GAMESTARTED"){
    echo "Failed to find game.";
}
elseif($result->return === "ERROR-DB"){
    echo "Failed to connect to DB.";
}
?>