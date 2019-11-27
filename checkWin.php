<?php
session_start();

//Call checkWin WS method and echo the result.
include_once 'WebServiceClient.php';
$gid = $_SESSION["gameid"];

$result = $client->checkWin(array("gid" => $gid));
echo $result->return;
?>