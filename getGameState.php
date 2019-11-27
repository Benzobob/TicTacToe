<?php
session_start();

//Call getGameState WS method and echo the result.
include_once 'WebServiceClient.php';

$gid = $_SESSION['gameid'];
$result = $client->getGameState(array("gid" => $gid));
echo $result->return;
?>