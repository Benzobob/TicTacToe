<?php
session_start();

//Call checkSquare WS method and echo the result.
include_once 'WebServiceClient.php';
$x = $_REQUEST["x"];
$y = $_REQUEST["y"];
$gid = $_SESSION["gameid"];

$result = $client->checkSquare(array("x" => $x, "y" => $y, "gid" => $gid));
echo $result->return;
?>