<?php
session_start();

//Call setGameState WS method and echo the result.
include_once 'WebServiceClient.php';

$gid = $_SESSION['gameid'];
$state = (int) $_GET['state'];
$result = $client->setGameState(array("gid" => $gid, "gstate" => $state));
if ($result->return === "1"){
    echo "Success, Game state has been changed";
}
elseif($result->return === "ERROR-NOGAME"){
    echo "Failed to find game.";
}
elseif($result->return === "ERROR-DB"){
    echo "Failed to connect to DB.";
}
?>